<?php

namespace App\Livewire\Utils;

use App\Models\Transaction;
use Livewire\Component;

class OrderBadge extends Component
{
    public $orderPending;

    public function mount()
    {
        $this->orderPending = Transaction::where('customer_id', auth()->guard('customer')->user()->id)
                                            ->where('status', 'pending')
                                            ->count();
    }
    public function render()
    {
        return view('livewire.utils.order-badge');
    }
}
