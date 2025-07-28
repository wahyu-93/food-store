<?php

namespace App\Livewire\Web\Category;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Psy\Readline\Hoa\Console;

class Show extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;    
    }

    public function render()
    {
        $category = Category::with('products')
            ->whereHas('products', function ($query) {
                $query->where('slug', $this->slug);
            })
            ->firstOrFail();

        return view('livewire.web.category.show', compact('category'));
    }
}
