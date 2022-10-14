<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tenant\Product;
use App\Models\User;
use App\Services\MercadoPagoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PHPUnit\Exception;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{

    public function __construct(MercadoPagoService $mercadoPagoService)
    {
        $this->mercadoPagoService = $mercadoPagoService;
    }

    public function index() {

        if(!auth()->check() || !session()->has('cart')) {
            return redirect()->route('login');
        }

        $cartItems = session()->get('cart');
        try {
            $preference = $this->mercadoPagoService->createPreference($cartItems);
        } catch (Exception $e) {
            return redirect()->route('checkout.index');
        }

        return view('checkout.index')->with('preference', $preference);
    }

    private function createOrder($mercadoPagoPreferenceResponse) {
        $cartItems = session()->get('cart');
        $reference = Str::uuid();

        DB::transaction(function () use ($cartItems, $reference, $mercadoPagoPreferenceResponse) {
            //check if has products in stock and decrement
            foreach ($cartItems as $item) {
                $this->decrementProductInStock($item['id']);
            }

            $items = [
                "mercadoPagoPreference" => $mercadoPagoPreferenceResponse,
                "cartItems" => $cartItems
            ];

            //create order
            auth()->user()->orders()->create([
                'reference' => $reference,
                'items' => $items
            ]);

            //clear cart
            session()->forget('cart');

        });

        return redirect()->route('checkout.thanks');
    }

    private function decrementProductInStock($id) {
        $product = Product::findOrFail($id);
        if($product->in_stock <= 0) throw new \Exception('Acabou os produtos');
        $product->decrement('in_stock');
    }

    public function thanks() {
        return view('checkout.thanks');
    }

    public function feedback(Request $request) {

        if(!$request->has('status')) {
            return redirect()->route('checkout.index'); //SOMETHING is WRONG
        }

        $status = $request->query('status');

        if($status == "approved" || $status == "in_process") {
            $mercadoPagoPreferenceResponse = $request->query();
            $this->createOrder($mercadoPagoPreferenceResponse);
            return view('checkout.thanks');
        } else {
            Alert::error('Ops...', 'Infelizmente tivemos problemas ao realizar seu pedido!');
            return redirect()->route('checkout.index');
        }
    }

    public function hook(Request $request) {
        $user = User::all()->first();
        $user->orders()->create([
            'reference' => Str::uuid(),
            'items' => $request->json()->all()
        ]);

        response()->json([], 204);
    }
}
