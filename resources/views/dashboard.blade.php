<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="{{ route('produtos.index') }}">
                        <input type="text" name="search" placeholder="Pesquisar produtos" value="{{ request('search') }}" class="border p-2 rounded">
                        
                        <select name="categoria" class="border p-2 rounded">
                            <option value="">Categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Filtrar</button>
                    </form>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                        @foreach ($produtos as $produto)
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                <h3 class="text-xl font-semibold">{{ $produto->nome }}</h3>
                                <p class="text-lg">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                <p>{{ Str::limit($produto->descricao, 100) }}</p>

                                <a href="{{ route('produtos.show', $produto) }}" class="text-blue-500 hover:underline">Ver produto</a>

                                @if (!auth()->user()->is_admin)
                                    <form action="{{ route('compra.create', $produto->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white p-2 rounded mt-2">Comprar</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginação -->
                    {{ $produtos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
