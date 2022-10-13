<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use MercadoPago;

class MercadoPagoService
{

    public function getPayments() {
        $response = Http::get('https://api.mercadopago.com/v1/payments/search?access_token=TEST-4396009488109012-092409-069b41d4fcd94c7d384c4989841789c4-56728636&sort=date_created');

        return $response->json();
    }

    public function createPreference($cartItens) : MercadoPago\Preference {
        MercadoPago\SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

        $preference = new MercadoPago\Preference();
        $mercadoPagoItems = [];

        foreach ($cartItens as $cartItem) {
            $mercadoPagoItem = new MercadoPago\Item();
            $mercadoPagoItem->title = $cartItem['name'];
            $mercadoPagoItem->quantity = 1;
            $mercadoPagoItem->unit_price = $cartItem['price'];

            array_push($mercadoPagoItems, $mercadoPagoItem);
        }

        $preference->items = $mercadoPagoItems;

        $backUrlDomain = tenant()->domain . '/feedback';

        $preference->back_urls = array(
            "success" => $backUrlDomain,
            "failure" => $backUrlDomain,
            "pending" => $backUrlDomain
        );
        $preference->auto_return = "approved";
        $preference->save();

        return $preference;
    }

}
