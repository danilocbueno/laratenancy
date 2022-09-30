<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->paginate(10);
        return view('orders', compact('orders'));
    }
}
