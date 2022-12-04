<x-guest-layout>
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none text-white">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            {{ $store->name }}
                        </div>
                        <h2 class="page-title">
                            {{ $store->name }}
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <span class="d-none d-sm-inline">
                                <a href="#" class="btn btn-dark">
                                    New view
                                </a>
                            </span>
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-report">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Create new report
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-report" aria-label="Create new report">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards d-flex align-items-stretch"">
                    @forelse($products as $product)
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('cart.add', ['productSlug' => $product->slug]) }}"
                                class="card card-link text-center card-link-pop">
                                <div class="pt-2">
                                    @if ($product->images->count())
                                        <img src="{{ tenant_asset($product->images->first()->path) }}" class=""
                                            alt="..." style="object-fit: cover; max-height: 200px;">
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
            </div>
        </div>

    </div>


    <div class="">
        {{ $products->links() }}
    </div>
</x-guest-layout>
