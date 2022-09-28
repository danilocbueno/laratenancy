<x-tenant-layout>
    <!-- Section: Design Block -->
    <section class="mt-20 mb-32 text-gray-800 text-center">

        <div class="flex justify-center">
            <div class="max-w-[800px]">
                <h2 class="text-5xl md:text-6xl xl:text-7xl font-bold tracking-tight mb-12">
                    Se torne agora <br />
                    <span class="text-blue-600">um lojista!</span>
                </h2>
                <p class="text-gray-500 text-lg">
                    Faça seu <a href="{{ route('tenant.create') }}" class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out mb-4">cadastro</a> ou <a href="{{ route('tenant.index') }}" class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out mb-4">navegue nas lojas</a> cadastradas na plataforma
                </p>
            </div>
        </div>

    </section>
</x-tenant-layout>
