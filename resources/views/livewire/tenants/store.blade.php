<div>
    <x-slot name="header">Minha Loja</x-slot>
    @if(session()->has('success'))
        <div class="w-full px-2 py-4 border border-green-900 bg-green-400 text-green-900 rounded mb-10">
            {{session('success')}}
        </div>
    @endif

    <form>
        <div class="w-full mb-8">
            <label class="text-gray-700">Nome da loja</label>
            <input type="text" class="text-gray-700 border border-solid border-gray-300 rounded w-full rounded mt-2 @error('store.name') border-red-700 @enderror"  wire:model="store.name">

            @error('store.name')
            <strong class="block mt-4 text-red-700 font-bold">{{$message}}</strong>
            @enderror
        </div>

        <div class="w-full mb-8">
            <label class="text-gray-700">Descrição</label>
            <input type="text" class="text-gray-700 border border-solid border-gray-300 rounded w-full rounded mt-2 @error('store.description') border-red-700 @enderror" wire:model="store.description">

            @error('store.description')
            <strong class="block mt-4 text-red-700 font-bold">{{$message}}</strong>
            @enderror
        </div>

        <div class="w-full flex justify-between gap-2 mb-8">

            <div class="w-1/2">
                <label class="text-gray-700">Telefone Fixo</label>
                <input type="text" class="text-gray-700 border border-solid border-gray-300 rounded w-full rounded mt-2 @error('store.phone') border-red-700 @enderror" wire:model="store.phone">

                @error('store.phone')
                <strong class="block mt-4 text-red-700 font-bold">{{$message}}</strong>
                @enderror
            </div>

            <div class="w-1/2">
                <label class="text-gray-700">Celular</label>
                <input type="text" class="text-gray-700 border border-solid border-gray-300 rounded w-full rounded mt-2 @error('store.mobile_phone') border-red-700 @enderror" wire:model="store.mobile_phone">

                @error('store.mobile_phone')
                <strong class="block mt-4 text-red-700 font-bold">{{$message}}</strong>
                @enderror
            </div>

        </div>

        <button
            wire:click.prevent="saveStore"
            class="px-4 py-2 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
            Salvar
        </button>
    </form>



</div>
