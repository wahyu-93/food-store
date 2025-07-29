<?php

namespace App\Livewire\Web\Cart;

use App\Models\Cart;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // get cart by customer
        $carts = Cart::query()
                ->with('product')
                ->where('customer_id', auth()->guard('customer')->user()->id)
                ->latest()
                ->get();

        // menghitung total berat
        $totalWeight = $carts->sum(function($cart){
            return $cart->product->weight * $cart->qty;
        });

        // menghitung total harga
        $totalPrice = $carts->sum(function($cart){
            return $cart->product->price * $cart->qty;
        });

        return view('livewire.web.cart.index', compact('carts', 'totalWeight', 'totalPrice'));
    }
}
