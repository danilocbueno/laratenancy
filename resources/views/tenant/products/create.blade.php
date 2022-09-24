<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1>Adicionar novo produto</h1>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('products.store') }}">
                @csrf

                <!-- Empresa -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <!-- Domínio -->
                <div class="mt-4">
                    <x-input-label for="description" :value="__('description')" />
                    <div class="flex items-baseline">
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus />
                    </div>
                </div>

                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="body" :value="__('body')" />
                    <x-text-input id="body" class="block mt-1 w-full" type="text" name="body" :value="old('body')" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="price" :value="__('price')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Adicionar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
