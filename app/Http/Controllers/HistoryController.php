<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\History;
use App\Models\Order;

class HistoryController extends Controller
{
    //Metodo index
    public function index(){
        $histories=History::orderBy('created_at', 'desc')->get();
        $orders= Order::where('estado', 'Listo')->get();

        return view('History', [
            'histories' => $histories,
            'orders' => $orders
        ]);
    }
}
