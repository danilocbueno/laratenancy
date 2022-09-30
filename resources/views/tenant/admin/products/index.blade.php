<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a
                href="{{ route('admin.products.create') }}"
                class="px-4 py-2 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                Cadastrar produto
            </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <div class="grid md:grid-cols-4 gap-x-6 gap-y-10">
                    @forelse($products as $product)
                        <div class="flex justify-center">
                            <div class="rounded-lg shadow-lg bg-white max-w-sm">
                                <a href="{{ route('front.single', ['slug' => $product->slug]) }}">
                                    <img class="rounded-t-lg" src="https://mdbootstrap.com/img/new/standard/nature/184.jpg" alt=""/>
                                </a>
                                <div class="p-6">
                                    <h5 class="text-gray-900 text-xl font-medium mb-2">{{ $product->name }}</h5>
                                    <p class="text-gray-700 text-base mb-4">
                                        {{ $product->description }}
                                    </p>
                                    <p class="text-red-700 text-base mb-4">
                                        R$ {{ $product->price }}
                                    </p>
                                    <button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Comprar</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Ainda não temos produtos cadastrados</p>
                    @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
