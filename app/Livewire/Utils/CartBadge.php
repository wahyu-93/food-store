<?php

namespace App\Livewire\Utils;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartBadge extends Component
{
    public $count;
   
    public function mount()
    {
        $this->updateCount();
    }

    public function clearCount()
    {
        $this->count = 0;
    }

    public function updateCount()
    {
        if(auth()->guard('customer')->check()){
            $this->count = Cart::where('customer_id', auth()->guard('customer')->user()->id)->count();
        }
        else {
            $this->count = 0;
        }
    }
    
    public function render()
    {
        return view('livewire.utils.cart-badge');
    }
}
