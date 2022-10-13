<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Product;
use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    public function __construct(private CartService $cartService)
    {
    }

    public function index()
    {
        $cart = $this->cartService->all();

        return view('cart', compact('cart'));
    }

    public function add($productSlug)
    {
        $product = Product::whereSlug($productSlug)->first();
        $product['image'] = $product->images->first()?->path; //FIXME check the images attr

        if($product == null)  {
            return redirect()->route('front.store'); //FIXME TO 404
        }

        $this->cartService->add($product->toArray());

        return redirect()->route('cart.index');
    }

    public function remove($productSlug)
    {
        $this->cartService->remove($productSlug);
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        $this->cartService->clear();
        return redirect()->route('front.store');
    }
}
