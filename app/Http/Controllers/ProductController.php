<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Product;

class ProductController extends Controller
{
    //

    public function index()
    {
        $products= Product::all();

        $notify_product_created = session()->get('notify_product_created', false);
        $notify_product_updated = session()->get('notify_product_updated', false);
        $notify_product_deleted = session()->get('notify_product_deleted', false);

        return view('products', [
            'products' => $products,
            'notify_product_created' => $notify_product_created,
            'notify_product_updated' => $notify_product_updated,
            'notify_product_deleted' => $notify_product_deleted
        ]);
    }

    public function create(){
        return view('/products/create');
    }

    public function store(Request $request){

        //validacion de campos
        $imagen= "null";  //CUANDO SE PUEDA PONER IMAGENES SE CORRIGE
        $nombre= $request->input('nombre');
        $descripcion= $request->input('descripcion');
        $cantidad= $request->input('cantidad');
        $precio= $request->input('precio');

        $new_product = new Product();
        $new_product->imagen= $imagen;
        $new_product->nombre= $nombre;
        $new_product->descripcion= $descripcion;
        $new_product->cantidad= $cantidad;
        $new_product->precio= $precio;
        $new_product->user_id= auth()->user()->id;
        if($new_product->cantidad>0){
            $new_product->estado= "En Stock";
        }else{
            $new_product->estado= "No Stock";
        }
        $new_product->save();

        session()->flash('notify_product_created', true);

        return redirect()->route('products');
    }

    public function edit(Product $product, Request $request){
        /*Error para que el usuario no pueda cambiar el valor de la id en la URL para acceder a editar otros productos*/
        if($product->user_id != auth()->user()->id){
            abort(403);
        }
        return view('products.edit', compact('product'));
    }

    public function update(Product $product, Request $request){

        $product->nombre = $request->input('nombre');
        $product-> descripcion= $request->input('descripcion');
        $product->cantidad = $request->input('cantidad');
        $product->precio= $request->input('precio');
        if ($product->cantidad>0){
            $product->estado= "En Stock";
        }else{
            $product->estado= "No Stock";
        }
        $product->save();

        session()->flash('notify_product_updated', true);
        return redirect()->route('products');
    }

    public function destroy(Product $product){
        $product->delete();

        session()->flash('notify_product_deleted', true);

        return redirect()->route('products');
    }
}
