<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

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

        // Validar los datos incluyendo el archivo de imagen
        $request->validate([
            'nombre' => 'required|max:75',
            'descripcion' => 'required|max:150',
            'cantidad' => 'required|integer|min:1',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validación de la imagen
            'precio_minorista'=> 'required|numeric|min:0',
            'precio_mayorista'=> 'required|numeric|min:0',
        ]);

        // Procesar la imagen si existe
        $imagen = null;
        if ($request->hasFile('imagen')) {
            // Guardar la imagen en la carpeta 'public/images' y obtener el nombre del archivo
            $imagen = $request->file('imagen')->store('images', 'public');
        }

        // Crear el nuevo producto
        $new_product = new Product();
        $new_product->imagen = $imagen; // Guardar la ruta de la imagen
        $new_product->nombre = $request->input('nombre');
        $new_product->descripcion = $request->input('descripcion');
        $new_product->cantidad = $request->input('cantidad');
        $new_product->precio_minorista= $request->input('precio_minorista');
        $new_product->precio_mayorista= $request->input('precio_mayorista');
        $new_product->user_id = auth()->user()->id;

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

    public function update(Product $product, Request $request)
    {
        // Validar los datos incluyendo el archivo de imagen
        $request->validate([
            'nombre' => 'required|max:75',
            'descripcion' => 'required|max:150',
            'cantidad' => 'required|integer|min:1',
            'precio_minorista' => 'required|numeric|min:0',
            'precio_mayorista' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Procesar la imagen si existe
        if ($request->hasFile('imagen')) {
            // Guardar la nueva imagen y obtener su ruta
            $imagen = $request->file('imagen')->store('images', 'public');
            // Eliminar la imagen anterior si existe
            if ($product->imagen) {
                Storage::disk('public')->delete($product->imagen);
            }
            $product->imagen = $imagen;
        }

        // Actualizar los demás campos
        $product->nombre = $request->input('nombre');
        $product->descripcion = $request->input('descripcion');
        $product->cantidad = $request->input('cantidad');
        $product->precio_minorista = $request->input('precio_minorista');
        $product->precio_mayorista = $request->input('precio_mayorista');

        if ($product->cantidad > 0) {
            $product->estado = "En Stock";
        } else {
            $product->estado = "No Stock";
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
