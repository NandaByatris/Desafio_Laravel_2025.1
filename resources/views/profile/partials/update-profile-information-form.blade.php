<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informações de Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Atualize suas informações de perfil.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-4">
            <x-input-label for="endereco" :value="__('Endereço')" />
            <x-text-input id="endereco" class="block mt-1 w-full" type="text" name="endereco" :value="old('endereco', $user->endereco)" required autocomplete="address" />
            <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="mt-4">
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input id="telefone" class="block mt-1 w-full" type="tel" name="telefone" :value="old('telefone', $user->telefone)" required autocomplete="telephone" />
            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
        </div>

        <!-- Data de Nascimento -->
        <div class="mt-4">
            <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" />
            <x-text-input id="data_nascimento" class="block mt-1 w-full" type="date" name="data_nascimento" :value="old('data_nascimento', $user->data_nascimento)" required autocomplete="birthdate" />
            <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
        </div>

        <!-- CPF -->
        <div class="mt-4">
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf', $user->cpf)" required autocomplete="cpf" />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <!-- Saldo -->
        <div class="mt-4">
            <x-input-label for="saldo" :value="__('Saldo')" />
            <x-text-input id="saldo" class="block mt-1 w-full" type="number" name="saldo" :value="old('saldo', $user->saldo)" required autocomplete="saldo" />
            <x-input-error :messages="$errors->get('saldo')" class="mt-2" />
        </div>

        <!-- Foto -->
        <div class="mt-4">
            <x-input-label for="imagem" :value="__('Imagem')" />
            <x-text-input id="imagem" class="block mt-1 w-full" type="file" name="imagem" accept="image/*" :value="old('imagem')" />
            <x-input-error :messages="$errors->get('imagem')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Salvo.') }}</p>
            @endif
        </div>
    </form>
</section>
