<?php

namespace App\Livewire\Admin;

use App\Models\Dish;
use Livewire\Component;
use Livewire\WithPagination;

class DishTable extends Component
{
    use WithPagination;

    public function render()
    {
        $dishs = Dish::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.dish-table', compact('$dishs'));
    }
}