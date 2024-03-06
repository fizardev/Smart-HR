@extends('inc.layout')
@section('title', 'User')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed btn-ajukan" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-data" title="Tambah User">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Ajukan Absensi
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Pengajuan Absensi
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Tanggal</th>
                                        <th style="white-space: nowrap">Clockin</th>
                                        <th style="white-space: nowrap">Clockout</th>
                                        <th style="white-space: nowrap">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendance_requests as $row)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap">{{ tgl($row->date) }}
                                            </td>
                                            <td style="white-space: nowrap">{{ $row->clockin ?? '*tidak diajukan' }}
                                            <td style="white-space: nowrap">{{ $row->clockout ?? '*tidak diajukan' }}
                                            </td>
                                            <td style="white-space: nowrap">
                                                <span
                                                    class="badge {{ $row->is_approved == 'Pending' ? 'badge-warning' : ($row->is_approved == 'Disetujui' ? 'badge-success' : ($row->is_approved == 'Ditolak' ? 'badge-danger' : ($row->is_approved == 'Verifikasi' ? 'badge-primary' : ''))) }}">
                                                    {{ ucfirst($row->is_approved) }} </span>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Tanggal</th>
                                        <th style="white-space: nowrap">Clockin</th>
                                        <th style="white-space: nowrap">Clockout</th>
                                        <th style="white-space: nowrap">Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('pages.pengajuan.pengajuan-absensi.partials.create')
@endsection
@section('plugin')
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script src="/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function() {

            // Ajukan
            $('.btn-ajukan').click(function(e) {
                // Mendapatkan tanggal hari ini
                var today = new Date();
                // Mendapatkan tanggal satu hari sebelumnya
                var yesterday = new Date(today);
                yesterday.setDate(today.getDate() - 1);

                $('#store-attendance-request #date').datepicker({
                    todayBtn: "linked",
                    clearBtn: false,
                    todayHighlight: true,
                    format: "yyyy-mm-dd",
                    startDate: yesterday, // Mengatur tanggal mulai satu hari sebelumnya
                    endDate: today // Mengatur tanggal akhir hari ini
                });

                $('#create-attendance-form').modal('show');

                $('#store-attendance-request').on('submit', function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();
                    formData += '&employee_id={{ auth()->user()->employee->id }}'
                    $.ajax({
                        type: "POST",
                        url: '/api/dashboard/attendance-request/store/',
                        data: formData,
                        beforeSend: function() {
                            $('#store-attendance-request').find('.ikon-tambah').hide();
                            $('#store-attendance-request').find('.spinner-text')
                                .removeClass(
                                    'd-none');
                        },
                        success: function(response) {
                            $('#store-attendance-request').find('.ikon-edit').show();
                            $('#store-attendance-request').find('.spinner-text')
                                .addClass('d-none');
                            $('#tambah-data').modal('hide');
                            showSuccessAlert(response.message)
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });

            // Datatable
            $('#dt-basic-example').dataTable({
                responsive: true
            });

            $('.js-thead-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
            });

            $('.js-tbody-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
            });
        });
    </script>
@endsection
