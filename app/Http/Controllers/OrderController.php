<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = auth()->user()->orders()->paginate(2);
        return view('orders', compact('orders'));
    }
}
