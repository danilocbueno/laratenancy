<x-guest-layout>
        <div class="text-center bg-gray-50 text-gray-800 py-10 px-6">
            <h1 class="text-1xl md:text-2xl xl:text-3xl tracking-tight ">Bem vindo a</h1>
            <h2 class="text-4xl md:text-5xl xl:text-6xl font-bold tracking-tight text-blue-600">{{ $store->name }}</h2>
        </div>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 ">
                        <div class="grid md:grid-cols-4 gap-x-6 gap-y-10">
                            @forelse($products as $product)
                                <div class="flex justify-center">
                                    <div class="rounded-lg shadow-lg bg-white max-w-sm">
                                        <a href="#!">
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
                                            <a href="{{ route('cart.add', ['productSlug' =>  $product->slug]) }}" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Comprar</a>
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
    </div>
</x-guest-layout>
