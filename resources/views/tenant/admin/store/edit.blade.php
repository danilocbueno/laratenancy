<x-app-layout>
    <h1>Store details</h1>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

    <form method="POST" action="{{ route('admin.store.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Empresa -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('company name')"/>
            <x-text-input id="name"
                          class="block mt-1 w-full text-gray-700 bg-gray-200 bg-clip-padding border border-solid border-gray-300"
                          type="text" name="name" :value="$store->name" disabled/>
        </div>

        <!-- Domínio -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('domain')"/>
            <div class="flex items-baseline">
                <x-text-input id="description"
                              class="block mt-1 w-full text-gray-700 bg-gray-200 bg-clip-padding border border-solid border-gray-300"
                              type="text" name="description" :value="$store->domain"/>
            </div>
        </div>

        <!-- company logo -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('logo')"/>
            <input
                class="mt-1 form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                type="file"
                id="formFileMultiple"
                name="logo"
            />

            @if(tenant()->logo)
                <div class="mt-4">
                    <img src="{{ tenant_asset(tenant()->logo) }}" class="w-full hover:scale-110 transition duration-300 ease-in-out" alt="..." style="object-fit: contain; max-height: 150px; max-width: 200px">
                </div>
            @endif
        </div>


        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Salvar') }}
            </x-primary-button>
        </div>

    </form>
</x-app-layout>
