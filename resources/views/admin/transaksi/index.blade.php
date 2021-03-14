<x-app-layout>
    <x-slot name="style">
        <!--Regular Datatables CSS-->
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
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
                    <x-nav-link :href="route('transaksi.show',['transaksi'=>$tower->id])" :active="request()->routeIs('transaksi.*')">
                        {{ __('Towers Transaction') }}
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
                        <a href="{{ route('tower.index') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                    </div>
                    <div class=" inline-block m-2 md:m-5 border border-green-300 bg-green-400 text-white md:py-1 md:px-5 p-1 rounded">
                        <a href="{{ route('transaksi.edit',['transaksi'=>$tower->id]) }}"><i class="fas fa-plus-circle"></i> Create</a>
                    </div>
                    <h1 class="text-center text-4xl font-bold">{{ $tower->pemilik }}</h1>
                    <p class="text-center">{{ $tower->alamat }}</p>
                    <p class="text-center">{{ $tower->kecamatan }}</p>
                    <div class="border-black-300 rounded">
                        <table id="example" class="table-auto stripe border-separate hover whitespace-normal text-left" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                            <thead>
                                <tr>
                                    <th class="border border-blue-600 bg-blue-400 text-white">No.</th>
                                    <th class="border border-blue-600 bg-blue-400 text-white">Uang</th>
                                    <th class="border border-blue-600 bg-blue-400 text-white">Tahun</th>
                                    <th class="border border-blue-600 bg-blue-400 text-white">Tanggal Pembayaran</th>
                                    <th class="border border-blue-600 bg-blue-400 text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="border border-gray-600">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-600">Rp. {{ $item->uang }}</td>
                                    <td class="border border-gray-600">{{ $item->tahun }}</td>
                                    <td class="border border-gray-600">{{ date('d/m/y', strtotime($item->created_at)) }}</td>
                                    <td class="border border-gray-600">
                                        <div class="flex flex-auto">
                                            <div x-data="{ tooltip: false }" class="relative z-30 inline-flex mx-1">
                                                <a href="{{ route('transaksi.tulis',['transaksi'=>$item->id]) }}" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="rounded-md px-3 py-2 bg-yellow-500 text-white cursor-pointer shadow">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                                    <div class="absolute top-0 z-10 w-32 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-yellow-500 rounded-lg shadow-lg">Edit transaksi</div>
                                                    <svg class="absolute z-10 w-6 h-6 text-yellow-500 transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
                                                        <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                                                    </svg>
                                                </div>
                                            </div>
                                        <form action="{{ route('transaksi.destroy',['transaksi'=>$item->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div x-data="{ tooltip: false }" class="relative z-30 inline-flex mx-1">
                                                <button type="submit" onclick="return confirm('Are you sure?')" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="rounded-md px-3 py-2 bg-red-500 text-white cursor-pointer shadow">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                                    <div class="absolute top-0 z-10 w-32 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-red-500 rounded-lg shadow-lg">Delete transaksi</div>
                                                    <svg class="absolute z-10 w-6 h-6 text-red-500 transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
                                                        <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function() {

                var table = $('#example').DataTable()
            } );
            function toggle(source) {
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] != source)
                        checkboxes[i].checked = source.checked;
                }
            }
        </script>
    </x-slot>

</x-app-layout>

