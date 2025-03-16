<x-guest-layout>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form method="POST" action="{{ route('saque.processar') }}">
        @csrf

          <!-- Saldo Atual -->
          <div class="mb-4">
            <x-input-label for="saldo" :value="__('Saldo Disponível')" />
            <input type="text" id="saldo" class="block mt-1 w-full" value="R$ {{ number_format(auth()->user()->saldo, 2, ',', '.') }}" disabled />
        </div>

        <!-- Valor do Saque -->
        <div class="mb-4">
            <x-input-label for="valor" :value="__('Valor do Saque')" />
            <x-text-input id="valor" class="block mt-1 w-full" type="number" name="valor" step="0.01" min="0" required autofocus />
            <x-input-error :messages="$errors->get('valor')" class="mt-2" />
        </div>

        <!-- Botão de Saque -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Efetuar Saque') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
