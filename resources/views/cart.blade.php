<x-guest-layout>
    <!--SHOPPING CART-->
    @php
        $total = 0;
        $cartItens = 0;
    @endphp

    @if ($cart)
        <div class="row g-4">
            <div class="col-md-8">
                <div class="row row-cards">
                    @forelse($cart as $item)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row g-2 align-items-center">
                                        <div class="col-auto">
                                            @if ($item['image'])
                                                <img src="{{ tenant_asset($item['image']) }}" class="avatar avatar-lg"
                                                    alt="..." style="object-fit: cover; max-height: 200px;">
                                            @else
                                                <img src="{{ asset('img/no-photo.png') }}" class="avatar avatar-lg"
                                                    alt="..." style="object-fit: cover; max-height: 200px;">
                                            @endif
                                        </div>
                                        <div class="col-5">
                                            <h4 class="card-title m-0">
                                                <a href="#">{{ $item['name'] }}</a>
                                            </h4>
                                            <div class="text-muted">
                                                {{ $item['description'] }}
                                            </div>
                                        </div>
                                        <div class="col">
                                            <a href={{ route('cart.remove', ['productSlug' => $item['slug']]) }}
                                                class="btn btn-link">Remove</a>
                                        </div>
                                        <div class="col-auto">
                                            <div class="display-6 my-3">
                                                <x-money :amount="$item['price']" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $total += (float) $item['price'];
                            $cartItens = $cartItens + 1;
                        @endphp
                    @empty
                        <p>Sem produtos</p>
                    @endforelse
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Resumo</h3>
                        <dl class="row">
                            <dt class="col-5">Quantidade:</dt>
                            <dd class="col-7">{{ $cartItens }}</dd>
                            <dt class="col-5">Total</dt>
                            <dd class="col-7">
                                <x-money :amount="$total" />
                            </dd>
                        </dl>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <a href="{{ route('front.store') }}" class="btn btn-link">Continuar comprando</a>
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary ms-auto">Fazer pedido</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        Carrinho de compras vazio</div>
    @endif
</x-guest-layout>
