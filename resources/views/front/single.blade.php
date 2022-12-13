<x-guest-layout>
    <div class="row">
        <div class="col-4">
            @forelse($product->images as $key =>  $image)
                <div class="@if ($key == 0) w-full @else w-1/3 @endif p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                        src="{{ tenant_asset($image->path) }}">
                </div>
            @empty
                <div class="w-full p-1 md:p-2">
                    <img src="{{ asset('img/no-photo.png') }}" class="rounded-t-lg h-50" alt="..."
                        style="object-fit: cover">
                </div>
            @endforelse
        </div>
        <div class="col-8 mt-2">
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>
            <a href="{{ route('cart.add', ['productSlug' => $product->slug]) }}" class="btn btn-primary d-none d-sm-inline-block">
                Comprar Agora
            </a>
        </div>
    </div>







</x-guest-layout>
