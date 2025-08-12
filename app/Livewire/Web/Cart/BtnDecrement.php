<?php

namespace App\Livewire\Web\Cart;

use App\Models\Cart;
use Livewire\Component;

class BtnDecrement extends Component
{
    public $cart_id;
    public $product_id;
    public $disabled;

    public function mount($cart_id, $product_id)
    {
        $this->cart_id = $cart_id;
        $this->product_id = $product_id;
    }

    public function decrement()
    {
        $cart = Cart::find($this->cart_id);
        $cart->decrement('qty');

        $this->dispatch('cartUpdated');
        session()->flash('success', 'Qty Keranjang Berhasil Dikurangi');

        return $this->redirect(route('web.cart.index'),navigate:true);        
    }

    public function render()
    {
        return view('livewire.web.cart.btn-decrement');
    }
}
