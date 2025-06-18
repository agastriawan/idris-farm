@extends('admin.layouts.app')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Profile</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">admin</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center">

                            <div class="silva-main-sections">
                                <div class="silva-profile-main">
                                    <img src="{{ Auth::user()->foto ? asset('foto_user/' . Auth::user()->foto) : asset('assets_admin/images/user.png') }}"
                                        id="imagePreview"
                                        class="rounded-circle img-fluid avatar-xxl img-thumbnail float-start"
                                        alt="image profile" style="cursor: pointer;">

                                    <input type="file" name="foto" id="foto" style="display: none;">

                                    <span class="sil-profile_main-pic-change img-thumbnail">
                                        <i class="mdi mdi-camera text-white"></i>
                                    </span>
                                </div>

                                <div class="overflow-hidden ms-md-4 ms-0">
                                    <h4 class="m-0 text-dark fs-20 mt-2 mt-md-0">{{ $user->nama }}</h4>
                                    <span class="fs-15"><i class="mdi mdi-message me-2 align-middle"></i><span
                                            class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">{{ $user->notelp }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body pt-0">
                        <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link p-2 active" id="setting_tab" data-bs-toggle="tab" href="#profile_setting"
                                    role="tab">
                                    {{-- <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span> --}}
                                    <span class="d-sm-block">Ubah Profile</span>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-2" id="password_tab" data-bs-toggle="tab" href="#password_setting"
                                    role="tab">
                                    {{-- <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span> --}}
                                    <span class="d-sm-block">Ubah Password</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content text-muted bg-white">
                            <div class="tab-pane pt-4 active" id="profile_setting" role="tabpanel">
                                <div class="row">

                                    <div class="row">
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="card border">

                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h4 class="card-title mb-0">Informasi Pribadi</h4>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <form id="informasiForm">
                                                        <input type="hidden" name="id" id="id"
                                                            value="{{ $user->id }}">
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Nama Lengkap</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="text"
                                                                    value="{{ $user->nama }}" id="nama">
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Nomor WhatsApp</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-phone-outline"></i></span>
                                                                    <input class="form-control" type="text"
                                                                        placeholder="Phone" aria-describedby="basic-addon1"
                                                                        value="{{ $user->notelp }}" id="notelp">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Email</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-email"></i></span>
                                                                    <input type="email" class="form-control"
                                                                        value="{{ $user->email }}" placeholder="Email"
                                                                        aria-describedby="basic-addon1" id="email">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Alamat</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="text"
                                                                    value="{{ $user->alamat }}" id="alamat">
                                                            </div>
                                                        </div>

                                                        <div class="row text-end">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary">Ubah
                                                                    Informasi Pribadi</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane pt-4" id="password_setting" role="tabpanel">
                                <div class="row">

                                    <div class="row">

                                        <div class="col-lg-12 col-xl-12">
                                            <div class="card border mb-0">

                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h4 class="card-title mb-0">Ubah Password</h4>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body mb-0">
                                                    <form id="passwordForm">
                                                        <div class="form-group mb-3">
                                                            <label for="password" class="form-label">Password</label>
                                                            <div class="input-group">
                                                                <input class="form-control" type="password"
                                                                    id="password" name="password"
                                                                    placeholder="Masukan Password">
                                                                <span class="input-group-text cursor-pointer"
                                                                    id="togglePasswordIcon1">
                                                                    <i id="icon-pass1" class="fas fa-eye"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <div class="form-group mb-3">
                                                                <label for="password_confirmation"
                                                                    class="form-label">Konfirmasi
                                                                    Password</label>
                                                                <div class="input-group">
                                                                    <input class="form-control" type="password"
                                                                        id="password_confirmation"
                                                                        name="password_confirmation"
                                                                        placeholder="Konfirmasi Password">
                                                                    <span class="input-group-text cursor-pointer"
                                                                        id="togglePasswordIcon2">
                                                                        <i id="icon-pass2" class="fas fa-eye"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row text-end">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary">Ubah
                                                                    Password</button>
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
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $('#informasiForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData();
            let fotoFile = $('#foto')[0].files[0];
            formData.append('id', $('#id').val());
            formData.append('nama', $('#nama').val());
            formData.append('email', $('#email').val());
            formData.append('notelp', $('#notelp').val());
            formData.append('alamat', $('#alamat').val());
            formData.append('foto', fotoFile ? fotoFile : '');

            $.ajax({
                url: `{{ url('profile/_edit_user') }}`,
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
                            window.location.href = `{{ url('profile') }}`;
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

        $('#passwordForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('id', $('#id').val());
            formData.append('password', $('#password').val());
            formData.append('password_confirmation', $('#password_confirmation').val());

            $.ajax({
                url: `{{ url('profile/_edit_password') }}`,
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
                            window.location.href = `{{ url('profile') }}`;
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

        const imagePreview = document.getElementById('imagePreview');
        const fileInput = document.getElementById('foto');

        imagePreview.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
