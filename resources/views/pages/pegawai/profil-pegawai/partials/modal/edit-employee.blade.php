<style>
    .modal {
        top: 0 !important;
    }
</style>

<div class="modal fade font-weight-bold p-0" id="ubah-personal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form autocomplete="off" action="#" novalidate method="post" id="update-personal-form">
                @method('put')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Info Personal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="fullname">Nama</label>
                                <input type="text" value="{{ old('fullname') }}"
                                    class="form-control @error('fullname') is-invalid @enderror" id="fullname"
                                    name="fullname" placeholder="Nama">
                                @error('fullname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="select2 form-control w-100" id="gender" name="gender">
                                    <option value=""></option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="mobile_phone">No HP</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+</span>
                                    </div>
                                    <input type="text" value="{{ old('mobile_phone') }}"
                                        class="form-control @error('mobile_phone') is-invalid @enderror"
                                        id="mobile_phone" name="mobile_phone" placeholder="No HP">
                                </div>
                                @error('mobile_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="place_of_birth">Tempat Lahir</label>
                                <input type="text" value="{{ old('place_of_birth') }}"
                                    class="form-control @error('place_of_birth') is-invalid @enderror"
                                    id="place_of_birth" name="place_of_birth" placeholder="Tempat Lahir">
                                @error('place_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="marital-status">Status Menikah*</label>
                                <select class="select2 form-control w-100" id="marital-status" name="marital_status">
                                    <option value=""></option>
                                    <option value="Lajang">Lajang</option>
                                    <option value="Menikah">Menikah</option>
                                    <option value="Janda">Janda</option>
                                    <option value="Duda">Duda</option>
                                </select>
                                @error('marital_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" placeholder="Email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="birthdate">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" name="birthdate"
                                        class="form-control @error('birthdate') is-invalid @enderror"
                                        placeholder="Tanggal Lahir" id="birthdate">
                                    <div class="input-group-append">
                                        <span class="input-group-text fs-xl">
                                            <i class="fal fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('birthdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Agama*</label>
                                <select class="select2 form-control w-100" id="religion" name="religion">
                                    <option value=""></option>
                                    <option value="Islam">Islam</option>
                                    <option value="Katholik">Katholik</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                @error('religion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="blood-type">Golongan Darah</label>
                                <input type="text" id="blood-type" class="form-control" name="blood_type"
                                    autocomplete="off" placeholder="O">
                                @error('blood_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <div class="ikon-edit">
                            <span class="fal fa-pencil mr-1"></span>
                            Ubah
                        </div>
                        <div class="span spinner-text d-none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.btn-ubah-personal').click(function(e) {
        e.preventDefault();
        let button = $(this);
        let id = button.attr('data-id');
        button.find('.ikon-edit').hide();
        button.find('.spinner-text').removeClass('d-none');

        $.ajax({
            type: "GET", // Method pengiriman data bisa dengan GET atau POST
            url: `/api/dashboard/employee/get/${id}`, // Isi dengan url/path file php yang dituju
            dataType: "json",
            success: function(data) {
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
</script>
