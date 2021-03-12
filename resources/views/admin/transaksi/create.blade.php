<x-app-layout>
    <x-slot name="style">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <style>
            #mapid { height: 300px; }
        </style>
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <ul class="flex text-gray-500 text-sm lg:text-base">
                <li class="inline-flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <svg class="h-5 w-auto text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
                <li class="inline-flex items-center">
                    <x-nav-link :href="route('tower.index')" :active="request()->routeIs('tower.index')">
                        {{ __('Towers Management') }}
                    </x-nav-link>
                    <svg class="h-5 w-auto text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
                <li class="inline-flex items-center">
                    <x-nav-link :href="route('tower.index')" :active="request()->routeIs('transaksi.show')">
                        {{ __('Towers Transaction') }}
                    </x-nav-link>
                    <svg class="h-5 w-auto text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
                <li class="inline-flex items-center">
                    <x-nav-link :href="route('transaksi.edit',['transaksi'=>$tower->id])" :active="request()->routeIs('transaksi.show')">
                        {{ __('Transaction Create') }}
                    </x-nav-link>
                    <svg class="h-5 w-auto text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
            </ul>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class=" inline-block m-2 md:m-5 border border-blue-300 bg-blue-400 text-white md:py-1 md:px-5 p-1 rounded">
                        <a href="{{ route('transaksi.show',['transaksi'=>$tower->id]) }}"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                    </div>
                    <h1 class="text-center text-4xl font-bold">Create Transaction</h1>
                    <form action="{{ route('transaksi.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="tower_id" value="{{ $tower->id }}">
                        <label class="block my-3">
                            <span class="text-gray-700">Pemilik Tower</span>
                            <input type="text" readonly class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" value="{{ $tower->pemilik }}" />
                        </label>
                        <label class="block my-3">
                            <span class="text-gray-700">Alamat Tower</span>
                            <input type="text" readonly class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" value="{{ $tower->alamat }}" />
                        </label>
                        <label class="block my-3">
                            <span class="text-gray-700">Jumlah Uang</span>
                            <input type="number" class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" value="{{ old('uang') }}" name="uang" />
                        </label>
                        <label class="block my-3">
                            <span class="text-gray-700">Tahun</span>
                            <input type="number" class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" value="{{ old('tahun') }}" name="tahun" />
                        </label>
                        <div class="text-center">
                            <button type="submit" class="p-2 bg-green-400 rounded-lg text-white my-3 w-full"><i class="fas fa-plus-circle"></i> Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
