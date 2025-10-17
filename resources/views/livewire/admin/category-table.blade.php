<div class="w-full bg-zinc-900 rounded-xl shadow-2xl overflow-hidden p-6 border border-zinc-800" x-data="categoryTable()">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Lista de Categorías</h1>
    </div>

    <!-- Tabla -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-zinc-800">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">#</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Nombre</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Descripción</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Color</th>
                    <th class="px-4 py-3 text-right text-sm font-medium text-zinc-300 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800">
                @foreach ($categories as $category)
                <tr>
                    <td class="px-4 py-4 text-sm text-zinc-300">{{ $loop->iteration }}</td>
                    <td class="px-4 py-4 text-sm text-zinc-300">{{ $category->name }}</td>
                    <td class="px-4 py-4 text-sm text-zinc-300">
                        {{ $category->description ? Str::limit($category->description, 50) : 'Sin descripción' }}
                    </td>
                    <td class="px-4 py-4">
                        <span class="inline-block w-6 h-6 rounded-full border" style="background-color: {{ $category->color }}"></span>
                    </td>
                    <td class="px-4 py-4 text-sm text-right">
                        <!-- Editar -->
                        <button
                            @click="openModal({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description ?? '') }}', '{{ $category->color }}')"
                            class="text-blue-500 hover:text-blue-400 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>

                        <!-- Eliminar -->
                        <button onclick="confirmDelete({{ $category->id }})"
                            class="text-red-500 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Formulario eliminar oculto -->
                        <form id="delete-form-{{ $category->id }}"
                            action="{{ route('admin.category.destroy', $category->id) }}"
                            method="POST"
                            class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    @if ($categories->hasPages())
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
    @endif

    <!-- Modal de edición -->
    <div x-show="isOpen" x-cloak x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto">

        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div class="fixed inset-0 bg-black opacity-75" @click="closeModal"></div>

            <div class="relative bg-zinc-900 rounded-lg shadow-xl border border-zinc-800 w-full max-w-2xl mx-auto">
                <form :action="'/admin/category/' + currentId" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white mb-6">Editar Categoría</h3>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-zinc-300 mb-2">Nombre</label>
                            <input type="text" x-model="currentName" name="name"
                                class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded text-white focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-zinc-300 mb-2">Descripción</label>
                            <textarea x-model="currentDescription" name="description" rows="4"
                                class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded text-white focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-zinc-300 mb-2">Color</label>
                            <input type="color" x-model="currentColor" name="color"
                                class="w-full h-[42px] border border-zinc-700 rounded-lg">
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-zinc-800 flex justify-end space-x-4">
                        <button type="button" @click="closeModal" class="px-6 py-2 text-zinc-300 hover:text-white">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Confirmar eliminación
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Eliminar categoría?',
            text: "No podrás revertir esto",
            icon: 'warning',
            background: '#18181b',
            color: '#f4f4f5',
            iconColor: '#ef4444',
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#6b7280',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'rounded-lg shadow-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Componente Alpine.js
    function categoryTable() {
        return {
            isOpen: false,
            currentId: null,
            currentName: '',
            currentDescription: '',
            currentColor: '#000000',

            openModal(id, name, description, color) {
                this.currentId = id;
                this.currentName = name;
                this.currentDescription = description;
                this.currentColor = color;
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