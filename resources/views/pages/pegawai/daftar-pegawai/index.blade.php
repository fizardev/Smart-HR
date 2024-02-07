@extends('inc.layout')
@section('title', 'Organisasi')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Tambah Pegawai
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content mb-3">
                            <div class="row justify-content-center mt-3 mb-5">
                                <div>
                                    <a href="javascript:void(0);"
                                        class="btn mx-1 btn-lg btn-primary btn-icon step-round rounded-circle position-relative js-waves-off"
                                        id="step-round-1">
                                        1
                                        <span class="step-text">Info Pribadi</span>
                                    </a>
                                    <a href="javascript:void(0);"
                                        class="btn mx-1 btn-success btn-lg btn-icon step-round rounded-circle waves-effect waves-themed d-none"
                                        id="step-round-1-done">
                                        <i class="fal fa-check"></i>
                                    </a>
                                    <span class="garis"></span>
                                    <a href="javascript:void(0);"
                                        class="btn mx-1 btn-lg btn-outline-primary step-round btn-icon rounded-circle position-relative js-waves-off"
                                        id="step-round-2">
                                        2
                                        <span class="step-text">Info Pegawai</span>
                                    </a>
                                    <a href="javascript:void(0);"
                                        class="btn mx-1 btn-success btn-lg btn-icon step-round rounded-circle waves-effect waves-themed d-none"
                                        id="step-round-2-done">
                                        <i class="fal fa-check"></i>
                                    </a>
                                    <span class="garis"></span>
                                    <a href="javascript:void(0);"
                                        class="btn mx-1 btn-lg btn-outline-primary step-round btn-icon rounded-circle position-relative js-waves-off"
                                        id="step-round-3">
                                        3
                                        <span class="step-text">Gaji Pegawai</span>
                                    </a>
                                    <a href="javascript:void(0);"
                                        class="btn mx-1 btn-success btn-lg btn-icon step-round rounded-circle waves-effect waves-themed d-none"
                                        id="step-round-3-done">
                                        <i class="fal fa-check"></i>
                                    </a>
                                    <span class="garis"></span>
                                    <a href="javascript:void(0);"
                                        class="btn mx-1 btn-lg btn-outline-primary step-round btn-icon rounded-circle position-relative js-waves-off">
                                        4
                                        <span class="step-text">Invite Pegawai</span>
                                    </a>
                                </div>
                            </div>
                            <form action="" method="POST">
                                <div id="step-1">
                                    <div id="data-personal">
                                        <div class="row" style="margin-top: 70px">
                                            <div class="col-md-12">
                                                <h4 class="ui-sortable-handle form-heading">Data Personal</h4>
                                                <p class="mb-0">Isi data informasi pegawai berikut ini! </p>
                                                <hr style="margin-top: 10px !important;">
                                            </div>
                                        </div>
                                        <div class="form-group row" style="font-size: 0.8rem !important;">
                                            <div class="col-md-12 mb-3">
                                                <label>Nama*</label>
                                                <input type="text" class="form-control" autocomplete="off"
                                                    name="fullname" placeholder="Fizar Rama Waluyo, S. Kom.">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Email*</label>
                                                <input type="text" class="form-control" name="email" autocomplete="off"
                                                    placeholder="xxxxxx@gmail.com">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>No. Telepon*</label>
                                                <input type="text" class="form-control" name="mobile_phone"
                                                    autocomplete="off" placeholder="085xxxxxxxxx">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Tempat Lahir*</label>
                                                <input type="text" class="form-control" name="place_of_birth"
                                                    autocomplete="off" placeholder="Majalengka">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Tanggal Lahir*</label>
                                                <div class="input-group">
                                                    <input type="text" name="birthdate" class="form-control "
                                                        placeholder="Tanggal Lahir" id="datepicker-3">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text fs-xl">
                                                            <i class="fal fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Jenis Kelamin</label>
                                                <select class="select2 form-control w-100" id="gender" name="gender">
                                                    <option value=""></option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>

                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Status Menikah*</label>
                                                <select class="select2 form-control w-100" id="marital_status"
                                                    name="marital_status">
                                                    <option value=""></option>
                                                    <option value="Lajang">Lajang</option>
                                                    <option value="Menikah">Menikah</option>
                                                    <option value="Janda">Janda</option>
                                                    <option value="Duda">Duda</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Golongan Darah</label>
                                                <input type="text" class="form-control" name="blood_type"
                                                    autocomplete="off" placeholder="O">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Agama*</label>
                                                <select class="select2 form-control w-100" id="religion"
                                                    name="religion">
                                                    <option value=""></option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Katholik">Katholik</option>
                                                    <option value="Kristen">Kristen</option>
                                                    <option value="Budha">Budha</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data-identitas">
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <h4 class="ui-sortable-handle form-heading">Kartu Identitas</h4>
                                                <p class="mb-0">Isi data identitas berikut ini! </p>
                                                <hr style="margin-top: 10px !important;">
                                            </div>
                                        </div>
                                        <div class="form-group row" style="font-size: 0.8rem !important;">
                                            <div class="col-md-6 mb-3">
                                                <label>Tipe Identitas*</label>
                                                <select class="select2 form-control w-100" id="identity_type"
                                                    name="identity_type">
                                                    <option value=""></option>
                                                    <option value="KTP">KTP</option>
                                                    <option value="Passport">Passport</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Nomor Identitas*</label>
                                                <input type="text" class="form-control" name="identity_number"
                                                    autocomplete="off" placeholder="321xxxxxxxxx">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Masa Berlaku</label>
                                                <div class="input-group">
                                                    <input type="text" name="identity_expire_date"
                                                        class="form-control " placeholder="Kosongkan Jika Permanent"
                                                        id="identity_expire_date">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text fs-xl">
                                                            <i class="fal fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Postal Code</label>
                                                <input type="text" class="form-control" name="place_of_birth"
                                                    autocomplete="off" placeholder="454xx">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label" for="example-textarea">Alamat di KTP*</label>
                                                <textarea class="form-control" id="example-textarea" rows="3" name="citizen_id_address"></textarea>
                                                <div class="custom-control custom-checkbox mt-3">
                                                    <input type="checkbox" class="custom-control-input" id="sama-alamat">
                                                    <label class="custom-control-label" for="sama-alamat">Jadikan alaman
                                                        tempat
                                                        tinggal</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label" for="example-textarea">Alamat Tempat
                                                    Tinggal</label>
                                                <textarea class="form-control" id="example-textarea" rows="3" name="residental_address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-next mt-3 text-right">
                                        <a href="{{ route('dashboard') }}"
                                            class="btn btn-sm btn-outline-secondary">Batal</a>
                                        <a href="#"
                                            class="btn-next-step btn btn-primary btn-sm ml-2">Selanjutnya</a>
                                    </div>
                                </div>
                                <div id="step-2">
                                    <div id="data-personal">
                                        <div class="row" style="margin-top: 70px">
                                            <div class="col-md-12">
                                                <h4 class="ui-sortable-handle form-heading">Data Personal</h4>
                                                <p class="mb-0">Isi data informasi pegawai berikut ini! </p>
                                                <hr style="margin-top: 10px !important;">
                                            </div>
                                        </div>
                                        <div class="form-group row" style="font-size: 0.8rem !important;">
                                            <div class="col-md-12 mb-3">
                                                <label>Nama*</label>
                                                <input type="text" class="form-control" autocomplete="off"
                                                    name="fullname" placeholder="Fizar Rama Waluyo, S. Kom.">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Email*</label>
                                                <input type="text" class="form-control" name="email"
                                                    autocomplete="off" placeholder="xxxxxx@gmail.com">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>No. Telepon*</label>
                                                <input type="text" class="form-control" name="mobile_phone"
                                                    autocomplete="off" placeholder="085xxxxxxxxx">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Tempat Lahir*</label>
                                                <input type="text" class="form-control" name="place_of_birth"
                                                    autocomplete="off" placeholder="Majalengka">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Tanggal Lahir*</label>
                                                <div class="input-group">
                                                    <input type="text" name="birthdate" class="form-control "
                                                        placeholder="Tanggal Lahir" id="datepicker-3">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text fs-xl">
                                                            <i class="fal fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Jenis Kelamin</label>
                                                <select class="select2 form-control w-100" id="gender" name="gender">
                                                    <option value=""></option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>

                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Status Menikah*</label>
                                                <select class="select2 form-control w-100" id="marital_status"
                                                    name="marital_status">
                                                    <option value=""></option>
                                                    <option value="Lajang">Lajang</option>
                                                    <option value="Menikah">Menikah</option>
                                                    <option value="Janda">Janda</option>
                                                    <option value="Duda">Duda</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Golongan Darah</label>
                                                <input type="text" class="form-control" name="blood_type"
                                                    autocomplete="off" placeholder="O">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Agama*</label>
                                                <select class="select2 form-control w-100" id="religion"
                                                    name="religion">
                                                    <option value=""></option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Katholik">Katholik</option>
                                                    <option value="Kristen">Kristen</option>
                                                    <option value="Budha">Budha</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data-identitas">
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <h4 class="ui-sortable-handle form-heading">Kartu Identitas</h4>
                                                <p class="mb-0">Isi data identitas berikut ini! </p>
                                                <hr style="margin-top: 10px !important;">
                                            </div>
                                        </div>
                                        <div class="form-group row" style="font-size: 0.8rem !important;">
                                            <div class="col-md-6 mb-3">
                                                <label>Tipe Identitas*</label>
                                                <select class="select2 form-control w-100" id="identity_type"
                                                    name="identity_type">
                                                    <option value=""></option>
                                                    <option value="KTP">KTP</option>
                                                    <option value="Passport">Passport</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Nomor Identitas*</label>
                                                <input type="text" class="form-control" name="identity_number"
                                                    autocomplete="off" placeholder="321xxxxxxxxx">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Masa Berlaku</label>
                                                <div class="input-group">
                                                    <input type="text" name="identity_expire_date"
                                                        class="form-control " placeholder="Kosongkan Jika Permanent"
                                                        id="identity_expire_date">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text fs-xl">
                                                            <i class="fal fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Postal Code</label>
                                                <input type="text" class="form-control" name="place_of_birth"
                                                    autocomplete="off" placeholder="454xx">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label" for="example-textarea">Alamat di KTP*</label>
                                                <textarea class="form-control" id="example-textarea" rows="3" name="citizen_id_address"></textarea>
                                                <div class="custom-control custom-checkbox mt-3">
                                                    <input type="checkbox" class="custom-control-input" id="sama-alamat">
                                                    <label class="custom-control-label" for="sama-alamat">Jadikan alaman
                                                        tempat
                                                        tinggal</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label" for="example-textarea">Alamat Tempat
                                                    Tinggal</label>
                                                <textarea class="form-control" id="example-textarea" rows="3" name="residental_address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-next mt-3 text-right">
                                        <a href="{{ route('dashboard') }}"
                                            class="btn btn-sm btn-outline-secondary">Batal</a>
                                        <a href="#"
                                            class="btn-next-step btn btn-primary btn-sm ml-2">Selanjutnya</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.master-data.organization.partials.create-data')
        @include('pages.master-data.organization.partials.update-data')
    </main>
@endsection
@section('plugin')
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script src="/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function() {
            $(function() {
                $('.select2').select2({
                    placeholder: 'Pilih Data Berikut'
                });
            });
            $('.btn-next .btn-next-step').click(function(e) {
                e.preventDefault();
                let parent = $(this).parent().parent();
                console.log(parent.attr('id'));
                $("html, body").animate({
                    scrollTop: 0
                }, 500);
                parent.fadeOut(1000, function() {
                    // Callback akan dipanggil setelah animasi selesai
                    parent.addClass(
                        'hidden-content'); // Mengatur kelas "hidden" untuk mengubah visibility
                    parent.removeAttr('style');
                });

            })
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
        });
    </script>
@endsection
