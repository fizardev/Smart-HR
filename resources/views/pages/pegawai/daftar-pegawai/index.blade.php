@extends('inc.layout')
@section('title', 'Pegawai')
@section('extended-css')
    <style>
        .upload-container {
            width: 100%;
        }

        .upload-wrapper {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            background-color: #fff;
        }

        .upload-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .upload-text p {
            margin: 0;
        }

        .button {
            margin-top: 10px;
            display: inline-block;
            padding: 6px 15px;
            background-color: #fd1381;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }

        #fileList {
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="panel-container show">
            <div class="panel-content">
                <div class="row mb-5">
                    <div class="col-xl-12">
                        <div id="panel-1" class="panel">
                            <div class="panel-container show">
                                <div class="panel-content tab-content">
                                    <ul class="nav nav-pills mb-5 mt-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                href="#js_pill_border_icon-1" role="tab"><i
                                                    class="fal fa-user-circle mr-1"></i>Daftar Pegawai</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                href="#js_pill_border_icon-2" role="tab"><i
                                                    class="fal fa-plus-circle mr-1"></i>Tambah Pegawai</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                href="#js_pill_border_icon-3" role="tab"><i
                                                    class="fal fa-plus-circle mr-1"></i>Import Pegawai</a></li>
                                    </ul>
                                    <div class="tab-content px-0">
                                        <div class="tab-pane fade show active" id="js_pill_border_icon-1" role="tabpanel">
                                            <!-- datatable start -->
                                            <table id="dt-basic-example"
                                                class="table table-bordered table-hover table-striped w-100">
                                                <thead>
                                                    <tr>
                                                        {{-- <th style="white-space: nowrap">Foto</th> --}}
                                                        <th style="white-space: nowrap">ID Pegawai</th>
                                                        <th style="white-space: nowrap">Nama</th>
                                                        <th style="white-space: nowrap">Mulai Kontrak</th>
                                                        <th style="white-space: nowrap">Akhir Kontrak</th>
                                                        <th style="white-space: nowrap">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($employees as $row)
                                                        <tr>
                                                            {{-- <td style="white-space: nowrap">{{ $user->template_user->foto }}</td> --}}
                                                            <td style="white-space: nowrap">{{ $row->id }}</td>
                                                            <td style="white-space: nowrap">{{ $row->fullname }}</td>
                                                            <td style="white-space: nowrap">{{ $row->join_date }}</td>
                                                            <td style="white-space: nowrap">{{ $row->end_status_date }}</td>
                                                            <td style="white-space: nowrap">
                                                                <button type="button" data-backdrop="static"
                                                                    data-keyboard="false"
                                                                    class="badge mx-1 btn-edit badge-primary p-2 border-0 text-white"
                                                                    data-id="{{ $row->id }}" title="Ubah"
                                                                    onclick="btnEdit(event)">
                                                                    <span class="fal fa-pencil ikon-edit"></span>
                                                                    <div class="span spinner-text d-none">
                                                                        <span class="spinner-border spinner-border-sm"
                                                                            role="status" aria-hidden="true"></span>
                                                                        Loading...
                                                                    </div>
                                                                </button>
                                                                <button type="button" data-backdrop="static"
                                                                    data-keyboard="false"
                                                                    class="badge mx-1 badge-success p-2 border-0 text-white btn-hapus"
                                                                    data-id="{{ $row->id }}" title="Hapus"
                                                                    onclick="btnDelete(event)">
                                                                    <span class="fal fa-trash ikon-hapus"></span>
                                                                    <div class="span spinner-text d-none">
                                                                        <span class="spinner-border spinner-border-sm"
                                                                            role="status" aria-hidden="true"></span>
                                                                        Loading...
                                                                    </div>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th style="white-space: nowrap">ID Pegawai</th>
                                                        <th style="white-space: nowrap">Nama</th>
                                                        <th style="white-space: nowrap">Mulai Kontrak</th>
                                                        <th style="white-space: nowrap">Akhir Kontrak</th>
                                                        <th style="white-space: nowrap">Aksi</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <!-- datatable end -->
                                        </div>
                                        <div class="tab-pane fade show" id="js_pill_border_icon-3" role="tabpanel">
                                            <form id="import-pegawai" enctype="multipart/form-data">
                                                @method('POST')
                                                @csrf

                                                <div class="upload-container">
                                                    <div class="upload-wrapper" id="drop-area">
                                                        <div class="upload-icon">
                                                            <i class="fas fa-file-excel"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <p>Klik tombol dibawah ini untuk upload file</p>
                                                            <label class="button" for="fileElem">Browse Files</label>
                                                            <input type="file" id="fileElem" multiple
                                                                accept=".xls, .xlsx" style="display: none;"
                                                                name="employee_import">
                                                        </div>
                                                    </div>
                                                    <div id="fileList"></div>

                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <div class="ikon-tambah">
                                                            <span class="fas fa-upload mr-1"></span>
                                                            Tambah
                                                        </div>
                                                        <div class="span spinner-text d-none">
                                                            <span class="spinner-border spinner-border-sm" role="status"
                                                                aria-hidden="true"></span>
                                                            Loading...
                                                        </div>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane p-3 fade" id="js_pill_border_icon-2" role="tabpanel">

                                            <div class="tambah-pegawai-baru mt-3 mb-3">
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
                                                <form action="" method="POST" id="store-form">
                                                    @method('POST')
                                                    @csrf
                                                    <div id="step-1">
                                                        <div id="data-personal">
                                                            <div class="row" style="margin-top: 70px">
                                                                <div class="col-md-12">
                                                                    <h4 class="ui-sortable-handle form-heading">Data
                                                                        Personal</h4>
                                                                    <p class="mb-0">Isi data informasi pegawai berikut
                                                                        ini! </p>
                                                                    <hr style="margin-top: 10px !important;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row"
                                                                style="font-size: 0.8rem !important;">
                                                                <div class="col-md-12 mb-3">
                                                                    <label>Nama*</label>
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off" name="fullname"
                                                                        placeholder="Fizar Rama Waluyo, S. Kom.">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Email*</label>
                                                                    <input type="text" class="form-control"
                                                                        name="email" autocomplete="off"
                                                                        placeholder="xxxxxx@gmail.com">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>No. Telepon*</label>
                                                                    <input type="text" class="form-control"
                                                                        name="mobile_phone" autocomplete="off"
                                                                        placeholder="085xxxxxxxxx">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tempat Lahir*</label>
                                                                    <input type="text" class="form-control"
                                                                        name="place_of_birth" autocomplete="off"
                                                                        placeholder="Majalengka">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tanggal Lahir</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="birthdate"
                                                                            class="form-control "
                                                                            placeholder="Tanggal Lahir" id="birthdate">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text fs-xl">
                                                                                <i class="fal fa-calendar-alt"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Jenis Kelamin</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="gender" name="gender">
                                                                        <option value=""></option>
                                                                        <option value="Laki-laki">Laki-laki</option>
                                                                        <option value="Perempuan">Perempuan</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Status Menikah*</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="marital_status" name="marital_status">
                                                                        <option value=""></option>
                                                                        <option value="Lajang">Lajang</option>
                                                                        <option value="Menikah">Menikah</option>
                                                                        <option value="Janda">Janda</option>
                                                                        <option value="Duda">Duda</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Golongan Darah</label>
                                                                    <input type="text" class="form-control"
                                                                        name="blood_type" autocomplete="off"
                                                                        placeholder="O">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Agama*</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="religion" name="religion">
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
                                                                    <h4 class="ui-sortable-handle form-heading">Kartu
                                                                        Identitas</h4>
                                                                    <p class="mb-0">Isi data identitas berikut ini! </p>
                                                                    <hr style="margin-top: 10px !important;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row"
                                                                style="font-size: 0.8rem !important;">
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tipe Identitas*</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="identity_type" name="identity_type">
                                                                        <option value=""></option>
                                                                        <option value="KTP">KTP</option>
                                                                        <option value="Passport">Passport</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Nomor Identitas*</label>
                                                                    <input type="text" class="form-control"
                                                                        name="identity_number" autocomplete="off"
                                                                        placeholder="321xxxxxxxxx">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Masa Berlaku</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="identity_expire_date"
                                                                            class="form-control "
                                                                            placeholder="Kosongkan Jika Permanent"
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
                                                                    <input type="text" class="form-control"
                                                                        name="place_of_birth" autocomplete="off"
                                                                        placeholder="454xx">
                                                                </div>
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label"
                                                                        for="example-textarea">Alamat di
                                                                        KTP*</label>
                                                                    <textarea class="form-control" id="citizen_id_address" rows="3" name="citizen_id_address"></textarea>
                                                                    <div class="custom-control custom-checkbox mt-3">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input" id="sama-alamat">
                                                                        <label class="custom-control-label"
                                                                            for="sama-alamat">Jadikan
                                                                            alaman
                                                                            tempat
                                                                            tinggal</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label"
                                                                        for="example-textarea">Alamat Tempat
                                                                        Tinggal</label>
                                                                    <textarea class="form-control" id="residental_address" rows="3" name="residental_address"></textarea>
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
                                                    <div id="step-2" style="display: none">
                                                        <div id="data-pegawai">
                                                            <div class="row" style="margin-top: 70px">
                                                                <div class="col-md-12">
                                                                    <h4 class="ui-sortable-handle form-heading">Data
                                                                        Kepegawaian</h4>
                                                                    <p class="mb-0">Isi data informasi pegawai berikut
                                                                        ini! </p>
                                                                    <hr style="margin-top: 10px !important;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row"
                                                                style="font-size: 0.8rem !important;">
                                                                <div class="col-md-12 mb-3">
                                                                    <label>Nomor Induk Pegawai*</label>
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off" name="employee_id"
                                                                        placeholder="2024xxxxx">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Barcode</label>
                                                                    <input type="text" class="form-control"
                                                                        name="barcode" autocomplete="off"
                                                                        placeholder="2024xxxxx">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Status Pegawai*</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="employment_status" name="employment_status">
                                                                        <option value=""></option>
                                                                        <option value="Permanen">Permanen</option>
                                                                        <option value="Kontrak">Kontrak</option>
                                                                        <option value="Percobaan">Percobaan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tanggal Masuk Kerja*</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="join_date"
                                                                            class="form-control "
                                                                            placeholder="Tanggal Masuk Kerja"
                                                                            id="join_date">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text fs-xl">
                                                                                <i class="fal fa-calendar-alt"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Organisasi*</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="organization" name="organization">
                                                                        <option value=""></option>
                                                                        @foreach ($organizations as $row)
                                                                            <option value="{{ $row->id }}">
                                                                                {{ $row->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Jabatan*</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="job_position_id" name="job_position_id">
                                                                        <option value=""></option>
                                                                        @foreach ($jobPosition as $row)
                                                                            <option value="{{ $row->id }}">
                                                                                {{ $row->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Level Jabatan*</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="job_level_id" name="job_level_id">
                                                                        <option value=""></option>
                                                                        @foreach ($jobLevel as $row)
                                                                            <option value="{{ $row->id }}">
                                                                                {{ $row->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Approval Line*</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="approval_line" name="approval_line">
                                                                        <option value=""></option>
                                                                        @foreach ($employees as $row)
                                                                            <option value="{{ $row->id }}">
                                                                                {{ $row->fullname }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Manager*</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="approval_line_parent"
                                                                        name="approval_line_parent">
                                                                        <option value=""></option>
                                                                        @foreach ($employees as $row)
                                                                            <option value="{{ $row->id }}">
                                                                                {{ $row->fullname }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="btn-next mt-3 text-right">
                                                            <a href="{{ route('dashboard') }}"
                                                                class="btn btn-sm btn-outline-secondary btn-prev">Sebelumnya</a>
                                                            <a href="#"
                                                                class="btn-next-step btn btn-primary btn-sm ml-2">Selanjutnya</a>
                                                        </div>
                                                    </div>
                                                    <div id="step-3" style="display: none">
                                                        <div id="data-gaji">
                                                            <div class="row" style="margin-top: 70px">
                                                                <div class="col-md-12">
                                                                    <h4 class="ui-sortable-handle form-heading">Data Gaji
                                                                    </h4>
                                                                    <p class="mb-0">Isi data informasi berikut ini! </p>
                                                                    <hr style="margin-top: 10px !important;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row"
                                                                style="font-size: 0.8rem !important;">
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Gaji Pokok*</label>
                                                                    <input type="number" class="form-control"
                                                                        autocomplete="off" name="basic_salary"
                                                                        placeholder="2024xxxxx">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tanggal Pembayaran Gaji</label>
                                                                    <input type="payment_schedule" class="form-control "
                                                                        value="Default" disabled>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tipe Gaji</label>
                                                                    <div class="frame-wrap mt-2">
                                                                        <div
                                                                            class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio"
                                                                                class="custom-control-input"
                                                                                id="defaultInline1Radio"
                                                                                name="salary_type" value="bulanan"
                                                                                checked="">
                                                                            <label class="custom-control-label"
                                                                                for="defaultInline1Radio">Bulanan</label>
                                                                        </div>
                                                                        <div
                                                                            class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio"
                                                                                class="custom-control-input"
                                                                                id="defaultInline2Radio"
                                                                                name="salary_type" value="harian">
                                                                            <label class="custom-control-label"
                                                                                for="defaultInline2Radio">Harian</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Dibolehkan Untuk Lembur</label>
                                                                    <div class="frame-wrap mt-2">
                                                                        <div
                                                                            class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio"
                                                                                class="custom-control-input"
                                                                                id="prorate_setting1"
                                                                                name="allowed_for_overtime" value="iya"
                                                                                checked="">
                                                                            <label class="custom-control-label"
                                                                                for="prorate_setting1">Iya</label>
                                                                        </div>
                                                                        <div
                                                                            class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio"
                                                                                class="custom-control-input"
                                                                                id="prorate_setting2"
                                                                                name="allowed_for_overtime"
                                                                                value="tidak">
                                                                            <label class="custom-control-label"
                                                                                for="prorate_setting2">Tidak</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="data-bank">
                                                            <div class="row mt-3">
                                                                <div class="col-md-12">
                                                                    <h4 class="ui-sortable-handle form-heading">Akun Bank
                                                                    </h4>
                                                                    <p class="mb-0">Isi data bank berikut ini untuk
                                                                        penggajian! </p>
                                                                    <hr style="margin-top: 10px !important;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row"
                                                                style="font-size: 0.8rem !important;">
                                                                <div class="col-md-12 mb-3">
                                                                    <label>Nama Bank*</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="bank_name" name="bank_name">
                                                                        <option value=""></option>
                                                                        <option value="BRI">BRI</option>
                                                                        <option value="BJB">BJB</option>
                                                                        <option value="Mandiri">Mandiri</option>
                                                                        <option value="BCA">BCA</option>
                                                                        <option value="BSI">BSI</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Nomor Rekening*</label>
                                                                    <input type="text" class="form-control"
                                                                        name="account_number" autocomplete="off"
                                                                        placeholder="4310xxxxxxxx">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Nama Rekening*</label>
                                                                    <input type="text" class="form-control"
                                                                        name="account_holder_name" autocomplete="off"
                                                                        placeholder="Fizar Rama Waluyo">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="data-pajak">
                                                            <div class="row mt-3">
                                                                <div class="col-md-12">
                                                                    <h4 class="ui-sortable-handle form-heading">Konfigurasi
                                                                        Pajak</h4>
                                                                    <p class="mb-0">Isi data berikut ini! </p>
                                                                    <hr style="margin-top: 10px !important;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row"
                                                                style="font-size: 0.8rem !important;">
                                                                <div class="col-md-6 mb-3">
                                                                    <label>NPWP</label>
                                                                    <input type="text" class="form-control"
                                                                        name="npwp" autocomplete="off"
                                                                        placeholder="0000 0000 0000 0000">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>PTKP Status</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="ptkp_status" name="ptkp_status">
                                                                        <option value="TK/0">
                                                                            TK/0
                                                                        </option>
                                                                        <option value="TK/1">
                                                                            TK/1
                                                                        </option>
                                                                        <option value="TK/2">
                                                                            TK/2
                                                                        </option>
                                                                        <option value="TK/3">
                                                                            TK/3
                                                                        </option>
                                                                        <option value="K/0">
                                                                            K/0
                                                                        </option>
                                                                        <option value="K/1">
                                                                            K/1
                                                                        </option>
                                                                        <option value="K/2">
                                                                            K/2
                                                                        </option>
                                                                        <option value="K/3">
                                                                            K/3
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tax Methode</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="tax_methode" name="tax_methode">
                                                                        <option value="Gross">Gross</option>
                                                                        <option value="Gross Up">Gross Up</option>
                                                                        <option value="Netto">Netto</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tax Salary</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="tax_salary" name="tax_salary">
                                                                        <option value="Taxable">Taxable</option>
                                                                        <option value="Non-Taxable">Non-Taxable</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Taxable Date</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="taxable_date"
                                                                            class="form-control "
                                                                            placeholder="Taxable Date" id="taxable_date">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text fs-xl">
                                                                                <i class="fal fa-calendar-alt"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Status Pajak Pegawai</label>
                                                                    <select class="select2 form-control w-100"
                                                                        id="employment_tax_status"
                                                                        name="employment_tax_status">
                                                                        <option value="Pegawai tetap">Pegawai tetap
                                                                        </option>
                                                                        <option value="Pegawai tidak tetap">Pegawai tidak
                                                                            tetap
                                                                        </option>
                                                                        <option
                                                                            value="Bukan pegawai yang bersifat berkesinambungan">
                                                                            Bukan
                                                                            pegawai yang bersifat berkesinambungan</option>
                                                                        <option
                                                                            value="Bukan pegawai yang tidak bersifat berkesinambungan">
                                                                            Bukan pegawai yang tidak bersifat
                                                                            berkesinambungan</option>
                                                                        <option value="Ekspatriat">Ekspatriat</option>
                                                                        <option value="Ekspatriat dalam negeri">Ekspatriat
                                                                            dalam negeri
                                                                        </option>
                                                                        <option
                                                                            value="Tenaga ahli yang bersifat berkesinambungan">
                                                                            Tenaga ahli
                                                                            yang bersifat berkesinambungan</option>
                                                                        <option
                                                                            value="Tenaga ahli yang tidak bersifat berkesinambungan">
                                                                            Tenaga
                                                                            ahli yang tidak bersifat berkesinambungan
                                                                        </option>
                                                                        <option value="Dewan komisaris">Dewan komisaris
                                                                        </option>
                                                                        <option
                                                                            value="Tenaga ahli yang bersifat berkesinambungan 1 PK">
                                                                            Tenaga ahli yang bersifat berkesinambungan 1 PK
                                                                        </option>
                                                                        <option value="Tenaga kerja lepas">Tenaga kerja
                                                                            lepas</option>
                                                                        <option
                                                                            value="Bukan pegawai yang bersifat berkesinambungan 1 PK">
                                                                            Bukan pegawai yang bersifat berkesinambungan 1
                                                                            PK</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Beginning Netto</label>
                                                                    <input type="text" name="beginning_netto"
                                                                        id="beginning_netto" placeholder="100000"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>PPH21 Paid</label>
                                                                    <input type="text" name="pph21_paid"
                                                                        id="pph21_paid" placeholder="100000"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="btn-next mt-3 text-right">
                                                            <a href="{{ route('dashboard') }}"
                                                                class="btn btn-sm btn-outline-secondary btn-prev">Sebelumnya</a>
                                                            <a href="#"
                                                                class="btn-next-step btn btn-primary btn-sm ml-2">Selanjutnya</a>
                                                        </div>
                                                    </div>
                                                    <div id="step-4" style="display: none">
                                                        <div id="data-gaji">
                                                            <div class="row" style="margin-top: 70px">
                                                                <div class="col-md-12">
                                                                    <h4 class="ui-sortable-handle form-heading">Apakah Data
                                                                        Pegawai
                                                                        yang Sudah
                                                                        Diisikan Benar?
                                                                    </h4>
                                                                    <p class="mb-0">Klik tombol Tambah dibawah ini untuk
                                                                        menyimpan
                                                                        Data
                                                                        Pegawai!</p>
                                                                    <hr style="margin-top: 10px !important;">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="btn-next mt-3 text-right">
                                                            <a href="{{ route('dashboard') }}"
                                                                class="btn btn-sm btn-outline-secondary btn-prev">Sebelumnya</a>
                                                            <button type="submit" class="btn btn-sm btn-primary">
                                                                <div class="ikon-tambah">
                                                                    <span class="fal fa-plus-circle mr-1"></span>
                                                                    Tambah
                                                                </div>
                                                                <div class="span spinner-text d-none">
                                                                    <span class="spinner-border spinner-border-sm"
                                                                        role="status" aria-hidden="true"></span>
                                                                    Loading...
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
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
            // Input change
            $("#fileElem").on("change", function() {
                var files = $(this)[0].files;
                handleFiles(files);
            });

            function handleFiles(files) {
                console.log(files);
                var allowedExtensions = /(\.xls|\.xlsx)$/i;
                var fileList = $("#fileList");
                fileList.empty();

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];

                    if (!allowedExtensions.test(file.name)) {
                        alert("Only Excel files (.xls, .xlsx) are allowed.");
                        continue;
                    }

                    // Display file name
                    fileList.append("<div>" + file.name + "</div>");

                    // You can handle the file here
                    console.log("File uploaded:", file.name);
                }
            }

            $('#import-pegawai').submit(function(event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: '/api/dashboard/employee/import', // Ganti dengan endpoint API Anda
                    type: 'POST',
                    data: formData,
                    async: true, // Set async menjadi true untuk melakukan operasi secara asynchronous
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#import-pegawai').find('.ikon-tambah').hide();
                        $('#import-pegawai').find('.spinner-text').removeClass('d-none');
                    },
                    success: function(response) {
                        $('#import-pegawai').find('.ikon-edit').show();
                        $('#import-pegawai').find('.spinner-text').addClass('d-none');
                        $('#tambah-data').modal('hide');
                        showSuccessAlert(response.message)
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('Gagal:', errorThrown);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                        // Tampilkan pesan error kepada pengguna
                    }
                });
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
                format: "yyyy-mm-dd"
            });
            $('#identity_expire_date').datepicker({
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
                format: "yyyy-mm-dd"
            });
            $('#join_date').datepicker({
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
                format: "yyyy-mm-dd"
            });
        });
    </script>
@endsection
