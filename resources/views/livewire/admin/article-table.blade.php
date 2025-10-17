<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<div class="w-full py-8 px-4 sm:px-6 lg:px-8" x-data="articleTable()">

    {{-- ✅ Notificaciones --}}
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
                customClass: { popup: 'rounded-lg shadow-lg text-left' }
            });
        </script>
    @endif

    {{-- 🔹 FORMULARIO DE CREACIÓN --}}
    <div class="w-full bg-zinc-900 rounded-xl shadow-2xl overflow-hidden p-6 border border-zinc-800 mb-10">
        <h1 class="text-2xl font-bold text-white mb-6">Registrar Nuevo Artículo</h1>

        <form action="{{ route('admin.Article.store') }}" method="POST" class="space-y-6">
            @csrf
            {{-- Campo: Título --}}
            <div>
                <label for="titulo" class="block text-sm font-medium text-zinc-300 mb-1">Título <span class="text-red-500">*</span></label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: Introducción a Laravel" required>
            </div>

            {{-- Campo: Contenido --}}
            <div>
                <label for="contenido" class="block text-sm font-medium text-zinc-300 mb-1">Contenido <span class="text-red-500">*</span></label>
                <textarea id="contenido" name="contenido" rows="4"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-zinc-500"
                    placeholder="Escribe el contenido..." required>{{ old('contenido') }}</textarea>
            </div>

            {{-- Campo: Estado --}}
            <div>
                <label for="estado_publicacion" class="block text-sm font-medium text-zinc-300 mb-1">Estado de publicación <span class="text-red-500">*</span></label>
                <select id="estado_publicacion" name="estado_publicacion"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">Seleccione...</option>
                    <option value="publicado" {{ old('estado_publicacion') == 'publicado' ? 'selected' : '' }}>Publicado</option>
                    <option value="borrado" {{ old('estado_publicacion') == 'borrado' ? 'selected' : '' }}>Borrado</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-lg hover:shadow-xl transition-all duration-200">
                    Registrar Artículo
                </button>
            </div>
        </form>
    </div>

    {{-- 🔹 TABLA DE ARTÍCULOS --}}
    <div class="w-full bg-zinc-900 rounded-xl shadow-2xl overflow-hidden p-6 border border-zinc-800">
        <h2 class="text-2xl font-bold text-white mb-6">Lista de Artículos</h2>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">#</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Título</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Contenido</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Estado</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-zinc-300 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @foreach ($articles as $article)
                        <tr>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $article->titulo }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-400">
                                {{ Str::limit($article->contenido, 60) }}
                            </td>
                            <td class="px-4 py-4 text-sm text-zinc-300 capitalize">
                                <span class="px-2 py-1 rounded-md text-xs font-semibold
                                    {{ $article->estado_publicacion == 'publicado' ? 'bg-green-700 text-green-100' : 'bg-yellow-700 text-yellow-100' }}">
                                    {{ $article->estado_publicacion }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm text-right">
                                {{-- Editar --}}
                                <button @click="openModal({{ $article->id }}, '{{ addslashes($article->titulo) }}', '{{ addslashes($article->contenido) }}', '{{ $article->estado_publicacion }}')"
                                    class="text-blue-500 hover:text-blue-400 mr-3">
                                    ✏️
                                </button>

                                {{-- Eliminar --}}
                                <button onclick="confirmDelete({{ $article->id }})" class="text-red-500 hover:text-red-400">
                                    🗑️
                                </button>

                                {{-- Formulario oculto --}}
                                <form id="delete-form-{{ $article->id }}" action="{{ route('admin.Article.destroy', $article->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        @if ($articles->hasPages())
            <div class="mt-6">
                {{ $articles->links() }}
            </div>
        @endif
    </div>

    {{-- 🔹 MODAL DE EDICIÓN --}}
    <div x-show="isOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70">
        <div class="bg-zinc-900 border border-zinc-800 rounded-lg shadow-xl w-full max-w-2xl p-8">
            <h3 class="text-xl font-semibold text-white mb-6">Editar Artículo</h3>
            <form :action="'/admin/Article/' + currentId" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-sm font-medium text-zinc-300 mb-2">Título</label>
                    <input type="text" x-model="currentTitulo" name="titulo"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-zinc-300 mb-2">Contenido</label>
                    <textarea x-model="currentContenido" name="contenido" rows="4"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500"
                        required></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-zinc-300 mb-2">Estado de publicación</label>
                    <select x-model="currentEstado" name="estado_publicacion"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="publicado">Publicado</option>
                        <option value="borrado">Borrado</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" @click="closeModal" class="px-6 py-3 text-zinc-300 hover:text-white">Cancelar</button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // 🔹 Confirmar eliminación
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Eliminar artículo?',
            text: "Esta acción no se puede revertir.",
            icon: 'warning',
            background: '#18181b',
            color: '#f4f4f5',
            iconColor: '#ef4444',
            showCancelButton: true,
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // 🔹 Componente Alpine.js
    function articleTable() {
        return {
            isOpen: false,
            currentId: null,
            currentTitulo: '',
            currentContenido: '',
            currentEstado: '',

            openModal(id, titulo, contenido, estado) {
                this.currentId = id;
                this.currentTitulo = titulo;
                this.currentContenido = contenido;
                this.currentEstado = estado;
                this.isOpen = true;
                document.body.classList.add('overflow-hidden');
            },
            closeModal() {
                this.isOpen = false;
                document.body.classList.remove('overflow-hidden');
            }
        }
    }
</script>
