<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Models\Product;
use App\Models\History;
use Carbon\Carbon;

class OrderController extends Controller
{
    //Metodo index, retorna la pagina principal con las ordenes cargadas
    public function index()
    {
        $orders= Order::where('estado', 'Pendiente')->get();

        $notify_order_created = session()->get('notify_order_created', false);
        $notify_order_updated = session()->get('notify_order_updated', false); //En caso de poder modificarse una orden
        $notify_order_deleted = session()->get('notify_order_deleted', false);

        return view('orders', [
            'orders' => $orders,
            'notify_order_created' => $notify_order_created,
            'notify_order_updated' => $notify_order_updated,
            'notify_order_deleted' => $notify_order_deleted
        ]);
    }

    public function create(){
        //Recupero los productos de la tabla, para mostrarlos y asi poder elegirlos
        $products= Product::all();

        return view('orders/create', [
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $user_id = auth()->user()->id;

        // Crear nueva orden pero no guardarla aún
        $order = new Order();
        $order->cliente = $request->input('cliente');
        $order->direccion = $request->input('direccion');
        $order->pago = $request->input('metodo_pago');
        $order->tipo = $request->input('tipo');
        $order->pre_entrega = $request->input('entrega');
        $order->observacion = $request->input('observaciones');
        $order->user_id = $user_id;
        $order->fecha = Carbon::now();
        $order->estado = "Pendiente";

        // Calcular el total antes de guardar
        $products = $request->input('products', []);
        $total = 0;

        foreach ($products as $producto_id => $cantidad) {
            if ($cantidad > 0) {
                $product = Product::find($producto_id);
                if($order->tipo == 'minorista'){
                    $subtotal = $product->precio_minorista * $cantidad;
                }
                else if($order->tipo == 'mayorista'){
                    $subtotal = $product->precio_mayorista * $cantidad;
                }
                $total += $subtotal;
            }
        }

        // Asignar el total calculado antes de guardar
        $order->total = $total;

        // Ahora guardamos la orden con el total
        $order->save();

        // Agregar productos a la tabla intermedia
        foreach ($products as $producto_id => $cantidad) {
            if ($cantidad > 0) {
                $order->product()->attach($producto_id, [
                    'cantidad' => $cantidad,
                    'user_id' => $user_id
                ]);
            }
        }

        session()->flash('notify_order_created', true);
        return redirect()->route('orders');
    }

    public function destroy(Order $order){

        $order->delete();

        session()->flash('notify_order_deleted', true);

        return redirect()->route('orders');
    }

    public function extendOrder(Order $order,Request $request){

        if($order->user_id != auth()->user()->id){
            abort(403);
        }

        $products = $order->product;

        return view('orders.extendOrder', compact('order', 'products'));
    }


    public function transfHistory(Request $request){
        $id_orden = $request->input('id_orden');
        $order = Order::find($id_orden);
        $order->estado = "Listo";
        $order->save();
        try{
            if($order->estado == "Listo"){
                $histories = new History;
                $histories->id_orden = $id_orden;
                $histories->fecha = $request->input('fecha');
                $histories->cliente = $request->input('cliente');
                $histories->direccion = $request->input('direccion');
                $histories->total = $request->input('total');
                $histories->estado = $order->estado;
                $histories->user_id = auth()->user()->id;
                $histories->save();
                return redirect()->route('history');
            }
        }catch(Exception $e){
            echo($e);
        }
    }
}
