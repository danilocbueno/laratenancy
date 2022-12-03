<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use MercadoPago;

class MercadoPagoService
{

    public function getPayments() {
        $response = Http::get('https://api.mercadopago.com/v1/payments/search?access_token=' . env('MERCADOPAGO_ACCESS_TOKEN') . '&sort=date_created');

        return $response->json();
    }

    public function createPreference($cartItens) : MercadoPago\Preference {
        $reference = Str::uuid();
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

        $preference->external_reference = $reference;
        $preference->statement_descriptor = "LARALOGGI";

        $preference->payment_methods = array(
            "excluded_payment_types" => array(
                array("id" => "credit_card")
            ),
            "installments" => 12
        );

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
