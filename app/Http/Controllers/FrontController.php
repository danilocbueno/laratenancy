<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Tenants\Store;
use App\Models\Tenant\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        $products = Product::paginate(10);
        $store = tenant();
        return view('front.store', compact('products', 'store'));
    }

    public function single($slug) {
        $product = Product::whereSlug($slug)->first();
        return view('front.single', compact('product'));
    }
}
