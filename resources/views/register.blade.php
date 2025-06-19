@extends('layouts.app')

@section('title', 'Registrasi - Idris Farm')

@push('styles')
@endpush

@section('content')

    <!-- Register Section Start -->
    <section class="tp-register-area pt-90 pb-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="tp-contact-from-wrap wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                        <form action="#" id="registerForm" method="POST">
                            <div class="tp-contact-from">
                                <h3 class="text-center mb-40">Daftar Akun Baru</h3>
                                <div class="row gx-20">
                                    <div class="col-xl-6">
                                        <div class="tp-contact-input mb-20">
                                            <input class="tp-input" type="text" name="nama" id="nama"
                                                placeholder="Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="tp-contact-input mb-20">
                                            <input class="tp-input" type="email" name="email" id="email"
                                                placeholder="Alamat Email" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="tp-contact-input mb-20">
                                            <input class="tp-input" type="text" name="notelp" id="notelp"
                                                placeholder="Nomor Telepon" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="tp-contact-input mb-20">
                                            <input class="tp-input" type="text" name="alamat" id="alamat"
                                                placeholder="Alamat" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="tp-contact-input mb-20 position-relative">
                                            <input class="tp-input" type="password" id="password" name="password"
                                                placeholder="Kata Sandi" required>
                                            <i class="fas fa-eye position-absolute"
                                                style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
                                                onclick="togglePassword('password', this)"></i>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="tp-contact-input mb-20 position-relative">
                                            <input class="tp-input" type="password" id="password_confirmation"
                                                name="password_confirmation" placeholder="Ulangi Kata Sandi" required>
                                            <i class="fas fa-eye position-absolute"
                                                style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
                                                onclick="togglePassword('password_confirmation', this)"></i>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="tp-contact-btn">
                                            <button type="submit" class="tp-btn-gradient tp-gradient-bg w-100">
                                                <div id="loader" class="loader" style="display:none;"></div> Daftar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <p class="mb-0">Sudah punya akun? <a href="{{ url('auth/login') }}"
                                            class="text-primary fw-semibold">Masuk</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Register Section End -->
@endsection

@push('scripts')
    <script>
        function togglePassword(id, icon) {
            const input = document.getElementById(id);
            const isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }

        $('#registerForm').on('submit', function(e) {
            e.preventDefault();

            let formData = {
                nama: $('#nama').val(),
                notelp: $('#notelp').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                alamat: $('#alamat').val(),
                password_confirmation: $('#password_confirmation').val(),
            };

            $.ajax({
                url: `{{ url('auth/_register') }}`,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function() {
                    $("#loading").show();
                    $("#btn-daftar").hide()
                    $("#submit").prop("disabled", true);
                },
                success: function(response) {
                    $("#loading").hide();
                    $("#submit").prop("disabled", false);
                    $("#btn-daftar").show();

                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registrasi Berhasil',
                            text: response.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-primary',
                            },
                        }).then(() => {
                            window.location.href = `{{ url('auth/login') }}`;
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Registrasi Gagal',
                            text: response.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-danger',
                            },
                        })
                    }
                },
                error: function(xhr) {
                    $("#loading").hide();
                    $("#submit").prop("disabled", false);
                    $("#btn-daftar").show();

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        $.each(errors, function(key, value) {
                            errorMessage += `<p>${value[0]}</p>`;
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Registrasi Gagal',
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
    </script>
@endpush
