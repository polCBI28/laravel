@php
    use App\Models\Vehiculo;
    $vehiculos = Vehiculo::all();
@endphp

<div class="card shadow-lg">
    <div class="card-header bg-secondary text-white text-center">
        <h4>Listado de Vehículos</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehiculos as $vehiculo)
                    <tr>
                        <td>{{ $vehiculo->id }}</td>
                        <td>{{ $vehiculo->marca }}</td>
                        <td>{{ $vehiculo->modelo }}</td>
                        <td>{{ $vehiculo->anio }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $vehiculo->color }};">{{ $vehiculo->color }}</span>
                        </td>
                        <td>
                            {{-- Botón editar (opcional según tu flujo) --}}
                            <a href="{{ route('admin.vehiculo.edit', $vehiculo->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            {{-- Botón eliminar --}}
                            <form action="{{ route('admin.vehiculo.destroy', $vehiculo->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar este vehículo?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay vehículos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
