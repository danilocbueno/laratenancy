<?php

namespace App\Http\Controllers;

use MercadoPago;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index() {

        MercadoPago\SDK::setAccessToken("TEST-4396009488109012-092409-069b41d4fcd94c7d384c4989841789c4-56728636"); // Either Production or SandBox AccessToken

        $preference = new MercadoPago\Preference();

        $item = new MercadoPago\Item();
        $item->title = 'produto teste';
        $item->quantity = '2';
        $item->unit_price = '10';

        $preference->items = array($item);

        $preference->back_urls = array(
            "success" => "http://localhost:8080/feedback",
            "failure" => "http://localhost:8080/feedback",
            "pending" => "http://localhost:8080/feedback"
        );
        $preference->auto_return = "approved";

        $preference->save();

        $response = array(
            'id' => $preference->id,
        );
        return view('checkout')->with('preference', $response);
    }
}
