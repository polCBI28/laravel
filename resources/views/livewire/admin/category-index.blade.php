@extends('layouts.admin')

@section('content')
<div class="w-full py-8 px-4 sm:px-6 lg:px-8">

    <!-- Notificación Éxito -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "¡Éxito!",
                text: "{{ session('success') }}",
                background: '#18181b',
                color: '#f4f4f5',
                iconColor: '#22c55e',
                confirmButtonColor: '#3b82f6',
                customClass: { popup: 'rounded-lg shadow-lg' }
            });
        </script>
    @endif

    <!-- Notificación Error -->
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                background: '#18181b',
                color: '#f4f4f5',
                iconColor: '#ef4444',
                confirmButtonColor: '#3b82f6',
                customClass: { popup: 'rounded-lg shadow-lg text-left' }
            });
        </script>
    @endif

    <!-- FORMULARIO NUEVA CATEGORÍA -->
    <div class="bg-zinc-900 rounded-xl shadow-2xl p-6 border border-zinc-800 mb-8">
        <h2 class="text-2xl font-bold text-white mb-4">Registrar Categoría</h2>

        <form action="{{ route('admin.category.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-2">Nombre</label>
                <input type="text" name="name"
                    class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-2">Descripción</label>
                <input type="text" name="description"
                    class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-2">Color</label>
                <input type="color" name="color" value="#3b82f6"
                    class="w-full h-[42px] border border-zinc-700 rounded-lg">
            </div>

            <div class="col-span-1 md:col-span-3 text-right mt-3">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>

    <!-- Incluimos la tabla -->
    @include('admin.category.table')

</div>
@endsection
