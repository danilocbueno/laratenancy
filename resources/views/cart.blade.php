<x-guest-layout>
    <!--SHOPPING CART-->
    @php $total = 0; $cartItens = 0; @endphp

    @if($cart)
    <div class="container mx-auto mt-10">
        <div class="flex  my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Carrinho de compras</h1>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Detalhes</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantidade</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Preço</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>
                @forelse($cart as $item)
                <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                    <div class="flex w-2/5"> <!-- product -->
                        <div class="w-20">
                            @if($item['image'])
                                <img src="{{ tenant_asset($item['image']) }}" class="w-full hover:scale-110 transition duration-300 ease-in-out" alt="..." style="object-fit: cover; max-height: 200px;">
                            @else
                                <img src="{{ asset('img/no-photo.png') }}" class="w-full hover:scale-110 transition duration-300 ease-in-out" alt="..." style="object-fit: cover; max-height: 200px;">
                            @endif
                        </div>
                        <div class="flex flex-col justify-between ml-4 flex-grow">
                            <span class="font-bold text-sm">{{$item['name']}}</span>
                            <span class="text-red-500 text-xs">{{$item['description']}}</span>
                            <a href={{route('cart.remove', ['productSlug' => $item['slug']])}} class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                        </div>
                    </div>
                    <div class="flex justify-center w-1/5">
                        <span class="text-sm">1</span>
                    </div>
                    <span class="text-center w-1/5 font-semibold text-sm">
                        <x-money :amount="$item['price']"/>
                    </span>
                    <span class="text-center w-1/5 font-semibold text-sm">
                        <x-money :amount="$item['price']"/>
                    </span>
                </div>
                @php
                    $total += (float) $item['price'];
                    $cartItens = $cartItens + 1;
                @endphp
                @empty
                    Sem produtos no carrinho
                @endforelse
            </div>

            <div id="summary" class="ml-4 bg-gray-200 w-1/4 px-8 py-10">
                <h1 class="font-semibold text-2xl border-b pb-8">Resumo</h1>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-semibold text-sm uppercase">Items</span>
                    <span class="font-semibold text-sm">{{ $cartItens }}</span>
                </div>
                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Total</span>
                        <x-money :amount="$total"/>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="inline-block mt-10 bg-blue-500 font-semibold hover:bg-blue-600 py-3 text-sm text-white uppercase text-center w-full">Fazer pedido</a>
                    <a href="{{ route('front.store') }}" class="flex justify-center font-semibold text-blue-600 text-sm mt-6">
                        <svg class="fill-current mr-2 text-blue-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
                        Continue comprando
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="container mx-auto mt-10">
            <div class="w-full border border-yellow-600 bg-yellow-100 px-4 py-2 rounded text-yellow-600 font-bold text-xl">Carrinho de compras vazio</div>
        </div>
    @endif
</x-guest-layout>
