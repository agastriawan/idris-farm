@extends('admin.layouts.app')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Animal</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item active">Daftar Animal</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Daftar Animal</h5>
                        <div class="button">
                            <a href="{{ url('animal/tambah_animal') }}"><button type="submit"
                                    class="btn btn-primary">Tambah</button></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="animalTable" class="table table-bordered table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Hewan</th>
                                    <th>Jenis Hewan</th>
                                    <th>Harga Hewan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#animalTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "{{ url('animal/_list_animal') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                },
                columns: [{
                        data: null,
                        className: 'text-center',
                        orderable: true,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama',
                    },
                    {
                        data: 'jenis',
                    },
                    {
                        data: 'harga',
                    },
                    {
                        data: "id",
                        className: "text-center",
                        orderable: false,
                        render: function(data, type, row, meta) {
                            var deleteLink =
                                `<a href="#" class="ms-2 btn btn-danger btn-sm delete-btn" data-id="${data}"><i class="fas fa-trash"></i></a>`;
                            var editLink =
                                `<a href="{{ url('animal/edit_animal') }}/${data}" class="ms-2 btn btn-primary btn-sm edit-btn"><i class="far fa-edit"></i></a>`;
                            return editLink + ' ' + deleteLink;
                        }
                    }
                ]
            });
        });

        $('#animalTable').on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var Id = $(this).data('id');
            Swal.fire({
                title: 'Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-info'
                },
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('animal/_delete_animal/') }}/${Id}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil dihapus.',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                },
                            });
                            $('#animalTable').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Data gagal dihapus',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                },
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
