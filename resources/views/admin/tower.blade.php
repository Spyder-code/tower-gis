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
                    <x-nav-link :href="route('tower')" :active="request()->routeIs('tower')">
                        {{ __('Towers Management') }}
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
                    <div class=" inline-block m-2 md:m-5 border border-green-300 bg-green-400 text-white md:py-1 md:px-5 p-1 rounded">
                        <a href="#"><i class="fas fa-plus-circle"></i> Create</a>
                    </div>
                    <div class="border-black-300 rounded">
                        <table id="example" class="table-auto border-separate border border-green-800 hover whitespace-normal text-left" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="border border-blue-600">Select</th>
                                    <th class="border border-blue-600" width="300px">Alamat</th>
                                    <th class="border border-blue-600">Kecamatan</th>
                                    <th class="border border-blue-600">Pemilik</th>
                                    <th class="border border-blue-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="border border-gray-600"><input type="checkbox" name="select[]" value="{{ $item->id }}"></td>
                                    <td class="border border-gray-600">{{ $item->alamat }}</td>
                                    <td class="border border-gray-600">{{ $item->kecamatan }}</td>
                                    <td class="border border-gray-600">{{ $item->pemilik }}</td>
                                    <td class="border border-gray-600">edit</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex border border-b-2 border-black-300 my-3">
                        <div class="flex-initial m-2 md:m-5">
                            <label for="check-all">
                                <input type="checkbox" name="check-all" onclick="toggle(this);" id="check-all"> Check All
                            </label>
                        </div>
                        <div class="flex-initial m-2 md:m-5 border border-blue-300 bg-blue-400 text-white md:py-1 md:px-5 p-1 rounded">
                            <a href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                        </div>
                        <div class="flex-initial m-2 md:m-5 border border-red-300 bg-red-400 text-white md:py-1 md:px-5 p-1 rounded">
                            <a href="#"><i class="fas fa-trash"></i> Delete</a>
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
                
                var table = $('#example').DataTable({
                    paging: true,
                    scrollY: 300,
                    scrollX: true
                })
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
