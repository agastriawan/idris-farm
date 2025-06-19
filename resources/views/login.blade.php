@extends('layouts.app')

@section('title', 'Login - Idris Farm')

@section('content')

    <section
        class="banner-section style-v1 overflow-hidden py-5 d-flex align-items-center justify-content-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card p-4 p-md-5 shadow-lg border-0 rounded-4 bg-white mt-5">
                        <h3 class="text-center text-dark mb-4">Login</h3>

                        <form action="#" id="loginForm" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control form-control-lg rounded-3"
                                    placeholder="E-mail" required>
                            </div>

                            <div class="mb-4 position-relative">
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-lg rounded-3 pe-5" placeholder="Password" required>

                                <!-- Icon mata -->
                                <i class="fas fa-eye position-absolute"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
                                    onclick="togglePassword('password', this)"></i>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-warning text-white fw-bold rounded-3">
                                    Login
                                </button>
                            </div>

                            <div class="text-center small">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


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

        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            let formData = {
                email: $('#email').val(),
                password: $('#password').val(),
            };

            $.ajax({
                url: `{{ url('auth/_login') }}`,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function() {
                    $("#loading").show();
                    $("#btn-login").hide()
                    $("#submit").prop("disabled", true);
                },
                success: function(response) {
                    $("#loading").hide();
                    $("#submit").prop("disabled", false);
                    $("#btn-login").show();

                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Berhasil',
                            text: response.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-primary',
                            },
                        }).then(() => {
                            window.location.href = `{{ url('dashboard') }}`;
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
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
                    $("#btn-login").show();

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        $.each(errors, function(key, value) {
                            errorMessage += `<p>${value[0]}</p>`;
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
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
