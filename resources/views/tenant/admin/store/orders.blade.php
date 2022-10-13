<x-app-layout>
    <div class="container mx-auto mt-10">
        <h2 class="font-medium leading-tight text-3xl mt-0 mb-8 text-gray-800">Pedidos realizados</h2>
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
                    <div class="accordion-body py-4 px-5 flex justify-center gap-4">
                        <div class="flex justify-center">
                            <div class="block rounded-lg shadow-lg bg-white max-w-sm text-center">
                              <div class="py-3 px-6 border-b border-gray-300">
                                Produtos no pedido
                              </div>
                              <div class="p-6">
                                <p class="text-gray-700 text-base mb-4">
                                    <ul>
                                        @foreach($order->items['cartItems'] as $item)
                                            <li class="text-sm text-gray-400 mb-2">{{ $item['name']}} (R$ {{$item['price'] }})</li>
                                        @endforeach
                                    </ul>
            
                                </p>

                              </div>
                            </div>
                        </div>
                        @php
                           $mpPayment = $order->items['mercadoPagoPreference']
                        @endphp

                        <div class="flex justify-center">
                            <div class="block rounded-lg shadow-lg bg-white max-w-sm text-center">
                              <div class="py-3 px-6 border-b border-gray-300">
                                Pagamento MercadoPago
                              </div>
                              <div class="p-6">
                                <h5 class="text-gray-900 text-xl font-medium mb-2">Status: {{ $mpPayment['status'] }}</h5>
                                <p class="text-gray-700 text-base mb-4">
                                    collection_id = {{ $mpPayment['collection_id'] }} <br>
                                    preference_id = {{ $mpPayment['preference_id'] }}
                                </p>

                              </div>
                            </div>
                        </div>

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
</x-app-layout>
