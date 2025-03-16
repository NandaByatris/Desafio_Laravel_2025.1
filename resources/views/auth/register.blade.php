<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"> 
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

         <!-- Endereço -->
         <div class="mt-4">
            <x-input-label for="endereco" :value="__('Endereço')" />
            <x-text-input id="endereco" class="block mt-1 w-full" type="text" name="endereco" :value="old('endereco')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
        </div>

         <!-- Telefone -->
         <div class="mt-4">
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input id="telefone" class="block mt-1 w-full" type="tel" name="telefone" :value="old('telefone')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
        </div>

        <!-- Data de Nascimento -->
        <div class="mt-4">
            <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" />
            <x-text-input id="data_nascimento" class="block mt-1 w-full" type="date" name="data_nascimento" :value="old('data_nascimento')" required autocomplete="data_nascimento" />
            <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
        </div>

         <!-- CPF -->
         <div class="mt-4">
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required autocomplete="cpf" />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

          <!-- Saldo -->
        <div class="mt-4">
            <x-input-label for="saldo" :value="__('Saldo')" />
            <x-text-input id="saldo" class="block mt-1 w-full" type="number" name="saldo" :value="old('saldo')" required autocomplete="saldo" />
            <x-input-error :messages="$errors->get('saldo')" class="mt-2" />
        </div>

         <!-- Foto -->
         <div class="mt-4">
            <x-input-label for="imagem" :value="__('Imagem')" />
            <x-text-input id="imagem" class="block mt-1 w-full" type="file" name="imagem" accept="image/*" required :value="old('imagem')"/>
            <x-input-error :messages="$errors->get('imagem')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirme a Senha')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!--Admin or User -->
        @if (Auth::check() && Auth::user()->role == 'admin') 
        <div>
            <label for="role">Tipo de Usuário</label>
            <select name="role" id="role">
                <option value="admin">Administrador</option>
                <option value="user">Usuário Comum</option>
            </select>
        </div>
    @else
        <input type="hidden" name="role" value="user"> 
    @endif

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Já tem um cadastro?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
