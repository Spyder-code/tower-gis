<x-app-layout>

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
                    <x-nav-link :href="route('transaksi.edit',['transaksi'=>$tower->id])" :active="request()->routeIs('transaksi.edit',['transaksi'=>$tower->id])">
                        {{ __('Transaction Edit') }}
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
                    <h1 class="text-center text-4xl font-bold">Edit Transaction</h1>
                    <x-auth-validation-errors class="mb-4 text-center" :errors="$errors" />
                    <form action="{{ route('transaksi.update',['transaksi'=>$transaksi->id]) }}" method="post">
                        @csrf
                        @method('PUT')
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
                            <input type="text" class="uang mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" value="{{ $transaksi->uang }}" name="uang" />
                        </label>
                        <label class="block my-3">
                            <span class="text-gray-700">Tahun</span>
                            <input type="number" class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" value="{{ $transaksi->tahun }}" name="tahun" />
                        </label>
                        <div class="text-center">
                            <button type="submit" class="p-2 bg-green-400 rounded-lg text-white my-3 w-full"><i class="fas fa-plus-circle"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                $( '.uang' ).mask('000.000.000.000', {reverse: true});
            })
        </script>
    </x-slot>
</x-app-layout>
