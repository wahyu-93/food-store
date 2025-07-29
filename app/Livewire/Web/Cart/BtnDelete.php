<?php

namespace App\Livewire\Web\Cart;

use App\Models\Cart;
use Livewire\Component;

class BtnDelete extends Component
{
    public $cart_id;

    public function mount($cart_id)
    {
        $this->cart_id = $cart_id;
    }

    public function delete()
    {
        $cart = Cart::find($this->cart_id);
        $cart->delete();

        session()->flash('success', 'Keranjang Berhasil Dihapus');

        return $this->redirect(route('web.cart.index'), navigate:true);
    }

    public function render()
    {
        return view('livewire.web.cart.btn-delete');
    }
}
