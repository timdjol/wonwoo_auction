<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchUsers extends Component
{
    public $search = '';

    public function render()
    {
        $products = Product::where('title', 'like', '%' . $this->search . '%')->get();
        return view('livewire.search-users', [
            'products' => $products
        ]);
    }
}
