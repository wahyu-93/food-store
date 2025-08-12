<?php

namespace App\Livewire\Utils;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartBadge extends Component
{
    public $count;

    protected $listeners = [
        'cartUpdated'   => 'updateCount',
        'cartCleared'   => 'clearCount'
    ];

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
        if(Auth::check()){
            $this->count = Cart::where('customer_id', Auth::id())->count();
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
