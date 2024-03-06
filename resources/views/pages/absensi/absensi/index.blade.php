@extends('inc.layout')
@section('title', 'User')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-data" title="Tambah User">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Ajukan Cuti
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Absensi Bulan {{ now()->format('F Y') }}
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap">Tanggal</th>
                                        <th style="white-space: nowrap">Clock In</th>
                                        <th style="white-space: nowrap">Clock Out</th>
                                        <th style="white-space: nowrap">Libur</th>
                                        <th style="white-space: nowrap">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $row)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $row->date }}
                                            </td>
                                            <td style="white-space: nowrap"
                                                class="{{ $row->clock_in && \Carbon\Carbon::parse($row->clock_in)->format('H:i') > \Carbon\Carbon::parse($row->shift->time_in)->format('H:i') ? 'text-danger' : '' }}">
                                                @isset($row->clock_in)
                                                    {{ \Carbon\Carbon::parse($row->clock_in)->format('H:i') }}
                                                @else
                                                    -
                                                @endisset
                                            </td>
                                            <td style="white-space: nowrap"
                                                class="{{ $row->clock_out && \Carbon\Carbon::parse($row->clock_out)->format('H:i') < \Carbon\Carbon::parse($row->shift->time_out)->format('H:i') ? 'text-danger' : '' }}">
                                                {{ \Carbon\Carbon::parse($row->clock_out)->format('H:i') }}
                                            </td>
                                            <td style="white-space: nowrap">{{ $row->is_day_off == 1 ? 'Ya' : '-' }}
                                            </td>
                                            <td style="white-space: nowrap">
                                                @isset($row->day_off)
                                                    {{ $row->day_off->attendance_code->description }}
                                                @else
                                                    -
                                                @endisset
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Tanggal</th>
                                        <th style="white-space: nowrap">Jenis Cuti</th>
                                        <th style="white-space: nowrap">Keterangan</th>
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
@endsection
@section('plugin')
    <script src="/js/dependency/moment/moment.js"></script>
    <script src="/js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script>
        /* demo scripts for change table color */
        /* change background */
        $(document).ready(function() {
            $(function() {
                $('.select2').select2({
                    placeholder: 'Pilih Data Berikut',
                    dropdownParent: $('#tambah-data')
                });
            });
            $('#datepicker-modal-2').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });

            $('#store-form').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                formData.append("employee_id", "{{ auth()->user()->employee->id }}");
                formData.append("approved_line_child", "{{ auth()->user()->employee->approval_line }}");
                formData.append("approved_line_parent",
                    "{{ auth()->user()->employee->approval_line_parent }}");

                $.ajax({
                    type: "POST",
                    url: '/api/employee/request/day-off',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#store-form').find('.ikon-tambah').hide();
                        $('#store-form').find('.spinner-text').removeClass('d-none');
                    },
                    success: function(response) {
                        $('#store-form').find('.ikon-edit').show();
                        $('#store-form').find('.spinner-text').addClass('d-none');
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

            $('.btn-accept').on('click', function(e) {
                e.preventDefault();
                console.log("click");
                let formData = {
                    employee_id: "{{ auth()->user()->employee->id }}"
                }
                let id = $(this).attr('data-id');
                $.ajax({
                    type: "PUT",
                    url: '/api/employee/approve/day-off/' + id,
                    data: formData,
                    beforeSend: function() {
                        $('#approve-request').find('.ikon-edit').hide();
                        $('#approve-request').find('.spinner-text')
                            .removeClass(
                                'd-none');
                    },
                    success: function(response) {
                        showSuccessAlert(response.message)
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            })

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
