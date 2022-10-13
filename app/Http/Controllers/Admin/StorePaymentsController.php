<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
