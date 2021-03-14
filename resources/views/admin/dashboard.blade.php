<x-app-layout>

    <x-slot name="style">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <style>
            #mapid { height: 500px; }
        </style>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-1 md:my-6">
                            <div class="flex flex-col items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-3 bg-gray-300"><i class="fa fa-signal fa-fw fa-inverse text-indigo-500"></i></div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-3xl text-center">{{ $tower->count() }} <span class="text-green-500"></h3>
                                    <h5 class="font-bold text-gray-500">Total Tower</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-1 md:my-6">
                            <div class="flex flex-col items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-3 bg-gray-300"><i class="fa fa-dollar-sign fa-fw fa-inverse text-indigo-500"></i></div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-3xl text-center">{{ $transaksi->count() }} <span class="text-green-500"></h3>
                                    <h5 class="font-bold text-gray-500">Total Transaksi</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-1 md:my-6">
                            <div class="flex flex-col items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-3 bg-gray-300"><i class="fa fa-users fa-fw fa-inverse text-indigo-500"></i></div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-3xl text-center">{{ $towerPemilik->count() }} <span class="text-green-500"></h3>
                                    <h5 class="font-bold text-gray-500">Total Pemilik</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-1 md:my-6">
                            <div class="flex flex-col items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-3 bg-gray-300"><i class="fa fa-map-marked-alt fa-fw fa-inverse text-indigo-500"></i></div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-3xl text-center">{{ $towerKecamatan->count() }} <span class="text-green-500"></h3>
                                    <h5 class="font-bold text-gray-500">Total Kecamatan</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-3">
                    <div class="flex">
                        <div class="w-3/4">
                            <div id="mapid"></div>
                        </div>
                        <div class="w-1/4 p-4">
                            <div class="grid grid-cols-1">
                                <div>
                                        @foreach ($towerKecamatan as $item)
                                            <label><input type="checkbox" name="kecamatan[]" class="kecamatan" value="{{ $item->kecamatan }}"> {{ $item->kecamatan }}</label><br>
                                        @endforeach
                                </div>
                                {{-- <div>
                                    @foreach ($towerPemilik as $item)
                                        <label><input type="checkbox" name="pemilik" value="{{ $item->pemilik }}"> {{ $item->pemilik }}</label><br>
                                    @endforeach
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            var data = {!! json_encode($tower) !!};
            var map = L.map('mapid').setView([-7.452792, 112.411676], 12);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibHVheXN5YXVxaWxsYWgiLCJhIjoiY2sxeGt1ZHZlMDhyOTNsb2lxZWlxbmFsdiJ9.DO8qDjsP0y18UTAS5MxxXQ', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibHVheXN5YXVxaWxsYWgiLCJhIjoiY2sxeGt1ZHZlMDhyOTNsb2lxZWlxbmFsdiJ9.DO8qDjsP0y18UTAS5MxxXQ'
            }).addTo(map);
                // var locations = [
                //     ["LOCATION_1", 11.8166, 122.0942],
                //     ["LOCATION_2", 11.9804, 121.9189],
                //     ["LOCATION_3", 10.7202, 122.5621],
                //     ["LOCATION_4", 11.3889, 122.6277],
                //     ["LOCATION_5", 10.5929, 122.6325]
                // ];

                var greenIcon = L.icon({
                    iconUrl: {!! json_encode(asset('images/tower.png')) !!},
                    iconSize:     [32, 37], // size of the icon
                    iconAnchor:   [16, 37], // point of the icon which will correspond to marker's location
                    shadowAnchor: [4, 62],  // the same for the shadow
                    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                });

                for (var i = 0; i < data.length; i++) {
                marker = new L.marker([data[i].latitude, data[i].longitude], {icon: greenIcon} )
                    .bindPopup("<b>"+data[i].pemilik+"</b><br>"+data[i].alamat+".")
                    .addTo(map);
                }

                var data = $('.kecamatan:checked').val();
                console.log(data);
                // $('.kecamatan').click(function () {
                //     var data = $(this).val();
                //     console.log(data);
                // });
                // $('#form').submit(function (e) {
                //     e.preventDefault();
                //     var data = $('.kecamatan').val();
                //     console.log(data);
                //     $.ajax({
                //         url: {!! json_encode(url('map/filter')) !!},
                //         data: data,
                //         }).success(function(data) {
                //             console.log(data);
                //     });
                // });
        </script>
    </x-slot>
</x-app-layout>
