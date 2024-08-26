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

    //Ruta que me redirige a la vista orders (pagina principal)
    Route::get('/orders', [
        App\Http\Controllers\OrderController::class, 'index'
    ])->name('orders');

    //Ruta que redirige a la vista para crear un nuevo pedido
    Route::get('/orders/create', [
        App\Http\Controllers\OrderController::class, 'create'
    ])->name('orders.create');

    //Ruta que almacena el formulario del pedido
    Route::put('/orders', [
        App\Http\Controllers\OrderController::class, 'store'
    ])->name('orders.store');
});

require __DIR__.'/auth.php';
