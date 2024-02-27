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
                    <div class="col-lg-9 p-0">
                        <div class="card mb-g">
                            <div class="row mt-4">
                                <div class="col-12 px-5">
                                    <div class="row row-grid no-gutters">
                                        <div class="col mb-4">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                @include('pages.pegawai.profil-pegawai.partials.section.general-section')
                                                @include('pages.pegawai.profil-pegawai.partials.section.time-management-section')
                                            </div>
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
            @include('pages.pegawai.profil-pegawai.partials.modal.create-attendance-request')
            @include('pages.pegawai.profil-pegawai.partials.modal.detail-attendance-request')

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
                    $(".btn-submit").prop('disabled', true);
                    let formData = $(this).serialize();
                    let form = $(this); // Simpan referensi ke formulir
                    $.ajax({
                        type: "POST",
                        url: '/api/dashboard/attendance-request/store/',
                        data: formData,
                        beforeSend: function() {
                            form.find('.ikon-tambah').hide();
                            form.find('.spinner-text').removeClass('d-none');
                        },
                        success: function(response) {
                            form.find('.ikon-edit').show();
                            form.find('.spinner-text').addClass('d-none');
                            $('#create-attendance-form').modal('hide');
                            showSuccessAlert(response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                            // Nonaktifkan form setelah berhasil disubmit
                            form.off('submit');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
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
