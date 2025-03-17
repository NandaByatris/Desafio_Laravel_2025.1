<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Produto') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-2xl font-semibold">{{ $produto->nome }}</h3>
           
            <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-64 object-cover rounded-md mt-4">
            <p class="mt-4 text-lg">Preço: R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
            <p class="mt-2">Quantidade disponível: {{ $produto->quantidade }}</p>
            <p class="mt-2">Descrição: {{ $produto->descricao }}</p>
            <p class="mt-2">Categoria: {{ $produto->categoria->nome }}</p>
            <p class="mt-2">Anunciado por: {{ $produto->user->name }}</p>
            <p class="mt-2">Telefone: {{ $produto->user->telefone }}</p>


            @if (Auth::check() && !Auth::user()->is_admin)
                <form action="{{ route('compra.create', $produto->id) }}" method="POST">
                    <button type="submit" class="mt-4 px-6 py-2 bg-blue-500 text-white rounded-md">Comprar</button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
