@extends('layouts.master')
@section('css')

    @toastr_css

@section('title')
    {{ trans('maps_trans.title_page') }}

@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.maps') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <style type="text/css">
            #map {
                height: 400px;
                width: 100%;
            }
        </style>
    </head>

    <body>
    <div class="container mt-5">
        <h2>How to Add Google Map in Laravel? - ItSolutionStuff.com</h2>
        <div id="map"></div>
    </div>

    <script type="text/javascript">
        function codeAddress(geocoder, map) {
            let addresses = {!! json_encode($addresses) !!};
            let states = {!! json_encode($states) !!};
            let cities = {!! json_encode($cities) !!};
            let areas = {!! json_encode($areas) !!};

            for (const address of addresses) {
                let fullAddress = "Syria,";
                for (const state of states) {
                    if (address.state_id === state.id) {
                        fullAddress += state.name + ',';
                    }
                }
                for (const city of cities) {
                    if (address.city_id === city.id) {
                        fullAddress += city.name + ',';
                    }
                }
                for (const area of areas) {
                    if (address.area_id === area.id) {
                        fullAddress += area.name + ',';
                    }
                }

                console.log(fullAddress);
                geocoder.geocode({'address': fullAddress}, function (results, status) {
                    if (status === 'OK') {
                        map.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location
                        });
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
                fullAddress = "";
            }

        }

        function initMap() {
            const myLatLng = {lat: 33.510414, lng: 36.278336};
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8,
                center: myLatLng,
            });
            let geocoder = new google.maps.Geocoder();
            codeAddress(geocoder, map);
            /*let mapElement = 'map';
            let address = 'SYRIA';
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address': address}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    var mapOptions = {
                        zoom: 13,
                        center: results[0].geometry.location,
                        disableDefaultUI: true
                    };
                    var map = new google.maps.Map(document.getElementById(mapElement), mapOptions);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                }
                else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
                window.initMap = initMap;
            })*/
        }


    </script>

    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&lang={{app()->getLocale()}}"></script>

    </body>
    </html>

@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

