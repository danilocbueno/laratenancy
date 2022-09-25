<x-guest-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h3 class="text-2xl font-extrabold my-8"></h3>
        <hr>
        <h5 class="my-20 text-4xl text-center font-extrabold">Carrinho</h5>
        <hr>

        <div class="w-1/2 block mx-auto mt-10">
            @php $total = 0; @endphp
            @forelse($cart as $item)
                <div class="mb-4 flex justify-between">
                    <h5 class="text-bold text-2xl mb-4">{{$item['name']}}</h5>
                    <p>R$ {{number_format((float) ($item['price']), 2, ',', '.')}}</p>
                    <p><a class="font-bold text-red-700" href="{{route('cart.remove',[$item['slug']])}}">Remover</a></p>
                    @php $total += (float) $item['price'] @endphp
                </div>
            @empty
                <div class="w-full border border-yellow-600 bg-yellow-100 px-4 py-2 rounded text-yellow-600 font-bold text-xl">Nenhum item encontrado...</div>
            @endforelse

            @if($cart)
                <div class="border-t border-gray-200 flex justify-between pt-10">
                    <h5 class="text-bold text-2xl mb-4">Total</h5>
                    <p>R$ {{number_format($total, 2, ',', '.')}}</p>
                </div>

                <div class="border-t border-gray-200 flex justify-between pt-4 mt-10">

                    <a href="{{route('cart.cancel')}}"
                       class="text-xl font-bold px-4 py-2 rounded bg-red-600 text-white shadow hover:bg-red-300 transition ease-in-out delay-150 uppercase">Cancelar</a>

                    <a href="#"
                       class="text-xl font-bold px-4 py-2 rounded bg-green-600 text-white shadow hover:bg-green-300 transition ease-in-out delay-150 uppercase">Concluir</a>
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>
