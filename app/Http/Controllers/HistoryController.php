<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\History;

class HistoryController extends Controller
{
    //Metodo indez
    public function index(){
        $history=History::orderBy('created_at', 'DESC');

        return view('History', [
            'history' => $history
        ]);
    }
}
