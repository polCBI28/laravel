{{-- resources/views/admin/Dish/table.blade.php --}}
<div class="bg-zinc-900 rounded-xl shadow-xl p-6 border border-zinc-800">
    <h2 class="text-xl font-semibold text-white mb-4">Lista de Platos</h2>

    <table class="min-w-full border border-zinc-800 divide-y divide-zinc-700 text-zinc-300">
        <thead class="bg-zinc-800 text-zinc-400 uppercase text-sm">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Nombre</th>
                <th class="px-4 py-3 text-left">Descripción</th>
                <th class="px-4 py-3 text-left">Precio (S/.)</th>
                <th class="px-4 py-3 text-left">Tipo</th>
                <th class="px-4 py-3 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-800">
            @foreach ($dishes as $dish)
                <tr class="hover:bg-zinc-800/50 transition">
                    <td class="px-4 py-3">{{ $dish->id }}</td>
                    <td class="px-4 py-3 font-medium text-white">{{ $dish->nombre }}</td>
                    <td class="px-4 py-3">{{ $dish->descripcion }}</td>
                    <td class="px-4 py-3">S/. {{ number_format($dish->presio, 2) }}</td>
                    <td class="px-4 py-3 capitalize">{{ $dish->tipo }}</td>
                    <td class="px-4 py-3 flex justify-center gap-3">
                        {{-- Editar --}}
                        <a href="{{ route('admin.dish.edit', $dish->id) }}"
                            class="text-blue-500 hover:text-blue-400 font-semibold">Editar</a>
                        {{-- Eliminar --}}
                        <form action="{{ route('admin.dish.destroy', $dish->id) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro de eliminar este plato?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-400 font-semibold">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
