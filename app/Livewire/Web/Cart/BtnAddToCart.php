<?php

namespace App\Livewire\Web\Cart;

use App\Models\Cart;
use Livewire\Component;

class BtnAddToCart extends Component
{
    public $product_id;

    public function addToCart()
    {
        // check user login, klo belum login arahkan ke form login
        if(!auth()->guard('customer')->check()){
            session()->flash('danger', 'Silahkan Login Terlebih Dahulu');
            return $this->redirect(route('login'),navigate:true);
        }

        // check product dalam cart
        $item = Cart::where('customer_id', auth()->guard('customer')->user()->id)
                    ->where('product_id', $this->product_id)
                    ->first();
           // kalo product sudah ada, tambah qtynya 
           // kalo belum ada save baru
           if($item){
                $item->increment('qty');
           }
           else {
                // store
                $item = Cart::create([
                    'customer_id'   => auth()->guard('customer')->user()->id,
                    'product_id'    => $this->product_id,
                    'qty'           => 1
                ]);
           }
        // session flash 
        session()->flash('success', 'Produck Berhasil Ditambahkan Ke keranjang');

        // redirect
        return $this->redirect(route('cart'),navigate:true);
    }

    public function render()
    {
        return view('livewire.web.cart.btn-add-to-cart');
    }
}
