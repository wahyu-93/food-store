<?php

namespace App\Livewire\Account\MyOrders;

use App\Models\Transaction;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        //  get data transaksi
        $transactions = Transaction::query()
                        ->where('customer_id', auth()->guard('customer')->user()->id)
                        ->latest()
                        ->simplePaginate(3);

        return view('livewire.account.my-orders.index', compact('transactions'));
    }
}
