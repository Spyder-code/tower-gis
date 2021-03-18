@extends('layouts.user')
@section('content')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <style>
        #mapid { height: 625px; width: 100%}
    </style>

    <section id="about" class="about">
        <div id="mapid"></div>
        <div class="container">
            <form action="{{ route('filter') }}" method="post">
                @csrf
            <div class="row">
                <div class="col m-3 p-2">
                        <h1 class="text-center text-4xl font-bold">Kecamatan</h1>
                        @foreach ($kecamatan as $item)
                            <label class="label"><input type="checkbox" class="kecamatan" value="{{ $item->id }}" name="kecamatan"> {{ $item->name }}</label><br>
                        @endforeach
                        <br>
                </div>
                <div class="col m-3 p-2">
                        <h1 class="text-center text-xs font-bold">Pemilik</h1>
                        @foreach ($pemilik as $item)
                            <label class="label"><input type="checkbox" class="pemilik" value="{{ $item->id }}" name="pemilik"> {{ $item->name }}</label><br>
                        @endforeach
                        <br>
                </div>
                <div class="col-2 m-3 p-3">
                    <h1 class="text-center text-xs font-bold">Tahun</h1>
                        <label class="label"><input type="checkbox" class="tahun" value="2019" name="tahun"> 2019</label><br>
                        <label class="label"><input type="checkbox" class="tahun" value="2020" name="tahun"> 2020</label><br>
                        <label class="label"><input type="checkbox" class="tahun" value="2021" name="tahun"> 2021</label><br>
                        <button type="button" id="btn" class="btn btn-sm btn-success my-3">Terapkan</button>
                </div>
            </div>
        </form>
        </div>
    </section><!-- End About Section -->

@endsection

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
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

        // $('.tahun').click(function () {
        //     var tahun = [];
        //     $('input[name=tahun]:checked').map(function() {
        //             tahun.push($(this).val());
        //     });

        // });
        // $('.pemilik').click(function (e) {
        //     var pemilik = [];
        //     $('input[name=pemilik]:checked').map(function() {
        //             pemilik.push($(this).val());
        //     });
        //     console.log(pemilik);
        // });
        // $('.kecamatan').click(function (e) {
        //     var kecamatan = [];
        //     $('input[name=kecamatan]:checked').map(function() {
        //             kecamatan.push($(this).val());
        //     });
        //     console.log(kecamatan);
        // });

        $('#btn').click(function () {
            var tahun = [];
            $('input[name=tahun]:checked').map(function() {
                    tahun.push($(this).val());
            });
            var pemilik = [];
            $('input[name=pemilik]:checked').map(function() {
                    pemilik.push($(this).val());
            });
            var kecamatan = [];
            $('input[name=kecamatan]:checked').map(function() {
                    kecamatan.push($(this).val());
            });
            $.ajax({
                    url: 'filter',
                    data: {kecamatan:kecamatan,pemilik:pemilik,tahun:tahun},
                    type:"POST",
                    success: function(data){
                        console.log(data);
                    }
            });
        });
</script>
@endsection
