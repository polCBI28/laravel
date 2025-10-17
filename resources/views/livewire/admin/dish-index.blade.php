{{-- resources/views/admin/Dish/index.blade.php --}}
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="w-full py-8 px-4 sm:px-6 lg:px-8">
    {{-- ✅ Alerta de Éxito --}}
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

    {{-- ❌ Alerta de Error --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error de validación',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                background: '#18181b',
                color: '#f4f4f5',
                iconColor: '#ef4444',
                confirmButtonColor: '#3b82f6',
                customClass: { popup: 'rounded-lg shadow-lg text-left' }
            });
        </script>
    @endif

    {{-- 🔹 Contenedor principal --}}
    <div class="w-full bg-zinc-900 rounded-xl shadow-2xl overflow-hidden p-6 border border-zinc-800">
        <h1 class="text-2xl font-bold text-white mb-6">
            Registrar Nuevo Plato
        </h1>

        {{-- 📝 Formulario --}}
        <form action="{{ route('admin.dish.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Nombre --}}
            <div>
                <label for="nombre" class="block text-sm font-medium text-zinc-300 mb-1">
                    Nombre del plato <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nombre" name="nombre"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 text-white placeholder-zinc-500"
                    placeholder="Ej: Lomo Saltado" required>
            </div>

            {{-- Descripción --}}
            <div>
                <label for="descripcion" class="block text-sm font-medium text-zinc-300 mb-1">
                    Descripción
                </label>
                <textarea id="descripcion" name="descripcion" rows="3"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 text-white placeholder-zinc-500"
                    placeholder="Describe el plato"></textarea>
            </div>

            {{-- Precio --}}
            <div>
                <label for="presio" class="block text-sm font-medium text-zinc-300 mb-1">
                    Precio (S/.) <span class="text-red-500">*</span>
                </label>
                <input type="number" id="presio" name="presio" step="0.01" min="0"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 text-white placeholder-zinc-500"
                    placeholder="Ej: 25.50" required>
            </div>

            {{-- Tipo --}}
            <div>
                <label for="tipo" class="block text-sm font-medium text-zinc-300 mb-1">
                    Tipo de plato <span class="text-red-500">*</span>
                </label>
                <select id="tipo" name="tipo"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 text-white"
                    required>
                    <option value="">Seleccione...</option>
                    <option value="normal">Normal</option>
                    <option value="vegetariano">Vegetariano</option>
                </select>
            </div>

            {{-- Botón --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 shadow-lg transition-all">
                    Registrar Plato
                </button>
            </div>
        </form>
    </div>

    {{-- 📋 Tabla de platos --}}
    <div class="mt-10">
        @include('admin.Dish.table')
    </div>
</div>
