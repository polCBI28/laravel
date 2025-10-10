<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class ProductoTable extends Component
{
    public function render()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.producto-table', compact('products'));
    }
}
