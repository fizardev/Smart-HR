@extends('inc.layout')
@section('title', 'Company')
@section('extended-css')

@endsection
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Detail Perusahaan
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content pb-5">
                            <div class="card m-auto" style="max-width: 18rem; border:none; box-shadow:none;">
								<img src="{{ asset('/storage/img/' . $company->logo)}}" class="card-img-top create-img-preview" alt="...">
							</div>
                            <div class="container mt-4">
                                <form class="form font-weight-bold" id="update-form" role="form" autocomplete="off" data-id="{{ $company->id }}" enctype="multipart/form-data">
                                    @method('POST')
                                    @csrf
                                    <div class="form-group font-weight-bold row">
                                        <label class="col-lg-3 col-form-label form-control-label">Nama Instansi/Perusahaan</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="name" type="text" value="{{ $company->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Nomor Telp</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="phone_number" type="text" value="{{ $company->phone_number }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="email" type="email" value="{{ $company->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Alamat</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="address" type="text" value="{{ $company->address }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Provinsi</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="province" type="text" value="{{ $company->province }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Kabupaten/Kota</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="city" type="text" value="{{ $company->city }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Kategori</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="category" type="text" value="{{ $company->category }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Kelas</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="class" type="text" value="{{ $company->class }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Izin Operasional Rumah Sakit</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="operating_permit_number" type="text" value="{{ $company->operating_permit_number }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Logo</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="logo" type="file" id="create-image" onchange="createPreviewImage()">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9 mb-2">
                                            <button class="btn btn-primary waves-effect waves-themed" type="submit">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
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
    <script>
        function createPreviewImage() {
            const image = document.querySelector('#create-image');
            const imgPreview = document.querySelector('.create-img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
        $(document).ready(function() {
            $('#update-form').on('submit', function(e) {
                const fd = new FormData(this);
                e.preventDefault();
                var id = $('#update-form').attr('data-id');
                $.ajax({
                    type: 'POST',
                    url: '/api/dashboard/company/' + id,
                    processData: false,
                    contentType: false,
                    data: fd,
                    // beforeSend: function() {
                    //     console.log($(this).serialize());
                    //     $(".loading-form").removeClass("d-none");
                    //     $(".loading-form").fadeIn("slow");
                    // },
                    success: function(response) {
                        // Hilangkan Loader
                        // $('.loading-form').fadeOut("slow");
                        //tampilkan pesan
                        // showSuccessAlert('Setting Diubah!');
                        // Tunda reload selama 2 detik
                        console.log('success')
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    },
                    error: function(error) {
                        console.log(error);
                        // $('.loading-form').fadeOut("slow");
                        // Handle errors, e.g., display validation errors
                        // showErrorAlert('Cek kembali data yang dikirim');
                        // console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
