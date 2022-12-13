<x-guest-layout>
    <div class="row row-cards d-flex align-items-stretch"">
        <div class="col-12">
            <h1>Produtos</h1>
        </div>
        @forelse($products as $product)
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('front.single', ['slug' => $product->slug]) }}"
                    class="card card-link text-center card-link-pop">
                    <div class="pt-2">
                        @if ($product->images->count())
                            <img src="{{ tenant_asset($product->images->first()->path) }}" class="" alt="..."
                                style="object-fit: cover; max-height: 200px;">
                        @else
                            <img src="{{ asset('img/no-photo.png') }}" class="" alt="..."
                                style="object-fit: cover; max-height: 200px;">
                        @endif
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">{{ $product->name }}</h3>
                        <p class="text-muted">{{ $product->description }}</p>
                        <div class="display-6 fw-bold my-3">R$ {{ $product->price }}</div>
                    </div>
                </a>
            </div>
        @empty
            <p>Ainda não temos produtos cadastrados</p>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>


</x-guest-layout>
