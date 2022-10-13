<x-guest-layout>
    <!-- Container for demo purpose -->
    <div class="container my-12 px-6 mx-auto">

        <!-- Section: Design Block -->
        <section class="mb-32 text-gray-800 text-center md:text-left">
            <div class="block rounded-lg bg-white">
                <div class="flex flex-wrap items-center">
                    <div class="grow-0 shrink-0 basis-auto block lg:flex w-full lg:w-4/12 xl:w-4/12">
                        <div class="flex flex-wrap">
                            <div class="flex flex-wrap w-full">
                                @forelse($product->images as $key =>  $image)
                                    <div class="@if($key == 0) w-full @else w-1/3 @endif p-1 md:p-2">
                                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                             src="{{ tenant_asset($image->path) }}">
                                    </div>
                                @empty
                                    <div class="w-full p-1 md:p-2">
                                        <img src="{{ asset('img/no-photo.png') }}" class="rounded-t-lg h-50" alt="..." style="object-fit: cover">
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>

                    <div class="grow-0 shrink-0 basis-auto w-full lg:w-8/12 xl:w-8/12">
                        <div class="px-6 py-12 md:px-12">
                            <h2 class="text-3xl font-bold mb-6 pb-2">{{ $product->name }}</h2>
                            <p class="text-gray-500 mb-6 pb-2">
                               {{ $product->description }}
                            </p>
                            <div class="flex flex-wrap mb-6">
                                <div class="w-full lg:w-6/12 xl:w-4/12 mb-4">
                                    <p class="flex items-center justify-center md:justify-start">
                                        <svg class="w-4 h-4 mr-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                  d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z">
                                            </path>
                                        </svg>Noise cancelling
                                    </p>
                                </div>
                                <div class="w-full lg:w-6/12 xl:w-4/12 mb-4">
                                    <p class="flex items-center justify-center md:justify-start">
                                        <svg class="w-4 h-4 mr-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                  d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z">
                                            </path>
                                        </svg>Touch controls
                                    </p>
                                </div>
                                <div class="w-full lg:w-6/12 xl:w-4/12 mb-4">
                                    <p class="flex items-center justify-center md:justify-start">
                                        <svg class="w-4 h-4 mr-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                  d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z">
                                            </path>
                                        </svg>Clear calls
                                    </p>
                                </div>
                            </div>
                            <button type="button"
                                    class="inline-block px-7 py-3 bg-gray-800 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                                Buy now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Design Block -->

    </div>
    <!-- Container for demo purpose -->
</x-guest-layout>
