<?php

namespace App\Livewire\Web\Home;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Livewire\Component;

class Index extends Component
{
    protected function getPopularProducts()
    {
        return Product::with(['category', 'ratings.customer'])
                    ->withAvg('ratings', 'rating') // Menghitung rata-rata rating
                    ->having('ratings_avg_rating', '>=', 4)
                    ->limit(5)
                    ->get();
    }

    public function render()
    {
        return view('livewire.web.home.index',[
            'sliders' => Slider::latest()->get(), //sliders
            'categories' => Category::latest()->get(), //categories
            'popularProducts' => $this->getPopularProducts(),
        ]);
    }
}
