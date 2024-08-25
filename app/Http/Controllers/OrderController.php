<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\ProductOrder;

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
}
