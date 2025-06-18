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
                <h4 class="fs-18 fw-semibold m-0">Ubah</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item active">Ubah Gallery</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Data Gallery</h5>
                    </div>

                    <div class="card-body">
                        <form id="galleryForm" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id" value="{{ $gallery->id }}">

                            <div class="row">
                                <div class="mb-3 col-md-12 col-lg-12">
                                    <label for="title" class="form-label">Judul Gambar</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                        value="{{ old('title', $gallery->title) }}"
                                        placeholder="Contoh: Kandang Bersih dan Sehat">
                                </div>

                                <div class="mb-3 col-md-12 col-lg-12">
                                    <label for="image" class="form-label">Gambar</label>
                                    <div class="input-group">
                                        <input type="file" id="image" name="image" class="form-control">
                                        <button type="button" class="btn btn-info" id="preview-btn">Preview</button>
                                    </div>
                                    @if ($gallery->image_path)
                                        <img src="{{ asset('image_gallery/' . $gallery->image_path) }}" alt="Preview"
                                            width="150" class="mt-2">
                                    @endif
                                </div>

                                <div class="mb-3 col-md-12 col-lg-12">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $gallery->description) }}</textarea>
                                </div>
                            </div>

                            <div class="text-end">
                                <a href="{{ url('/gallery') }}">
                                    <button class="btn btn-info" type="button">Kembali</button>
                                </a>
                                <button type="submit" class="btn btn-primary btn-submit">Update</button>
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
                    <h5 class="modal-title" id="previewModalLabel">Image Gallery</h5>
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
        $(document).ready(function() {

            $('#galleryForm').on('submit', function(e) {
                e.preventDefault();
                
                let formData = new FormData();
                formData.append('id', $('#id').val());
                formData.append('title', $('#title').val());
                formData.append('description', $('#description').val());

                const imageFile = $('#image')[0].files[0];
                if (imageFile) {
                    formData.append('image', imageFile);
                }


                $.ajax({
                    url: `{{ url('gallery/_edit_gallery') }}`,
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
                                window.location.href = `{{ url('gallery') }}`;
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

            $('#preview-btn').click(function() {
                var file = "{{ $gallery->image }}";
                var path = "{{ asset('image_gallery/') }}/";

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
        });

        flatpickr("#tanggal_lahir", {
            dateFormat: "d-m-Y",
        });
    </script>
@endpush
