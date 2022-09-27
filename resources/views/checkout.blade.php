<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    ID:
                    {{ $preference['id'] }}
                    <div class="cho-container"></div>
                </div>
            </div>
        </div>
    </div>
    // SDK MercadoPago.js V2
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago('TEST-d6f245df-b00a-4158-9916-9ec9a708f213', {
            locale: 'pt-BR'
        });

        mp.checkout({
            preference: {
                id: '{{ $preference['id'] }}'
            },
            render: {
                container: '.cho-container',
                label: 'Pagar',
            }
        });
    </script>
</x-guest-layout>
