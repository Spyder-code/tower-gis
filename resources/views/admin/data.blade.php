<x-app-layout>
    <x-slot name="style">
        <!--Regular Datatables CSS-->
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
        <style>
            .modal {
                transition: opacity 0.25s ease;
            }
            body.modal-active {
                overflow-x: hidden;
                overflow-y: visible !important;
            }
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
                    <x-nav-link :href="route('data')" :active="request()->routeIs('data')">
                        {{ __('Data Management') }}
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
                    <x-auth-validation-errors class="mb-4 text-center" :errors="$errors" />
                    <div class="grid grid-cols-2 gap-5">
                        <div class="table-1">
                            <h1 class="text-center text-4xl font-bold my-2">Pemilik ({{ $pemilik->count() }})</h1>
                            <form action="{{ route('pemilik.store') }}" method="post">
                                @csrf
                                <label class="block my-3">
                                    <input type="text" class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" value="{{ old('name') }}" name="name" placeholder="Click here to add pemilik"/>
                                </label>
                                <button type="submit" class=" inline-block m-2 md:m-5 border border-green-300 bg-green-400 text-white md:py-1 md:px-5 p-1 rounded w-full text-center">
                                    <i class="fas fa-plus-circle"></i> Create
                                </button>
                            </form>
                            <div class="border-black-300 rounded">
                                <table id="table-1" class="table-auto border-separate hover whitespace-normal text-left" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                    <thead>
                                        <tr>
                                            <th class="border border-blue-600 bg-blue-400 text-white">No</th>
                                            <th class="border border-blue-600 bg-blue-400 text-white">Name</th>
                                            <th class="border border-blue-600 bg-blue-400 text-white">Jumlah</th>
                                            <th class="border border-blue-600 bg-blue-400 text-white">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pemilik as $item)
                                        <tr>
                                            <td class="border border-gray-600">{{ $loop->iteration }}</td>
                                            <td class="border border-gray-600">{{ $item->name }}</td>
                                            <td class="border border-gray-600">{{ $pemilikCount[$loop->index] }}</td>
                                            <td class="border border-gray-600">
                                                <div class="flex flex-auto">
                                                    <div x-data="{ tooltip: false }" class="relative z-30 inline-flex mx-1">
                                                        <a href="{{ route('pemilik.edit',['pemilik'=>$item->id]) }}" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="rounded-md px-3 py-2 bg-yellow-500 text-white cursor-pointer shadow">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                                            <div class="absolute top-0 z-10 w-32 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-yellow-500 rounded-lg shadow-lg">Edit pemilik</div>
                                                            <svg class="absolute z-10 w-6 h-6 text-yellow-500 transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
                                                                <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                <form action="{{ route('pemilik.destroy',['pemilik'=>$item->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div x-data="{ tooltip: false }" class="relative z-30 inline-flex mx-1">
                                                        <button type="submit" onclick="return confirm('Are you sure?')" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="rounded-md px-3 py-2 bg-red-500 text-white cursor-pointer shadow">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                                            <div class="absolute top-0 z-10 w-32 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-red-500 rounded-lg shadow-lg">Delete pemilik</div>
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
                        <div class="table-2">
                            <h1 class="text-center text-4xl font-bold my-2">Kecamatan ({{ $kecamatan->count() }})</h1>
                            <form action="{{ route('kecamatan.store') }}" method="post">
                                @csrf
                                <label class="block my-3">
                                    <input type="text" class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" value="{{ old('name') }}" name="name" placeholder="Click here to add kecamatan"/>
                                </label>
                                <button type="submit" class=" inline-block m-2 md:m-5 border border-green-300 bg-green-400 text-white md:py-1 md:px-5 p-1 rounded w-full text-center">
                                    <i class="fas fa-plus-circle"></i> Create
                                </button>
                            </form>
                            <div class="border-black-300 rounded">
                                <table id="table-2" class="table-auto border-separate hover whitespace-normal text-left" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                    <thead>
                                        <tr>
                                            <th class="border border-blue-600 bg-blue-400 text-white">No</th>
                                            <th class="border border-blue-600 bg-blue-400 text-white">Name</th>
                                            <th class="border border-blue-600 bg-blue-400 text-white">Jumlah</th>
                                            <th class="border border-blue-600 bg-blue-400 text-white">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kecamatan as $item)
                                        <tr>
                                            <td class="border border-gray-600">{{ $loop->iteration }}</td>
                                            <td class="border border-gray-600">{{ $item->name }}</td>
                                            <td class="border border-gray-600">{{ $kecamatanCount[$loop->index] }}</td>
                                            <td class="border border-gray-600">
                                                <div class="flex flex-auto">
                                                    <div x-data="{ tooltip: false }" class="relative z-30 inline-flex mx-1">
                                                        <a href="{{ route('kecamatan.edit',['kecamatan'=>$item->id]) }}" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="rounded-md px-3 py-2 bg-yellow-500 text-white cursor-pointer shadow">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                                            <div class="absolute top-0 z-10 w-32 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-yellow-500 rounded-lg shadow-lg">Edit kecamatan</div>
                                                            <svg class="absolute z-10 w-6 h-6 text-yellow-500 transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
                                                                <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                <form action="{{ route('kecamatan.destroy',['kecamatan'=>$item->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div x-data="{ tooltip: false }" class="relative z-30 inline-flex mx-1">
                                                        <button type="submit" onclick="return confirm('Are you sure?')" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="rounded-md px-3 py-2 bg-red-500 text-white cursor-pointer shadow">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                                            <div class="absolute top-0 z-10 w-32 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-red-500 rounded-lg shadow-lg">Delete kecamatan</div>
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
        </div>
    </div>

    <x-slot name="script">
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function() {

                $('#table-1').DataTable()
                $('#table-2').DataTable()
            } );
        </script>
    </x-slot>

</x-app-layout>

