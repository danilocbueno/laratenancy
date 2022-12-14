<x-app-layout>
    <h1>Adicionar novo produto</h1>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Empresa -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('name')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus/>
        </div>

        <!-- Domínio -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('description')"/>
            <div class="flex items-baseline">
                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus/>
            </div>
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="body" :value="__('body')"/>
            <x-text-input id="body" class="block mt-1 w-full" type="text" name="body" :value="old('body')" required autofocus/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('price')"/>
            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required/>
        </div>

        <!-- Product Images -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('price')"/>
            <input
                class="mt-1 form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                type="file"
                id="formFileMultiple"
                name="images[]"
                multiple
            />
        </div>


        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Adicionar') }}
            </x-primary-button>
        </div>


    </form>

</x-app-layout>
