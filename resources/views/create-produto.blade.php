<!-- resources/views/produtos/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Criar Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('produtos.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-white">Nome</label>
                            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm text-black">
                            @error('nome') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="imagem" class="block text-sm font-medium text-white">Imagem</label>
                            <input type="file" id="imagem" name="imagem" class="block w-full mt-1">
                            @error('imagem') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-white">Descrição</label>
                            <textarea id="descricao" name="descricao" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm text-black">{{ old('descricao') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="categoria_id" class="block text-sm font-medium text-white">Categoria</label>
                            <select id="categoria_id" name="categoria_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm text-black">
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                                @endforeach
                            </select>
                            @error('categoria_id') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="preco" class="block text-sm font-medium text-white">Preço</label>
                            <input type="number" id="preco" name="preco" value="{{ old('preco') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm text-black">
                            @error('preco') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="quantidade" class="block text-sm font-medium text-white">Quantidade</label>
                            <input type="number" id="quantidade" name="quantidade" value="{{ old('quantidade') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm text-black">
                            @error('quantidade') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Criar Produto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
