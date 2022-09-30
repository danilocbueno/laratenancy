<x-guest-layout>
    <div class="container mx-auto mt-10">
        <h2 class="font-medium leading-tight text-3xl mt-0 mb-8 text-gray-800">Meus pedidos</h2>
        @forelse($orders as $key => $order)
        <div class="accordion" id="order-{{ $key }}">
            <div class="accordion-item bg-white border border-gray-200">
                <h2 class="accordion-header mb-0" id="heading-{{ $key }}">
                    <button
                        class="accordion-button relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left bg-white border-0 rounded-none transition focus:outline-none"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $key }}"
                        aria-expanded="true"
                        aria-controls="collapse-{{ $key }}"
                    >
                        Pedido #{{ $order->reference }} ({{ $order->created_at->diffForHumans() }})
                    </button>
                </h2>
                <div
                    id="collapse-{{ $key }}"
                    class="accordion-collapse collapse"
                    aria-labelledby="heading-{{ $key }}"
                    data-bs-parent="#order-{{ $key }}"
                >
                    <div class="accordion-body py-4 px-5">
                        <ul>
                            @foreach($order->items as $item)
                                <li class="text-sm text-gray-400 mb-2">{{ $item['name']}} (R$ {{$item['price'] }})</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p>Sem pedidos no momento</p>
        @endforelse

        <div class="mt-4">
            {{ $orders->links() }}
        </div>

    </div>
</x-guest-layout>
