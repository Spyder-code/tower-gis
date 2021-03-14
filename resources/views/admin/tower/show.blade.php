<x-app-layout>
    <x-slot name="style">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <style>
            #mapid { height: 400px; }
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
                    <x-nav-link :href="route('tower.show',['tower' => $tower->id])" :active="request()->routeIs('tower.show',['tower' => $tower->id])">
                        {{ __('Towers Details') }}
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
                        <a href="{{ route('transaksi.show',['transaksi'=>$tower->id]) }}"><i class="fas fa-dollar-sign"></i> Show Transaction</a>
                    </div>
                    <h1 class="text-center text-4xl font-bold my-3">Tower Detail</h1><hr>
                    <div class="flex flex-auto">
                        <div class="w-3/4 mx-2">
                            <div id="mapid"></div>
                        </div>
                        <div class="w-1/4 mx-2">
                            <ul class="px-0">
                                <li class="list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                                    <i style="font-size: 20pt" class="text-blue-500 fas fa-city"></i>
                                    <p>{{ $tower->pemilik }}</p>
                                </li>
                                <li class="list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                                    <i style="font-size: 20pt" class="text-blue-500 fas fa-map-marked-alt"></i>
                                    <p>{{ $tower->alamat }}</p>
                                </li>
                                <li class="list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                                    <i style="font-size: 20pt" class="text-blue-500 fas fa-globe"></i>
                                    <p>{{ $tower->latitude }}, {{ $tower->longitude }}</p>
                                </li>
                                <li class="list-none rounded-sm px-3 py-3">
                                    <i style="font-size: 20pt" class="text-blue-500 fas fa-location-arrow"></i>
                                    <p>{{ $tower->kecamatan }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            $(function(){
                var kecamatan = {!! json_encode($kecamatan) !!};
                var pemilik = {!! json_encode($pemilik) !!}
                $( "#kecamatan" ).autocomplete({
                    source: kecamatan
                });
                $( "#pemilik" ).autocomplete({
                    source: pemilik
                });
            });
            var latitude = {!! json_encode($tower->latitude) !!}
            var longitude = {!! json_encode($tower->longitude) !!}
            var alamat = {!! json_encode($tower->alamat) !!}
            var pemilik = {!! json_encode($tower->pemilik) !!}
            var image = {!! json_encode(asset('images/tower.png')) !!}
            var map = L.map('mapid').setView([latitude, longitude], 16);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibHVheXN5YXVxaWxsYWgiLCJhIjoiY2sxeGt1ZHZlMDhyOTNsb2lxZWlxbmFsdiJ9.DO8qDjsP0y18UTAS5MxxXQ', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibHVheXN5YXVxaWxsYWgiLCJhIjoiY2sxeGt1ZHZlMDhyOTNsb2lxZWlxbmFsdiJ9.DO8qDjsP0y18UTAS5MxxXQ'
        }).addTo(map);

            var greenIcon = L.icon({
                iconUrl: image,
                iconSize:     [32, 37], // size of the icon
                iconAnchor:   [16, 37], // point of the icon which will correspond to marker's location
                shadowAnchor: [4, 62],  // the same for the shadow
                popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
            });

            marker = new L.marker([latitude, longitude], {icon: greenIcon})
                .bindPopup("<b>"+pemilik+"</b><br>"+alamat+".")
                .addTo(map);
        </script>
    </x-slot>
</x-app-layout>
