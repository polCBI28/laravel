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
                customClass: {
                    popup: 'rounded-lg shadow-lg'
                }
            });
        </script>
    @endif

    {{-- ⚠️ Alerta de Error --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                background: '#18181b',
                color: '#f4f4f5',
                iconColor: '#ef4444',
                confirmButtonColor: '#3b82f6',
                customClass: {
                    popup: 'rounded-lg shadow-lg text-left'
                }
            });
        </script>
    @endif

    <div class="w-full bg-zinc-900 rounded-xl shadow-2xl overflow-hidden p-6 border border-zinc-800">
        <h1 class="text-2xl font-bold text-white mb-6">
            Registrar Nuevo Artículo
        </h1>

        <form action="{{ route('admin.Article.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Campo: Título --}}
            <div>
                <label for="titulo" class="block text-sm font-medium text-zinc-300 mb-1">
                    Título <span class="text-red-500">*</span>
                </label>
                <input type="text" id="titulo" name="titulo"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: Introducción a Laravel" value="{{ old('titulo') }}" required>
                @error('titulo')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo: Contenido --}}
            <div>
                <label for="contenido" class="block text-sm font-medium text-zinc-300 mb-1">
                    Contenido <span class="text-red-500">*</span>
                </label>
                <textarea id="contenido" name="contenido" rows="4"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Escribe el contenido del artículo..." required>{{ old('contenido') }}</textarea>
                @error('contenido')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo: Estado de publicación --}}
            <div>
                <label for="estado_publicacion" class="block text-sm font-medium text-zinc-300 mb-1">
                    Estado de publicación <span class="text-red-500">*</span>
                </label>
                <select id="estado_publicacion" name="estado_publicacion"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white"
                    required>
                    <option value="">Seleccione un estado</option>
                    <option value="publicado" {{ old('estado_publicacion') == 'publicado' ? 'selected' : '' }}>Publicado</option>
                    <option value="borrado" {{ old('estado_publicacion') == 'borrado' ? 'selected' : '' }}>Borrado</option>
                </select>
                @error('estado_publicacion')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Separador visual --}}
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-zinc-800"></div>
                </div>
            </div>

            {{-- Nota --}}
            <div class="text-sm text-zinc-500 mb-6">
                Campos marcados con <span class="text-red-500 font-bold">*</span> son obligatorios.
            </div>

            {{-- Botón --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-zinc-900 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Registrar Artículo
                </button>
            </div>
        </form>
    </div>
</div>
