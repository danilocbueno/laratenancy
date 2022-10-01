<x-guest-layout>
    <div class="px-6 py-12 md:px-12 bg-gray-100 text-gray-800 text-center lg:text-center">
        <div class="container mx-auto xl:px-32">
            <div class="">
                <div class="mt-12 lg:mt-0">
                    <h1 class="text-3xl md:text-4xl xl:text-5xl tracking-tight ">você está em a<span class="font-bold  text-blue-600"> {{ $store->name }}</span></h1>
                    <p class="text-gray-600">
                        {{ $store->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 ">
                        <div class="grid md:grid-cols-4 gap-x-6 gap-y-10">
                            @forelse($products as $product)
                                <div class="flex justify-center">
                                    <div class="rounded-lg bg-white max-w-sm">
                                        <a href="{{ route('front.single', ['slug' => $product->slug]) }}">
                                            @if($product->images->count())
                                                <img src="{{ tenant_asset($product->images->first()->path) }}" class="w-full hover:scale-110 transition duration-300 ease-in-out" alt="..." style="object-fit: cover; max-height: 200px;">
                                            @else
                                                <img src="{{ asset('img/no-photo.png') }}" class="w-full hover:scale-110 transition duration-300 ease-in-out" alt="..." style="object-fit: cover; max-height: 200px;">
                                            @endif
                                        </a>
                                        <div class="p-6">
                                            <h5 class="text-gray-900 text-xl font-medium">{{ $product->name }}</h5>
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
