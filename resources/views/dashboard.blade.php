<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Produtos:') }}
        </h2>
    </x-slot>

<!-- Botão Criar Produto -->
<form action="{{ route('produtos.create') }}" method="get">
    <button type="submit" class=" ml-4 mt-4 bg-black text-white p-2 rounded">
        Criar Produto
    </button>
</form>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="{{ route('produtos.index') }}">
                        <input type="text" name="search" placeholder="Pesquisar produtos" value="{{ request('search') }}" class="border p-2 text-black rounded">
                        
                        <select name="categoria" class="border p-3 text-black ">
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
                            <div class="bg-gray-100 p-4 text-black rounded-lg shadow-md">
                                <h3 class="text-xl font-semibold">{{ $produto->nome }}</h3>
                                <p class="text-lg">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                <p>{{ Str::limit($produto->descricao, 100) }}</p>

            
                                <!-- Botão de compra, TESTE -->
                                @if (!auth()->user()->is_admin)
                                    <form action="{{ route('checkout') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                                        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Comprar</button>
                                    </form>
                                @endif


                                <div class="mt-4 flex space-x-4">

                                    <a href="{{ route('produtos.show', $produto->id) }}" class="text-blue-500 hover:underline ">Ver produto</a>

                                    <a href="{{ route('produtos.edit', $produto->id) }}" class="text-black-500 hover:underline">Editar</a>
                                    
                                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                                    </form>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <!-- Paginação -->
                    {{ $produtos->links() }}
                </div>
            </div>
        </div>
    </x-app-layout>