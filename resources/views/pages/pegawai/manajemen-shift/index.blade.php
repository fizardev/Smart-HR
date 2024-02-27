@extends('inc.layout')
@section('title', 'Manajemen Shift')
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
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-container show">
                        <div class="panel-content upload-file-wrapper">
                            <button type="submit" class="btn btn-success mb-4"><i class="fas fa-download mr-2"></i> Unduh
                                Template </button>
                            <form action="" id="store-form" enctype="multipart/form-data">
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
                                            <input type="file" id="fileElem" multiple accept=".xls, .xlsx"
                                                style="display: none;" name="attendance_shift">
                                        </div>
                                    </div>
                                    <div id="fileList"></div>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <div class="ikon-tambah">
                                            <span class="fal fa-upload mr-1"></span>
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
                    </div>
                </div>
            </div>
    </main>
@endsection
@section('plugin')
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script>
        $(document).ready(function() {

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
        });
        $('#store-form').submit(function(event) {
            event.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '/api/dashboard/management-shift/store', // Ganti dengan endpoint API Anda
                type: 'POST',
                data: formData,
                async: true, // Set async menjadi true untuk melakukan operasi secara asynchronous
                cache: false,
                contentType: false,
                processData: false,
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
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Gagal menyimpan data:', errorThrown);
                    // Tampilkan pesan error kepada pengguna
                }
            });
        });
    </script>
@endsection
