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
        $products= Product::orderBy('created_at', 'asc');

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
}
