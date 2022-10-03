<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MercadoPagoService
{

    public function getPayments() {
        $response = Http::get('https://api.mercadopago.com/v1/payments/search?access_token=TEST-4396009488109012-092409-069b41d4fcd94c7d384c4989841789c4-56728636');

        return $response->json();
    }

}
