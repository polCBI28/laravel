<?php

namespace App\Livewire\Admin;

use App\Models\Grade;
use Livewire\Component;
use Livewire\WithPagination;

class GradeTable extends Component
{
    use WithPagination;

    public function render()
    {
        $grades = Grade::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.gradeS-table', compact('grades'));
    }
}