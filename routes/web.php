<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect('/orders');
})->middleware(['auth', 'verified'])->name('orders');;

Route::get('/dashboard', function () {
    return redirect('/orders');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //=====================ORDERS=======================

    //Ruta que me redirige a la vista orders (pagina principal)
    Route::get('/orders', [
        App\Http\Controllers\OrderController::class, 'index'
    ])->name('orders');

    //Ruta que redirige a la vista para crear un nuevo pedido
    Route::get('/orders/create', [
        App\Http\Controllers\OrderController::class, 'create'
    ])->name('orders.create');

    //Ruta que almacena el formulario del pedido
    Route::post('/orders', [
        App\Http\Controllers\OrderController::class, 'store'
    ])->name('orders.store');

    //Ruta para eliminar un pedido
    Route::delete('/orders/{order}', [
        App\Http\Controllers\OrderController::class, 'destroy'
    ])->name('orders.destroy');

    Route::get('/orders/extendOrder/{order}', [
        App\Http\Controllers\OrderController::class, 'extendOrder'
    ])->name('orders.extendOrder');


    //==================PRODUCTS======================
    //Ruta que redirige a la vista products
    Route::get('/products', [
        App\Http\Controllers\ProductController::class, 'index'
    ])->name('products');

    //Ruta que redirige a la vista create para crear un producto
    Route::get('/products/create', [
        App\Http\Controllers\ProductController::class, 'create'
    ])->name('products.create');
    //Almacena los datos ingresados en el formulariod e la vista create
    Route::post('/products', [
        App\Http\Controllers\ProductController::class, 'store'
    ])->name('products.store');
    //Editar producto
    Route::get('/products/edit/{product}', [
        App\Http\Controllers\ProductController::class, 'edit'
    ])->name('products.edit');
    //Guardado de datos de la edicion
    Route::put('/products/{product}', [
        App\Http\Controllers\ProductController::class, 'update'
    ])->name('products.update');
    //Eliminar un producto
    Route::delete('/products/{product}', [
        App\Http\Controllers\ProductController::class, 'destroy'
    ])->name('products.destroy');


    //====================HISTORY======================
    //Ruta que redirige a la vista history (donde se mostrara el historial de los pedidos realizados y su estado)
    Route::get('/history', [
        App\Http\Controllers\HistoryController::class, 'index'
    ])->name('history');
});

require __DIR__.'/auth.php';
