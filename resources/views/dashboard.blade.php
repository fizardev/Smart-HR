@extends('inc.layout')
@section('title', 'Marketing Dashboard')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div id="map" style="width:100%;height:200px;"></div>
                            <div class="time-attendance row justify-content-center mb-4" style="color: #666666 !important;">
                                <span class="mt-4 col-md-12 text-center"
                                    style="font-size:1.2em">{{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}</span>
                                <h2 class="col-md-12 mt-2 text-center" id="waktu-realtime">
                                    {{ \Carbon\Carbon::now()->translatedFormat('H:i:s') }}</h2>
                                <div class="attendance-btn mt-2">
                                    <button class="btn btn-primary btn-sm btn-clock-in mr-1" id="clock_in">Clock
                                        In</button>
                                    <button class="btn btn-danger btn-sm btn-clock-in" id="clock_out">Clock Out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-container show">
                        <div class="panel-content">
                            @foreach ($attendances as $item)
                                <div class="list-attendance p-2" style="color: #666666 !important;">
                                    <div class="attendance-date-list d-flex justify-content-center py-1"
                                        style="border-top: 1px solid #666666;">
                                        <span class="d-block font-weight-bold"
                                            style="font-size: 1.2em">{{ \Carbon\Carbon::parse($item->date)->translatedFormat('j F Y') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-center pb-1"
                                        style="border-bottom: 1px solid #666666;">
                                        <span class="d-block mr-2">Clock in :
                                            {{ \Carbon\Carbon::parse($item->clock_in)->translatedFormat('H:i') }}</span>
                                        <span class="d-block">Clock out :
                                            {{ $item->clock_out == null ? '-' : \Carbon\Carbon::parse($item->clock_out)->translatedFormat('H:i') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('plugin')

    <script>
        if (navigator.geolocation) {
            window.myMap = function() {
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
            }
        } else {
            console.log("Browser ini tidak support geolokasi!");
        }
        $(document).ready(function() {
            $('#clock_in').click(function() {
                navigator.geolocation.getCurrentPosition(function(position) {
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;
                    let data_clock_in = {
                        _token: "{{ csrf_token() }}",
                        latitude: latitude,
                        longitude: longitude,
                        clock_in: null,
                        clock_out: null,
                    };
                    $.ajax({
                        type: "POST",
                        url: "/api/dashboard/clock-in",
                        data: data_clock_in,
                        success: function(response) {
                            alert("Sukses");
                            console.log(response);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });

            })
            setInterval(function() {
                var currentTime = new Date();
                var hours = currentTime.getHours();
                var minutes = currentTime.getMinutes();
                var seconds = currentTime.getSeconds();
                hours = (hours < 10 ? "0" : "") + hours;
                minutes = (minutes < 10 ? "0" : "") + minutes;
                seconds = (seconds < 10 ? "0" : "") + seconds;
                var timeString = hours + ':' + minutes + ':' + seconds;
                $("#waktu-realtime").text(timeString);
            }, 1000);
        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXAfkYEcQcjKOO_za4EirUw9_ASmpf5fY&loading=async&callback=myMap&v=weekly"
        async defer></script>
@endsection
