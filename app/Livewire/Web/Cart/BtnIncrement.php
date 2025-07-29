<?php

namespace App\Livewire\Web\Cart;

use App\Models\Cart;
use Livewire\Component;

class BtnIncrement extends Component
{
    public $cart_id;
    public $product_id;
    
    public function mount($cart_id, $product_id)
    {
        $this->cart_id = $cart_id;
        $this->product_id = $product_id;
    }

    public function increment()
    {
        // cari product , jika ada tambahkan 1
        $cart = Cart::find($this->cart_id);
        $cart->increment('qty');

        // session flush
        session()->flash('success', 'Qty Keranjang Berhasil Ditambahkan');

        // redirect
        return $this->redirect(route('web.cart.index'), navigate:true);
    }

    public function render()
    {
        return view('livewire.web.cart.btn-increment');
    }
}
