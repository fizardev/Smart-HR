@extends('inc.layout')
@section('title', 'Marketing Dashboard')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div id="map" style="width:100%;height:400px;"></div>
                            <input type="hidden" name="location" id="location">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('plugin')

    <script>
        function myMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    let location = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    let mapProp = {
                        center: location,
                        zoom: 15,
                    };

                    let map = new google.maps.Map(document.getElementById("map"), mapProp);

                    let marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                });
            } else {
                console.log("Browser ini tidak support geolokasi!");
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXAfkYEcQcjKOO_za4EirUw9_ASmpf5fY&callback=myMap" async
        defer></script>
@endsection
