@extends('inc.layout')
@section('title', 'Organisasi')
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
            padding: 8px 15px;
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
                                            <p>Drag & Drop Excel files here</p>
                                            <p>or</p>
                                            <label class="button" for="fileElem">Browse Files</label>
                                            <input type="file" id="fileElem" multiple accept=".xls, .xlsx"
                                                style="display: none;" name="attendance_shift">
                                        </div>
                                    </div>
                                    <div id="fileList"></div>
                                    <button type="submit" class="btn btn-primary btn-block"><i
                                            class="fas fa-upload mr-2"></i> Simpan Data </button>
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
            $('#store-form').submit(function(event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: 'your-api-endpoint', // Ganti dengan endpoint API Anda
                    type: 'POST',
                    data: formData,
                    async: true, // Set async menjadi true untuk melakukan operasi secara asynchronous
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log('Data berhasil disimpan:', response);
                        // Lakukan tindakan setelah data disimpan, misalnya menampilkan pesan sukses
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Gagal menyimpan data:', errorThrown);
                        // Tampilkan pesan error kepada pengguna
                    }
                });
            });
            // Drag enter
            $("#drop-area").on("dragenter", function(event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).addClass("drag-over");
            });

            // Drag leave
            $("#drop-area").on("dragleave", function(event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).removeClass("drag-over");
            });

            // Drag over
            $("#drop-area").on("dragover", function(event) {
                event.preventDefault();
                event.stopPropagation();
            });

            // Drop
            $("#drop-area").on("drop", function(event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).removeClass("drag-over");

                var files = event.originalEvent.dataTransfer.files;
                handleFiles(files);
            });

            // Input change
            $("#fileElem").on("change", function() {
                var files = $(this)[0].files;
                handleFiles(files);
            });

            function handleFiles(files) {
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
    </script>
@endsection
