@extends('inc.layout')
@section('title', 'Organisasi')
@section('title', 'Job Position')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="panel-container show">
            <div class="panel-content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card mb-g rounded-top">
                            <div class="row no-gutters row-grid">
                                <div class="col-12">
                                    <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                        <img src="/img/demo/avatars/avatar-admin-lg.png"
                                            class="rounded-circle shadow-2 img-thumbnail" alt="">
                                        <h5 class="mb-0 fw-700 text-center mt-3">
                                            {{ auth()->user()->name }}
                                            <small class="text-muted mb-0">Toronto, Canada</small>
                                        </h5>
                                        <div class="mt-4 text-center demo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="accordion accordion-hover" id="js_demo_accordion-5">
                                        <div class="card">
                                            <div class="card-header">
                                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                                    data-target="#js_demo_accordion-5a" aria-expanded="true">
                                                    <i class="fal fa-user-alt width-2 fs-xl"></i>
                                                    General
                                                    <span class="ml-auto">
                                                        <span class="collapsed-reveal">
                                                            <i class="fal fa-chevron-up fs-xl"></i>
                                                        </span>
                                                        <span class="collapsed-hidden">
                                                            <i class="fal fa-chevron-down fs-xl"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div id="js_demo_accordion-5a" class="collapse show"
                                                data-parent="#js_demo_accordion-5">
                                                <div class="card-body p-0">
                                                    <div class="row row-grid no-gutters">
                                                        <div class="nav flex-column" id="v-pills-tab" role="tablist"
                                                            aria-orientation="vertical">
                                                            <a class="nav-link active" id="v-pills-home-tab"
                                                                data-toggle="pill" href="#v-pills-home" role="tab"
                                                                aria-controls="v-pills-home" aria-selected="true">
                                                                <span class="hidden-sm-down ml-1">Home</span>
                                                            </a>
                                                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill"
                                                                href="#v-pills-profile" role="tab"
                                                                aria-controls="v-pills-profile" aria-selected="false">
                                                                <span class="hidden-sm-down ml-1">Profile</span>
                                                            </a>
                                                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill"
                                                                href="#v-pills-messages" role="tab"
                                                                aria-controls="v-pills-messages" aria-selected="false">
                                                                <span class="hidden-sm-down ml-1">Messages</span>
                                                            </a>
                                                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill"
                                                                href="#v-pills-settings" role="tab"
                                                                aria-controls="v-pills-settings" aria-selected="false">
                                                                <span class="hidden-sm-down ml-1">Settings</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <a href="javascript:void(0);" class="card-title collapsed"
                                                    data-toggle="collapse" data-target="#js_demo_accordion-5b"
                                                    aria-expanded="false">
                                                    <i class="fal fa-clock width-2 fs-xl"></i>
                                                    Manajemen Waktu
                                                    <span class="ml-auto">
                                                        <span class="collapsed-reveal">
                                                            <i class="fal fa-chevron-up fs-xl"></i>
                                                        </span>
                                                        <span class="collapsed-hidden">
                                                            <i class="fal fa-chevron-down fs-xl"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div id="js_demo_accordion-5b" class="collapse"
                                                data-parent="#js_demo_accordion-5">
                                                <div class="card-body p-0">
                                                    <div class="row row-grid no-gutters">
                                                        <div class="col-12 p-3">
                                                            <a href="#" class="d-block w-100">Absensi</a>
                                                        </div>
                                                        <div class="col-12 p-3">
                                                            <a href="#" class="d-block w-100">Libur</a>
                                                        </div>
                                                        <div class="col-12 p-3">
                                                            <a href="#" class="d-block w-100">Lembur</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <a href="javascript:void(0);" class="card-title collapsed"
                                                    data-toggle="collapse" data-target="#js_demo_accordion-5c"
                                                    aria-expanded="false">
                                                    <i class="fab fa-buromobelexperte width-2 fs-xl"></i>
                                                    Payroll
                                                    <span class="ml-auto">
                                                        <span class="collapsed-reveal">
                                                            <i class="fal fa-chevron-up fs-xl"></i>
                                                        </span>
                                                        <span class="collapsed-hidden">
                                                            <i class="fal fa-chevron-down fs-xl"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div id="js_demo_accordion-5c" class="collapse"
                                                data-parent="#js_demo_accordion-5">
                                                <div class="card-body p-0">
                                                    <div class="col-12 p-3">
                                                        <a href="#" class="d-block w-100">Payroll Info</a>
                                                    </div>
                                                    <div class="col-12 p-3">
                                                        <a href="#" class="d-block w-100">Payslip</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <a href="javascript:void(0);" class="card-title collapsed"
                                                    data-toggle="collapse" data-target="#js_demo_accordion-5d"
                                                    aria-expanded="false">
                                                    <i class="fal fa-money-bill-alt width-2 fs-xl"></i>
                                                    Finance
                                                    <span class="ml-auto">
                                                        <span class="collapsed-reveal">
                                                            <i class="fal fa-chevron-up fs-xl"></i>
                                                        </span>
                                                        <span class="collapsed-hidden">
                                                            <i class="fal fa-chevron-down fs-xl"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div id="js_demo_accordion-5d" class="collapse"
                                                data-parent="#js_demo_accordion-5">
                                                <div class="card-body p-0">
                                                    <div class="col-12 p-3">
                                                        <a href="#" class="d-block w-100">Reimbursement</a>
                                                    </div>
                                                    <div class="col-12 p-3">
                                                        <a href="#" class="d-block w-100">Loan</a>
                                                    </div>
                                                    <div class="col-12 p-3">
                                                        <a href="#" class="d-block w-100">Cash Advance</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card mb-g">
                            <div class="row mt-4">
                                <div class="col-12 px-5">
                                    <div class="row row-grid no-gutters">
                                        <div class="col">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                                    aria-labelledby="v-pills-home-tab">
                                                    <h3>
                                                        Info Personal
                                                    </h3>
                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-10">
                                                            <ul class="list-unstyled mb-0">
                                                                <li>
                                                                    <div class="row py-2">
                                                                        <div class="col-sm-4 d-flex align-items-center">
                                                                            <span class="font-weight-bold">Nama
                                                                                lengkap</span>
                                                                        </div>
                                                                        <div class="col-sm-8">Dimas Candra Pebriyanto</div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row py-2">
                                                                        <div class="col-sm-4 d-flex align-items-center">
                                                                            <span class="font-weight-bold">No HP</span>
                                                                        </div>
                                                                        <div class="col-sm-8">083865284307</div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row py-2">
                                                                        <div class="col-sm-4 d-flex align-items-center">
                                                                            <span class="font-weight-bold">Surel</span>
                                                                        </div>
                                                                        <div class="col-sm-8">dimascndraa18@gmail.com</div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row py-2">
                                                                        <div class="col-sm-4 d-flex align-items-center">
                                                                            <span class="font-weight-bold">Telepon</span>
                                                                        </div>
                                                                        <div class="col-sm-8">-</div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row py-2">
                                                                        <div class="col-sm-4 d-flex align-items-center">
                                                                            <span class="font-weight-bold">Tempat
                                                                                Lahir</span>
                                                                        </div>
                                                                        <div class="col-sm-8">Majalengka</div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row py-2">
                                                                        <div class="col-sm-4 d-flex align-items-center">
                                                                            <span class="font-weight-bold">Tanggal
                                                                                lahir</span>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <p class="d-flex">18 Februari 2003<span
                                                                                    class="ml-2 py-0 align-self-center badge badge-secondary p-1">
                                                                                    21 tahun</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row py-2">
                                                                        <div class="col-sm-4 d-flex align-items-center">
                                                                            <span class="font-weight-bold">Jenis
                                                                                kelamin</span>
                                                                        </div>
                                                                        <div class="col-sm-8">Pria</div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row py-2">
                                                                        <div class="col-sm-4 d-flex align-items-center">
                                                                            <span class="font-weight-bold">Status
                                                                                pernikahan</span>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <p>Lajang</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row py-2">
                                                                        <div class="col-sm-4 d-flex align-items-center">
                                                                            <span class="font-weight-bold">Golongan
                                                                                darah</span>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <p>HAI</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row py-2">
                                                                        <div class="col-sm-4 d-flex align-items-center">
                                                                            <span class="font-weight-bold">Agama</span>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <p>Islam</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col"><button type="button"
                                                                class="d-inline-flex btn btn-basic btn-sm">

                                                            </button></div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                                    aria-labelledby="v-pills-profile-tab">
                                                    <h3>
                                                        Profile
                                                    </h3>
                                                    <div class="d-flex flex-row rounded-top mb-3">
                                                        <div class="d-flex flex-row align-items-center mt-1 mb-1">
                                                            <span class="mr-2">
                                                                <img src="/img/demo/avatars/avatar-admin.png"
                                                                    class="rounded-circle profile-image"
                                                                    alt="Dr. Codex Lantern">
                                                            </span>
                                                            <div class="info-card-text">
                                                                <div class="fs-lg text-truncate text-truncate-lg">Dr. Codex
                                                                    Lantern
                                                                </div>
                                                                <span
                                                                    class="text-truncate text-truncate-md opacity-80">drlantern@gotbootstrap.com</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                                                        single-origin
                                                        coffee squid. Exercitation +1 labore velit, blog sartorial PBR
                                                        leggings next
                                                        level wes anderson artisan four loko farm-to-table craft beer twee.
                                                    </p>
                                                    <p>
                                                        Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip
                                                        jean
                                                        shorts ullamco ad vinyl cillum PBR. Homo nostrud organic.
                                                    </p>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                                    aria-labelledby="v-pills-messages-tab">
                                                    <h3>
                                                        Messages
                                                    </h3>
                                                    <ul class="notification">
                                                        <li>
                                                            <a href="#" class="d-flex align-items-center py-2 px-0">
                                                                <span class="d-flex flex-column flex-1">
                                                                    <span class="name">Melissa Ayre</span>
                                                                    <span class="msg-a fs-sm">Re: New security codes</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="d-flex align-items-center py-2 px-0">
                                                                <span class="d-flex flex-column flex-1">
                                                                    <span class="name">Adison Lee</span>
                                                                    <span class="msg-a fs-sm">Msed quia non numquam
                                                                        eius</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="d-flex align-items-center py-2 px-0">
                                                                <span class="d-flex flex-column flex-1">
                                                                    <span class="name">Oliver Kopyuv</span>
                                                                    <span class="msg-a fs-sm">Msed quia non numquam
                                                                        eius</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                                    aria-labelledby="v-pills-settings-tab">
                                                    <h3>Settings</h3>
                                                    <div class="alert alert-success">
                                                        <strong>
                                                            Settings saved
                                                        </strong>
                                                        <p class="m-0">
                                                            All your settings changes have been saved!
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
