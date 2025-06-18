@extends('admin.layouts.app')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Ubah</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item active">Ubah User</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">User</h5>
                    </div>

                    <div class="card-body">
                        <form id="userForm" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                <div class="mb-3 col-md-6 col-lg-6">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap"
                                        value="{{ $user->nama }}">
                                </div>
                                <div class="mb-3 col-md-6 col-lg-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email"
                                        value="{{ $user->email }}">
                                </div>
                                <div class="mb-3 col-md-6 col-lg-6">
                                    <label for="notelp" class="form-label">No Telepon</label>
                                    <input type="number" class="form-control" id="notelp" placeholder="No Telepon"
                                        value="{{ $user->notelp }}">
                                </div>
                                <div class="mb-3 col-md-6 col-lg-6">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" rows="1"> {{ $user->alamat }} </textarea>
                                </div>

                                <div class="mb-3 col-md-6 col-lg-6">
                                    <label for="role_id" class="form-label">Role</label>
                                    <select id="role_id" name="role_id" class="form-control">
                                        <option value="">Pilih Role</option>
                                        @foreach ($role as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $user->role_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6 col-lg-6">
                                    <label for="foto" class="form-label">Foto</label>
                                    <div class="input-group">
                                        <input type="file" id="foto" name="foto" class="form-control">
                                        <button type="button" class="btn btn-info" id="preview-btn">Preview</button>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input class="form-control" type="password" id="password" name="password"
                                                placeholder="Masukan Password">
                                            <span class="input-group-text cursor-pointer" id="togglePasswordIcon1">
                                                <i id="icon-pass1" class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <label for="password_confirmation" class="form-label">Konfirmasi
                                                Password</label>
                                            <div class="input-group">
                                                <input class="form-control" type="password" id="password_confirmation"
                                                    name="password_confirmation" placeholder="Konfirmasi Password">
                                                <span class="input-group-text cursor-pointer" id="togglePasswordIcon2">
                                                    <i id="icon-pass2" class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="{{ url('/usermanagement') }}"><button class="btn btn-info"
                                        type="button">Kembali</button></a>
                                <button type="submit" class="btn btn-primary btn-submit"> Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Preview Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="preview-content"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#userForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData();
            let fotoFile = $('#foto')[0].files[0];
            formData.append('id', $('#id').val());
            formData.append('role_id', $('#role_id').val());
            formData.append('nama', $('#nama').val());
            formData.append('email', $('#email').val());
            formData.append('notelp', $('#notelp').val());
            formData.append('alamat', $('#alamat').val());
            formData.append('password', $('#password').val());
            formData.append('password_confirmation', $('#password_confirmation').val());
            formData.append('foto', fotoFile ? fotoFile : '');

            $.ajax({
                url: `{{ url('usermanagement/_edit_user') }}`,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function() {
                    $(".overlay").show();
                    $(".loader").show();
                    $("#btn-login").hide()
                    $("#submit").prop("disabled", true);
                },
                success: function(response) {
                    $(".overlay").hide();
                    $(".loader").hide();
                    $("#submit").prop("disabled", false);
                    $("#btn-login").show();

                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-primary',
                            },
                        }).then(() => {
                            window.location.href = `{{ url('usermanagement') }}`;
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data Gagal Terkirim',
                            text: response.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-danger',
                            },
                        })
                    }
                },
                error: function(xhr) {
                    $(".overlay").hide();
                    $(".loader").hide();
                    $("#submit").prop("disabled", false);
                    $("#btn-login").show();

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        $.each(errors, function(key, value) {
                            errorMessage += `<p>${value[0]}</p>`;
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Data Gagal Terkirim',
                            html: errorMessage,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-danger',
                            },
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan, silahkan coba lagi.',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-danger',
                            },
                        });
                    }
                },
            });
        });

        flatpickr("#tanggal_lahir", {
            dateFormat: "d-m-Y",
        });

        $('#preview-btn').click(function() {
            var file = "{{ $user->foto }}";
            var path = "{{ asset('foto_user/') }}/";

            if (file) {
                var fileExtension = file.split('.').pop().toLowerCase();

                var previewContent = $('#preview-content');

                if (fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png') {
                    previewContent.html('<img src="' + path + file + '" class="img-fluid" />');
                } else if (fileExtension === 'pdf') {
                    previewContent.html('<embed src="' + path + file +
                        '" type="application/pdf" width="100%" height="400px" />');
                } else {
                    previewContent.html('<p>Preview tidak tersedia untuk file ini.</p>');
                }

                $('#previewModal').modal('show');
            } else {
                alert('File tidak ditemukan.');
            }
        });

        $("#togglePasswordIcon1").on("click", function() {
            let passwordInput = $("#password");
            let icon = $("#icon-pass1");

            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                icon.removeClass("fas fa-eye").addClass(
                    "fas fa-eye-slash");
            } else {
                passwordInput.attr("type", "password");
                icon.removeClass("fas fa-eye-slash").addClass(
                    "fas fa-eye");
            }
        });

        $("#togglePasswordIcon2").on("click", function() {
            let passwordInput = $("#password_confirmation");
            let icon = $("#icon-pass2");

            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                icon.removeClass("fas fa-eye").addClass(
                    "fas fa-eye-slash");
            } else {
                passwordInput.attr("type", "password");
                icon.removeClass("fas fa-eye-slash").addClass(
                    "fas fa-eye");
            }
        });
    </script>
@endpush
