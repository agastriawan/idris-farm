@extends('admin.layouts.app')

@section('template_styles_admin')
    <!-- Tagify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.9/tagify.css"
        integrity="sha512-ow+Nd7zEYyHRdsyHsJPcRMAMakb1Efry0Nij9UQ+aKMCJr5zRuzCeWkVDfIpHV1XztmeLnviHCqVPYkRufF47g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Tambah</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item active">Tambah Animal</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Data Animal</h5>
                    </div>

                    <div class="card-body">
                        <form id="animalForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="mb-3 col-md-6 col-lg-6">
                                    <label for="name" class="form-label">Nama Hewan</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Contoh: Kambing Etawa">
                                </div>

                                <div class="mb-3 col-md-6 col-lg-6">
                                    <label for="type" class="form-label">Jenis Hewan</label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="">-- Pilih Jenis Hewan --</option>
                                        <option value="Kambing">Kambing</option>
                                        <option value="Sapi">Sapi</option>
                                        <option value="Domba">Domba</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6 col-lg-6">
                                    <label for="price_display" class="form-label">Harga</label>
                                    <input type="text" id="price_display" class="form-control" placeholder="Contoh: Rp2.500.000">
                                    <input type="hidden" id="price" name="price">
                                </div>


                                <div class="mb-3 col-md-6 col-lg-6">
                                    <label for="image" class="form-label">Gambar Hewan</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>

                                <div class="mb-3 col-md-12 col-lg-12">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="text-end">
                                <a href="{{ url('/animal') }}">
                                    <button class="btn btn-info" type="button">Kembali</button>
                                </a>
                                <button type="submit" class="btn btn-primary btn-submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

    <script>
        $(document).ready(function() {
            $('#animalForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData();
                formData.append('name', $('#name').val());
                formData.append('type', $('#type').val());
                formData.append('price', $('#price').val());
                formData.append('description', $('#description').val());
                formData.append('image', $('#image')[0].files[0]);

                $.ajax({
                    url: `{{ url('animal/_tambah_animal') }}`,
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
                                window.location.href = `{{ url('animal') }}`;
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

        });

        flatpickr("#tanggal_lahir", {
            dateFormat: "d-m-Y",
        });

        document.getElementById('price_display').addEventListener('input', function (e) {
        let value = this.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        this.value = 'Rp' + rupiah;

        // Simpan nilai asli ke input hidden
        document.getElementById('price').value = value;
    });
    </script>
@endpush
