<?php

namespace App\Livewire\Web\Product;

use App\Models\Product;
use App\Models\Rating;
use Livewire\Component;

class ProductPopuler extends Component
{
    public function render()
    {
        // get product
       $products = Product::query()
                        ->with(['category', 'ratings.customer'])
                        ->withAvg('ratings', 'rating')
                        ->when(request()->has('search'), function($query){
                            $query->where('title', 'like', '%' . request()->search . '%');
                        })
                        ->having('ratings_avg_rating', '>', 0)
                        ->simplePaginate(5);

        return view('livewire.web.product.product-populer', compact('products'));
    }
}
