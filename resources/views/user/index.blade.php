@extends('layouts.user')
@section('content')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <style>
        #mapid { height: 525px; width: 100%}
    </style>

    <section id="about" class="about">
        <div class="container my-4 border border-primary p-3">
            <div class="row">
                <div class="col">
                    <div id="mapid"></div>
                </div>
                <div class="col-sm-2">
                    <h3 class="text-center font-bold">Kecamatan</h3>
                        <label class="label"><input type="checkbox" class="check" onClick="toggle(this)"> All</label><br>
                        @foreach ($kecamatan as $item)
                        <label class="label"><input type="checkbox" class="check" value="{{ $item->id }}" name="kecamatan"> {{ $item->name }}</label><br>
                        @endforeach
                        <h3 class="text-center font-bold">Tahun</h3>
                        <label class="label"><input type="checkbox" class="check" value="2019" name="tahun"> 2019</label>
                        <label class="label"><input type="checkbox" class="check" value="2020" name="tahun"> 2020</label>
                        <label class="label"><input type="checkbox" class="check" value="2021" name="tahun"> 2021</label>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->
    <section id="resume" class="resume">
        <div class="container my-4 border border-primary p-3">
            <div class="row">
                <div class="col">
                    <canvas id="myChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </section><!-- End resume Section -->

@endsection

@section('script')
<script>
    function toggle(source) {
        checkboxes = document.getElementsByName('kecamatan');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
        var map = L.map('mapid').setView([-7.452792, 112.411676], 12);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibHVheXN5YXVxaWxsYWgiLCJhIjoiY2sxeGt1ZHZlMDhyOTNsb2lxZWlxbmFsdiJ9.DO8qDjsP0y18UTAS5MxxXQ', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibHVheXN5YXVxaWxsYWgiLCJhIjoiY2sxeGt1ZHZlMDhyOTNsb2lxZWlxbmFsdiJ9.DO8qDjsP0y18UTAS5MxxXQ'
        }).addTo(map);

            var greenIcon = L.icon({
                iconUrl: {!! json_encode(asset('images/tower.png')) !!},
                iconSize:     [32, 37], // size of the icon
                iconAnchor:   [16, 37], // point of the icon which will correspond to marker's location
                shadowAnchor: [4, 62],  // the same for the shadow
                popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
            });

        var mapMarkers = [];
        $('.check').click(function () {
            var tahun = [];
            var a;
            $('input[name=tahun]:checked').map(function() {
                var val = $(this).val();
                tahun.push(parseInt(val));
            });
            var kecamatan = [];
            $('input[name=kecamatan]:checked').map(function() {
                var val = $(this).val();
                kecamatan.push(parseInt(val));
            });
            $.ajax({
                    url: 'filter',
                    data: {kecamatan:kecamatan,tahun:tahun},
                    type:"POST",
                    async: false,
                    success: function(data){
                        a = data
                    }
            });
            for(var i = 0; i < mapMarkers.length; i++){
                map.removeLayer(mapMarkers[i]);
            }
            for (var i = 0; i < a.length; i++) {
                marker = L.marker([a[i].latitude, a[i].longitude], {icon: greenIcon} )
                    .bindPopup("<h5 class='text-center text-success'>"+a[i].pemilik+"</h5><p>"+a[i].alamat+".</p><h5 class='text-center'>"+a[i].status+"</h5>")
                    .addTo(map);
                    mapMarkers.push(marker)
                }

        });
        var ctx = document.getElementById('myChart');
        var kecamatanName = {!! json_encode($kecamatanName) !!};
        var kecamatanCount = {!! json_encode($kecamatanCount) !!};
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: kecamatanName,
        datasets: [{
            label: 'Jumlah tower pada kecamatan',
            data: kecamatanCount,
            backgroundColor:
            'rgba(54, 162, 235, 0.2)',
            // borderColor: [
            //     'rgba(255, 99, 132, 1)',
            //     'rgba(54, 162, 235, 1)',
            //     'rgba(255, 206, 86, 1)',
            //     'rgba(75, 192, 192, 1)',
            //     'rgba(153, 102, 255, 1)',
            //     'rgba(255, 159, 64, 1)'
            // ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endsection
