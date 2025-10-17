<?php

namespace App\Livewire\Admin;

use App\Models\Grade;
use App\Models\Vehiculo;
use Livewire\Component;
use Livewire\WithPagination;

class VehiculoTable extends Component
{
    use WithPagination;

    public function render()
    {
        $vehiculos = Vehiculo::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.vehiculos-table', compact('vehiculos'));
    }
}