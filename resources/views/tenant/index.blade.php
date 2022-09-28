<x-tenant-layout>

    <!-- Container for demo purpose -->
    <div class="container my-24 px-6 mx-auto">

        <!-- Section: Design Block -->
        <section class="mb-32 text-gray-800 text-center">

            <h2 class="text-3xl font-bold mb-12 text-center">Lojas cadastradas</h2>

            <div class="grid lg:grid-cols-3 gap-6 xl:gap-x-12">
                @forelse($tenants as $key => $tenant)
                <div class="mb-6 lg:mb-0">
                    <div>
                        <div
                            class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover ripple shadow-lg rounded-lg mb-6"
                            data-mdb-ripple="true" data-mdb-ripple-color="light">
                            <img src="https://picsum.photos/200/100?random={{$key + 1000}}"
                                 class="w-full" alt="Louvre" />
                            <a href="#!">
                                <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed opacity-0 hover:opacity-100 transition duration-300 ease-in-out"
                                     style="background-color: rgba(251, 251, 251, 0.2)"></div>
                            </a>
                        </div>

                        <h5 class="text-lg font-bold mb-3">{{ $tenant->name }}</h5>
                        <p class="text-gray-500">
                            {{ $tenant->company }}
                        </p>
                        <a href="//{{ $tenant->domain }}" class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out mb-4">{{ $tenant->domain }}</a>
                    </div>
                </div>
                @empty
                    <p class="text-gray-700 mb-4 text-center">
                        Sem lojas cadastradas, seja o primeiro
                    </p>
                @endforelse
            </div>

        </section>
        <!-- Section: Design Block -->

    </div>

</x-tenant-layout>
