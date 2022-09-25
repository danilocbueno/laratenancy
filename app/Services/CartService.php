<?php

namespace App\Services;

use Illuminate\Session\SessionManager;
use phpDocumentor\Reflection\Types\Self_;

class CartService
{
    const CART_KEY = 'cart';

    public function __construct(private SessionManager $session){}

    public function all() {
        $items = $this->session->get(self::CART_KEY);
        return !$items ? [] : $items;
    }

    public function add($item) {
         if($this->session->has(self::CART_KEY)) {
             if($this->itemExistsInCart($item)) throw new \Exception('Produto já existe no carrinho');
            $this->session->push(self::CART_KEY, $item);
         } else {
             $this->session->put(self::CART_KEY, [$item]);
         }

    }

    public function remove($item) {
        $items = $this->session->get(self::CART_KEY);
        $items = array_filter($items, function ($line) use ($item) {
            return $line['slug'] != $item;
        });

        $this->session->put(self::CART_KEY, $items);
    }

    public function clear() {
        $this->session->forget(self::CART_KEY);
    }

    private function itemExistsInCart($item) {
        $items = $this->session->get(self::CART_KEY);
        $slugs = array_column($items, 'slug');
        return in_array($item['slug'], $slugs);
    }
}
