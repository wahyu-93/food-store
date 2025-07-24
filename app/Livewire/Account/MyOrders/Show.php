<?php

namespace App\Livewire\Account\MyOrders;

use App\Models\Transaction;
use Livewire\Component;

class Show extends Component
{
    public $snap_token;

    public function mount($snap_token)
    {
        $this->snap_token = $snap_token;
    }

    public function render()
    {
        //get transaction
        $transaction = Transaction::query()
            ->with(['customer', 'shipping', 'province', 'city', 'transactionDetails.product'])
            ->where('customer_id', auth()->guard('customer')->user()->id)
            ->where('snap_token', $this->snap_token)
            ->firstOrFail();

        return view('livewire.account.my-orders.show', compact('transaction'));
    }
}
