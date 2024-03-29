@extends('inc.layout')
@section('title', 'Organisasi')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" id="btn-tambah" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-data" title="Tambah Bank">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Pegawai Bank
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Tabel Pegawai Bank
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        {{-- <th style="white-space: nowrap">Foto</th> --}}
                                        <th style="white-space: nowrap">Bank</th>
                                        <th style="white-space: nowrap">Nomor Rekening</th>
                                        <th style="white-space: nowrap">Nama</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $row)
                                        @if ($row->bank_employee)
                                            <tr>
                                                <td>{{ $row->bank_employee->bank->name }}</td>
                                                <td>{{ $row->bank_employee->account_number }}</td>
                                                <td>{{ $row->bank_employee->account_holder_name }}</td>
                                                <td style="white-space: nowrap">
                                                    <button type="button" data-backdrop="static" data-keyboard="false"
                                                        class="badge mx-1 btn-edit badge-primary p-2 border-0 text-white"
                                                        data-id="{{ $row->bank_employee->id }}" title="Ubah">
                                                        <span class="fal fa-pencil ikon-edit"></span>
                                                        <div class="span spinner-text d-none">
                                                            <span class="spinner-border spinner-border-sm" role="status"
                                                                aria-hidden="true"></span>
                                                            Loading...
                                                        </div>
                                                    </button>
                                                    <button type="button" data-backdrop="static" data-keyboard="false"
                                                        class="badge mx-1 badge-success p-2 border-0 text-white btn-hapus"
                                                        data-id="{{ $row->bank_employee->id }}" title="Hapus">
                                                        <span class="fal fa-trash ikon-hapus"></span>
                                                        <div class="span spinner-text d-none">
                                                            <span class="spinner-border spinner-border-sm" role="status"
                                                                aria-hidden="true"></span>
                                                            Loading...
                                                        </div>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="white-space: nowrap">Bank</th>
                                        <th style="white-space: nowrap">Nomor Rekening</th>
                                        <th style="white-space: nowrap">Nama</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.master-data.bank-employees.partials.create-data')
        @include('pages.master-data.bank-employees.partials.update-data')
    </main>
@endsection
@section('plugin')
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
            $('.btn-edit').click(function(e) {
                e.preventDefault();
                let button = $(this);
                console.log('clicked');
                let id = button.attr('data-id');
                button.find('.ikon-edit').hide();
                button.find('.spinner-text').removeClass('d-none');

                $.ajax({
                    type: "GET", // Method pengiriman data bisa dengan GET atau POST
                    url: `/api/dashboard/bank-employees/get/${id}`, // Isi dengan url/path file php yang dituju
                    dataType: "json",
                    success: function(data) {
                        button.find('.ikon-edit').show();
                        button.find('.spinner-text').addClass('d-none');
                        $('#ubah-data').modal('show');
                        let newOption = new Option(data.employee_id + ' - ' + data
                            .account_holder_name, data.employee_id, true,
                            true);
                        $('#ubah-data #employee_id').append(newOption).trigger('change');
                        $('#ubah-data #employee_id').val(data.employee_id).select2({
                            dropdownParent: $('#ubah-data')
                        })
                        $('#ubah-data #bank_id').val(data.bank_id).select2({
                            dropdownParent: $('#ubah-data')
                        })
                        $('#ubah-data #account_number').val(data.account_number)
                        $('#ubah-data #account_holder_name').val(data.account_holder_name)
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

                $('#update-form').on('submit', function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();
                    $.ajax({
                        type: "POST",
                        url: '/api/dashboard/bank-employees/update/' + id,
                        data: formData,
                        beforeSend: function() {
                            $('#update-form').find('.ikon-edit').hide();
                            $('#update-form').find('.spinner-text')
                                .removeClass(
                                    'd-none');
                        },
                        success: function(response) {
                            $('#ubah-data').modal('hide');
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
            $('#store-form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: '/api/dashboard/bank-employees/store/',
                    data: formData,
                    beforeSend: function() {
                        $('#store-form').find('.ikon-tambah').hide();
                        $('#store-form').find('.spinner-text').removeClass(
                            'd-none');
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

            $('.btn-hapus').click(function(e) {
                e.preventDefault();
                let button = $(this);
                alert('Yakin ingin menghapus ini ?');
                let id = button.attr('data-id');
                $.ajax({
                    type: "GET",
                    url: '/api/dashboard/bank-employees/delete/' + id,
                    beforeSend: function() {
                        button.find('.ikon-hapus').hide();
                        button.find('.spinner-text').removeClass(
                            'd-none');
                    },
                    success: function(response) {
                        button.find('.ikon-edit').show();
                        button.find('.spinner-text').addClass('d-none');
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
