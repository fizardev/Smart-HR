@extends('inc.layout')
@section('title', 'Marketing Dashboard')
@section('extended-css')
    <style>
        .icon-dashboard-report {
            font-size: 2em;
            text-align: center;
        }

        .text-dashboard-report {
            font-size: 1em;
            text-align: center;
            color: #666666 !important;
        }

        .badge.pos-top.pos-right.dashboard-report {
            font-size: 0.9em;
            top: 9px;
            right: 12px;
            border-radius: 50%;
            height: 20px;
            width: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media screen and (max-width: 500px) {

            .badge.pos-top.pos-right.dashboard-report {
                font-size: 0.8em;
                height: 15px;
                width: 15px;
            }
        }

        .badge.pos-top.pos-right.dashboard-report {}
    </style>
@endsection
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div id="map" style="width:100%;height:200px;"></div>
                            <div class="time-attendance row justify-content-center mb-2" style="color: #666666 !important;">
                                <span class="mt-4 col-md-12 text-center"
                                    style="font-size:1.2em">{{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}</span>
                                <h2 class="col-md-12 mt-2 text-center" id="waktu-realtime">
                                    {{ \Carbon\Carbon::now()->translatedFormat('H:i:s') }}</h2>
                                <div class="attendance-btn mt-2">
                                    @if (isset($attendances[0]))
                                        <button
                                            class="btn btn-primary btn-sm btn-clock-in mr-1 {{ $attendances[0]->date == \Carbon\Carbon::now()->format('Y-m-d') && $attendances[0]->clock_in ? 'd-none' : '' }}"
                                            id="clock_in">
                                            <span class="spinner-border spinner-text spinner-border-sm d-none"
                                                role="status" aria-hidden="true"></span>
                                            Clock In
                                        </button>
                                        <button
                                            class="btn btn-danger btn-sm btn-clock-in {{ $attendances[0]->date == \Carbon\Carbon::now()->format('Y-m-d') && $attendances[0]->clock_out ? 'd-none' : '' }}"
                                            id="clock_out">
                                            <span class="spinner-border spinner-text spinner-border-sm d-none"
                                                role="status" aria-hidden="true"></span>
                                            Clock Out
                                        </button>
                                    @else
                                        <button class="btn btn-primary btn-sm btn-clock-in mr-1" id="clock_in">Clock
                                            In</button>
                                        <button class="btn btn-danger btn-sm btn-clock-in" id="clock_out">Clock Out</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-md-3 pr-1" style="width: 25%; padding-left: 0px !important!">
                <div class="card">
                    <div class="card-body p-2">
                        <span class="badge badge-icon pos-top pos-right dashboard-report">{{ $jumlah_hadir }}</span>
                        <div class="icon-dashboard-report text-primary">
                            <i class="fal fa-user-alt hadir"></i>
                        </div>
                        <div class="text-dashboard-report">
                            Hadir
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 px-1" style="width: 25%">
                <div class="card">
                    <div class="card-body p-2">
                        <span class="badge badge-icon pos-top pos-right dashboard-report">{{ $jumlah_izin }}</span>
                        <div class="icon-dashboard-report text-success">
                            <i class="fal fa-file-alt"></i>
                        </div>
                        <div class="text-dashboard-report">
                            Izin
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 px-1" style="width: 25%">
                <div class="card">
                    <div class="card-body p-2">
                        <span class="badge badge-icon pos-top pos-right dashboard-report">{{ $jumlah_sakit }}</span>
                        <div class="icon-dashboard-report text-danger">
                            <i class="fal fa-first-aid"></i>
                        </div>
                        <div class="text-dashboard-report">
                            Sakit
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 pl-1" style="width: 25%; padding-right: 0px !important!">
                <div class="card">
                    <div class="card-body p-2">
                        <span class="badge badge-icon pos-top pos-right dashboard-report">{{ $jumlah_cuti }}</span>
                        <div class="icon-dashboard-report text-warning">
                            <i class="fal fa-clock"></i>
                        </div>
                        <div class="text-dashboard-report">
                            Cuti
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            @if ($attendances->count() > 0)
                <div class="col-xl-12">
                    <div id="panel-1" class="panel">
                        <div class="panel-container show">
                            <div class="panel-content row d-flex justify-content-center">
                                @foreach ($attendances as $item)
                                    <div class="col-md-4">
                                        <div class="list-attendance p-2" style="color: #666666 !important;">
                                            <div class="attendance-date-list d-flex justify-content-center py-1">
                                                <span class="d-block font-weight-bold"
                                                    style="font-size: 1.2em">{{ \Carbon\Carbon::parse($item->date)->translatedFormat('j F Y') }}</span>
                                            </div>
                                            <div class="d-flex justify-content-center p-1">
                                                <span class="d-block mr-2 badge badge-info badge-pill px-2"
                                                    style="font-size: 1.03em !important">Clock in :
                                                    {{ $item->clock_in == null ? '-' : \Carbon\Carbon::parse($item->clock_in)->translatedFormat('H:i') }}</span>
                                                <span class="d-block badge badge-success badge-pill px-2"
                                                    style="font-size: 1.03em !important">Clock out :
                                                    {{ $item->clock_out == null ? '-' : \Carbon\Carbon::parse($item->clock_out)->translatedFormat('H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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
                        zoom: 13.7,
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

                $('#clock_in').find('.spinner-text').removeClass('d-none');
                navigator.geolocation.getCurrentPosition(function(position) {
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;
                    let data_clock_in = {
                        _token: "{{ csrf_token() }}",
                        latitude: latitude,
                        longitude: longitude,
                        clock_in: null,
                        clock_out: null,
                        employee_id: "{{ Auth::user()->employee->id }}",
                        time_in: null
                    };
                    $.ajax({
                        type: "PUT",
                        url: "/api/dashboard/clock-in",
                        data: data_clock_in,
                        async: true,
                        success: function(response) {
                            $('#clock_in').find('.spinner-text').addClass(
                                'd-none');
                            showSuccessAlert(response.message)
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON;
                                // Lakukan sesuatu dengan pesan kesalahan yang diterima
                                alert(errors.error);
                            } else {
                                // Tangani kesalahan lainnya
                                var errors = xhr.responseJSON;
                                alert(errors.error);
                            }
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        }
                    });
                });

            })
            $('#clock_out').click(function() {
                $('#clock_out').find('.spinner-text').removeClass('d-none');
                navigator.geolocation.getCurrentPosition(function(position) {
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;
                    let data_clock_out = {
                        _token: "{{ csrf_token() }}",
                        latitude: latitude,
                        longitude: longitude,
                        clock_out: null,
                        employee_id: "{{ Auth::user()->employee->id }}",
                        time_out: null
                    };
                    $.ajax({
                        type: "PUT",
                        url: "/api/dashboard/clock-out",
                        data: data_clock_out,
                        async: true,
                        success: function(response) {
                            $('#clock_out').find('.spinner-text').addClass(
                                'd-none');
                            showSuccessAlert(response.message)
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON;
                                // Lakukan sesuatu dengan pesan kesalahan yang diterima
                                alert(errors.error);
                            } else {
                                // Tangani kesalahan lainnya
                                var errors = xhr.responseJSON;
                                alert(errors.error);
                            }
                            setTimeout(function() {
                                location.reload();
                            }, 500);
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
