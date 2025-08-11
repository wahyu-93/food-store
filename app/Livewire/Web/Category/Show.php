<?php

namespace App\Livewire\Web\Category;

use App\Models\Category;
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
        $category = Category::with('products')
            ->where('slug', $this->slug)
            ->firstOrFail();
        dd($category->products()->latest()->get());
        return view('livewire.web.category.show', compact('category'));
    }
}
