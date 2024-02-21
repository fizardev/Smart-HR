{{-- @dd($employee->organization) --}}
@extends('inc.layout')
@section('title', 'Profil Pengguna')
@section('tmp_body', 'nav-function-minify layout-composed')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="panel-container show">
            <div class="panel-content">
                <div class="row">
                    @include('pages.pegawai.profil-pegawai.partials.left-content')
                    <div class="col-lg-9">
                        <div class="card mb-g">
                            <div class="row mt-4">
                                <div class="col-12 px-5">
                                    <div class="row row-grid no-gutters">
                                        <div class="col mb-4">
                                            @include('pages.pegawai.profil-pegawai.partials.section.general-section')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('pages.pegawai.profil-pegawai.partials.modal.edit-employee')
            @include('pages.pegawai.profil-pegawai.partials.modal.edit-identity')

    </main>
@endsection
@section('plugin')
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script src="/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function() {
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

            $('.btn-ubah-personal').click(function(e) {
                e.preventDefault();
                let button = $(this);
                // console.log('clicked');
                let id = button.attr('data-id');
                button.find('.ikon-edit').hide();
                button.find('.spinner-text').removeClass('d-none');

                $.ajax({
                    type: "GET", // Method pengiriman data bisa dengan GET atau POST
                    url: `/api/dashboard/employee/get/${id}`, // Isi dengan url/path file php yang dituju
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        button.find('.ikon-edit').show();
                        button.find('.spinner-text').addClass('d-none');
                        $('#ubah-personal').modal('show');
                        $('#ubah-personal #fullname').val(data.fullname);
                        $('#ubah-personal #mobile_phone').val(data.mobile_phone);
                        $('#ubah-personal #email').val(data.email);
                        $('#ubah-personal #place_of_birth').val(data.place_of_birth);
                        $('#ubah-personal #birthdate').datepicker({
                            todayBtn: "linked",
                            clearBtn: false,
                            todayHighlight: true,
                            format: "yyyy-mm-dd",
                        }).val(data.birthdate);
                        $('#ubah-personal #gender').val(data.gender).select2({
                            dropdownParent: $('#ubah-personal')
                        });
                        $('#ubah-personal #marital-status').val(data.marital_status).select2({
                            dropdownParent: $('#ubah-personal')
                        });
                        $('#ubah-personal #religion').val(data.religion).select2({
                            dropdownParent: $('#ubah-personal')
                        });
                        $('#ubah-personal #blood-type').val(data.blood_type);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

                $('#update-personal-form').on('submit', function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();
                    $.ajax({
                        type: "POST",
                        url: '/api/dashboard/employee/update/' + id,
                        data: formData,
                        beforeSend: function() {
                            $('#update-personal-form').find('.ikon-edit').hide();
                            $('#update-personal-form').find('.spinner-text')
                                .removeClass(
                                    'd-none');
                        },
                        success: function(response) {
                            $('#ubah-personal').modal('hide');
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
            $('.btn-ubah-identitas').click(function(e) {
                e.preventDefault();
                let button = $(this);
                // console.log('clicked');
                let id = button.attr('data-id');
                button.find('.ikon-edit').hide();
                button.find('.spinner-text').removeClass('d-none');

                $.ajax({
                    type: "GET", // Method pengiriman data bisa dengan GET atau POST
                    url: `/api/dashboard/employee/get/${id}`, // Isi dengan url/path file php yang dituju
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        button.find('.ikon-edit').show();
                        button.find('.spinner-text').addClass('d-none');
                        $('#ubah-identitas').modal('show');
                        $('#ubah-identitas #identity-type').val(data.identity_type);
                        $('#ubah-identitas #identity-number').val(data.identity_number);
                        var identityNumberExpired = data.identity_expire_date;
                        if (!identityNumberExpired) {
                            $('#ubah-identitas #identity-expire-date').prop('disabled', true);
                        } else {
                            // Jika ada data, maka atur nilai input
                            $('#ubah-identitas #identity-expire-date').val(
                                identityNumberExpired);
                        }
                        $('#ubah-identitas #postal-code').val(data.postal_code);
                        $('#ubah-identitas #citizen-id-address').val(data.citizen_id_address);
                        $('#ubah-identitas #residental-address').val(data.residental_address);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

                $('#update-identity-form').on('submit', function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();
                    $.ajax({
                        type: "POST",
                        url: '/api/dashboard/employee/update-identitas/' + id,
                        data: formData,
                        beforeSend: function() {
                            $('#update-identity-form').find('.ikon-edit').hide();
                            $('#update-identity-form').find('.spinner-text')
                                .removeClass(
                                    'd-none');
                        },
                        success: function(response) {
                            $('#ubah-identitas').modal('hide');
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
                    url: '/api/dashboard/employee/store/',
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
            $(function() {
                $('.select2').select2({
                    placeholder: 'Pilih Data Berikut'
                });
            });
            $('#sama-alamat').change(function() {
                if ($(this).is(':checked')) {
                    $('#residental_address').val($('#citizen_id_address').val());
                    // Lakukan sesuatu jika checkbox tercentang di sini
                } else {
                    $('#residental_address').val("");
                    // Lakukan sesuatu jika checkbox tidak tercentang di sini
                }
            });
            $('.btn-next .btn-prev').click(function(e) {
                e.preventDefault();
                let parent = $(this).parent().parent();
                if (parent.attr('id') == 'step-2') {
                    $('#step-round-1-done').addClass('d-none');
                    $('#step-round-1').removeClass('d-none');
                    $('#step-round-2').removeClass('btn-primary');
                    $('#step-round-2').addClass('btn-outline-primary');
                    $("html, body").animate({
                        scrollTop: 0
                    }, 500);
                    $('#step-2').fadeOut(300, function() {
                        $('#step-1').fadeIn(300, function() {
                            $('#step-1').removeClass('hidden-content')
                        })
                    });
                } else if (parent.attr('id') == 'step-3') {
                    $('#step-round-2-done').addClass('d-none');
                    $('#step-round-2').removeClass('d-none');
                    $('#step-round-3').removeClass('btn-primary');
                    $('#step-round-3').addClass('btn-outline-primary');
                    $("html, body").animate({
                        scrollTop: 0
                    }, 500);
                    $('#step-3').fadeOut(300, function() {
                        $('#step-2').fadeIn(300, function() {
                            $('#step-2').removeClass('hidden-content')
                        })
                    });
                } else if (parent.attr('id') == 'step-4') {
                    $('#step-round-3-done').addClass('d-none');
                    $('#step-round-3').removeClass('d-none');
                    $('#step-round-4').removeClass('btn-primary');
                    $('#step-round-4').addClass('btn-outline-primary');
                    $("html, body").animate({
                        scrollTop: 0
                    }, 500);
                    $('#step-4').fadeOut(300, function() {
                        $('#step-3').fadeIn(300, function() {
                            $('#step-3').removeClass('hidden-content')
                        })
                    });
                }
            });
            $('.btn-next .btn-next-step').click(function(e) {
                e.preventDefault();
                let parent = $(this).parent().parent();
                $("html, body").animate({
                    scrollTop: 0
                }, 500);
                parent.fadeOut(300, function() {
                    // Callback akan dipanggil setelah animasi selesai
                    parent.addClass('hidden-content');
                    parent.removeAttr('style');

                    if (parent.attr('id') == 'step-1') {
                        $('#step-2').fadeIn(300);
                        $('#step-round-1-done').removeClass('d-none');
                        $('#step-round-1').addClass('d-none');
                        $('#step-round-2').removeClass('btn-outline-primary');
                        $('#step-round-2').addClass('btn-primary');
                    } else if (parent.attr('id') == 'step-2') {
                        $('#step-2').fadeOut(300, function() {
                            $('#step-2').addClass('hidden-content');
                            $('#step-2').removeAttr('style');
                        });
                        $('#step-3').fadeIn(300);
                        $('#step-round-2').addClass('d-none');
                        $('#step-round-2-done').removeClass('d-none');
                        $('#step-round-3').removeClass('btn-outline-primary');
                        $('#step-round-3').addClass('btn-primary');
                    } else if (parent.attr('id') == 'step-3') {
                        $('#step-3').fadeOut(300, function() {
                            $('#step-3').addClass('hidden-content');
                            $('#step-3').removeAttr('style');
                        });
                        $('#step-4').fadeIn(300);
                        $('#step-round-3').addClass('d-none');
                        $('#step-round-3-done').removeClass('d-none');
                        $('#step-round-4').removeClass('btn-outline-primary');
                        $('#step-round-4').addClass('btn-primary');
                    }
                });

            });
            $('#datepicker-3').datepicker({
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
            });
            $('#identity_expire_date').datepicker({
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
            });
            $('#join_date').datepicker({
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
            });
        });
    </script>
@endsection
