<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tenant\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use MercadoPago;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index() {

        if(!auth()->check()) {
            return redirect()->route('login');
        }

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

    public function process(Request $request) {
        $dataPost = $request->all();
        $cartItems = session()->get('cart');
        $reference = Str::uuid();

        DB::transaction(function () use ($cartItems, $reference) {
            //check if has products in stock and decrement
            foreach ($cartItems as $item) {
                $this->decrementProductInStock($item['id']);
            }

            //create order
            auth()->user()->orders()->create([
                'reference' => $reference,
                'items' => $cartItems
            ]);
            //clear cart
            session()->forget('cart');

        });

        return redirect()->route('thanks');
    }

    private function decrementProductInStock($id) {
        $product = Product::findOrFail($id);
        if($product->in_stock <= 0) throw new \Exception('Acabou os produtos');
        $product->decrement('in_stock');
    }

    public function thanks() {
        return view('thanks');
    }
}
