@extends('adminlte::page')

@section('title', 'Gestión de Vehículos')

@section('content_header')
    <h1 class="text-center">Gestión de Vehículos</h1>
@stop

@section('content')
<div class="container mt-4">
    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Errores de validación --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Hubo algunos problemas con tus datos.<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para registrar vehículo --}}
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white text-center">
            <h4>Registrar Nuevo Vehículo</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.vehiculo.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Marca</label>
                        <input type="text" name="marca" class="form-control" placeholder="Ej: Toyota" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Modelo</label>
                        <input type="text" name="modelo" class="form-control" placeholder="Ej: Corolla" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Año</label>
                        <input type="number" name="anio" class="form-control" placeholder="Ej: 2015" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Color</label>
                        <input type="text" name="color" class="form-control" placeholder="Ej: Rojo" required>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4">Registrar Vehículo</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabla de registros --}}
    <div class="mt-5">
        @include('admin.Vehiculo.table')
    </div>
</div>
@stop
