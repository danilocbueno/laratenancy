<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\MercadoPagoService;

class StorePaymentsController extends Controller
{

    private MercadoPagoService $mercadoPagoService;

    public function __construct(MercadoPagoService $mercadoPagoService)
    {
        $this->mercadoPagoService = $mercadoPagoService;
    }

    public function index()
    {
        $payments = $this->mercadoPagoService->getPayments();

        return view('tenant.admin.store.payments', compact('payments'));
    }

    public function orders() {
        $orders = Order::paginate(10);
        return view('tenant.admin.store.orders', compact('orders'));
    }
}
