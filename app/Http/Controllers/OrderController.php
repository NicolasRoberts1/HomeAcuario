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

class OrderController extends Controller
{
    //Metodo index, retorna la pagina principal con las ordenes cargadas
    public function index()
    {
        $orders= Order::orderBy('created_at', 'asc');

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
        $products= Product::orderBy('cantidad', 'ASC');

        return view('orders/create', [
            'products' => $products
        ]);
    }

    public function store(Request $request){
        $user_id = auth()->user()->id;
        $order = new Order();
        $order->cliente = $request->input('cliente');
        $order->direccion = $request->input('direccion');
        $order->pago = $request->input('metodo_pago');
        $order->pre_entrega = $request->input('entrega');
        $order->observacion = $request->input('observaciones');
        $order->user_id = $user_id;
        $order->save();

        $products = $request->input('products', []);

        foreach ($products as $producto_id => $cantidad) {
            $order->products()->attach($producto_id, [
                'cantidad' => $cantidad,
                'user_id' => $user_id
            ]);
        }

        //Registro el evento que sucedio: agrego una orden nueva

        session()->flash('notify_order_created', true);

        return redirect()->route('orders');
    }
}
