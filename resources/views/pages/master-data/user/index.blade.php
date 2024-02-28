@extends('inc.layout')
@section('title', 'User')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-user" title="Tambah User">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah User
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Table <span class="fw-300"><i>User</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Nama User</th>
                                        {{-- <th style="white-space: nowrap">Username</th> --}}
                                        <th style="white-space: nowrap">Email</th>
                                        <th style="white-space: nowrap">Akses Role</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap">{{ $user->name }}</td>
                                            {{-- <td style="white-space: nowrap">{{ $user->username }}</td> --}}
                                            <td style="white-space: nowrap">{{ $user->email }}</td>
                                            <td style="white-space: nowrap">
                                                {{ strlen($user->roles->first()->name) < 3 ? strtoupper($user->roles->first()->name) : ucfirst($user->roles->first()->name) }}
                                            </td>

                                            <td style="white-space: nowrap">
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 btn-edit badge-primary p-2 border-0 text-white"
                                                    data-id="{{ $user->id }}" title="Ubah">
                                                    <span class="fal fa-pencil ikon-edit"></span>
                                                    <div class="span spinner-text d-none">
                                                        <span class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                        Loading...
                                                    </div>
                                                </button>
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-success p-2 border-0 text-white btn-hapus"
                                                    data-id="{{ $user->id }}" title="Hapus">
                                                    <span class="fal fa-trash ikon-hapus"></span>
                                                    <div class="span spinner-text d-none">
                                                        <span class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                        Loading...
                                                    </div>
                                                </button>
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-secondary p-2 border-0 text-white btn-akses"
                                                    data-role-id="{{ $user->roles->first()->id }}"
                                                    data-user-id="{{ $user->id }}" title="Akses">
                                                    <span class="fal fa-user-secret ikon-akses"></span>
                                                    <div class="span spinner-text d-none">
                                                        <span class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                        Loading...
                                                    </div>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @include('pages.master-data.user.partials.update-user')
                                    @include('pages.master-data.user.partials.create-user')
                                    @include('pages.master-data.user.partials.update-akses')
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Nama User</th>
                                        {{-- <th style="white-space: nowrap">Username</th> --}}
                                        <th style="white-space: nowrap">Email</th>
                                        <th style="white-space: nowrap">Akses Role</th>
                                        {{-- <th style="white-space: nowrap">Unit</th> --}}
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
    </main>
@endsection
@section('plugin')
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script>
        /* demo scripts for change table color */
        /* change background */
        $(document).ready(function() {
            $('.btn-edit').click(function(e) {
                e.preventDefault();
                let button = $(this);
                console.log('clicked');
                let id = button.attr('data-id');
                button.find('.ikon-edit').hide();
                button.find('.spinner-text').removeClass('d-none');

                $.ajax({
                    type: "GET", // Method pengiriman data bisa dengan GET atau POST
                    url: `/api/dashboard/user/get/${id}`, // Isi dengan url/path file php yang dituju
                    dataType: "json",
                    success: function(data) {
                        button.find('.ikon-edit').show();
                        button.find('.spinner-text').addClass('d-none');
                        $('#ubah-user').modal('show');
                        $('#ubah-user #name').val(data.name)
                        $('#ubah-user #email').val(data.email)
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
                        url: '/api/dashboard/user/update/' + id,
                        data: formData,
                        beforeSend: function() {
                            $('#update-form').find('.ikon-edit').hide();
                            $('#update-form').find('.spinner-text')
                                .removeClass(
                                    'd-none');
                        },
                        success: function(response) {
                            $('#ubah-user').modal('hide');
                            showSuccessAlert(response.message);
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

            $('.btn-akses').click(function(e) {
                e.preventDefault();
                let button = $(this);
                let roleId = button.attr('data-role-id');
                let userId = button.attr('data-user-id');
                button.find('.ikon-akses').hide();
                button.find('.spinner-text').removeClass('d-none');

                $.ajax({
                    type: "GET", // Method pengiriman data bisa dengan GET atau POST
                    url: `/api/dashboard/role/get/${roleId}`, // Isi dengan url/path file php yang dituju
                    dataType: "json",
                    success: function(data) {
                        button.find('.ikon-akses').show();
                        button.find('.spinner-text').addClass('d-none');
                        $('#ubah-akses').modal('show');
                        $('#ubah-akses #role').val(data.id).select2({
                            dropdownParent: $('#ubah-akses')
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

                $('#akses-form').on('submit', function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();
                    $.ajax({
                        type: "POST",
                        url: '/api/dashboard/user/update-akses/' + userId,
                        data: formData,
                        beforeSend: function() {
                            $('#update-form').find('.ikon-edit').hide();
                            $('#update-form').find('.spinner-text').removeClass(
                                'd-none');
                        },
                        success: function(response) {
                            $('#ubah-akses').modal('hide');
                            showSuccessAlert(response.message);
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
                    url: '/api/dashboard/user/store',
                    data: formData,
                    beforeSend: function() {
                        $('#store-form').find('.ikon-tambah').hide();
                        $('#store-form').find('.spinner-text').removeClass(
                            'd-none');
                    },
                    success: function(response) {
                        $('#store-form').find('.ikon-edit').show();
                        $('#store-form').find('.spinner-text').addClass('d-none');
                        $('#tambah-user').modal('hide');
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
                    url: '/api/dashboard/user/delete/' + id,
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
