<?php

namespace App\Livewire\Web\Product;

use App\Models\Product;
use Livewire\Component;

class Show extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {   
        //get product by slug
        $product = Product::query()
            ->with(['category', 'ratings.customer'])
            ->withCount('ratings')
            ->withAvg('ratings', 'rating')
            ->where('slug', $this->slug)
            ->firstOrFail();

        return view('livewire.web.product.show', compact('product'));
    }
}
