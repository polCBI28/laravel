<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryTable extends Component
{
    use WithPagination;

    public function render()
    {
        $categorys = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.category-table', compact('categorys'));
    }
}