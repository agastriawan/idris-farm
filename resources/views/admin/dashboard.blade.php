@extends('admin.layouts.app')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">
                    Keterangan Konten
                </h4>
            </div>
        </div>

        <div class="row">
                <div class="col-md-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-secondary-subtle rounded-2 p-1 me-2 border border-dashed border-secondary">
                                    <i data-feather="book" style="color: #824563"></i>
                                </div>
                                <p class="mb-0 text-dark fs-15">Total Artikel</p>
                            </div>
                            <h3 class="mb-0 fs-24 text-black me-2">
                                {{ $totalArtikel }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-warning-subtle rounded-2 p-1 me-2 border border-dashed border-warning">
                                    <i data-feather="shopping-cart" style="color: #f59440"></i>
                                </div>
                                <p class="mb-0 text-dark fs-15">Total Hewan</p>
                            </div>
                            <h3 class="mb-0 fs-24 text-black me-2">
                                {{ $totalAnimal }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-info-subtle rounded-2 p-1 me-2 border border-dashed border-info">
                                    <i data-feather="slack" style="color: #288071"></i>
                                </div>
                                <p class="mb-0 text-dark fs-15">Total Galeri</p>
                            </div>
                            <h3 class="mb-0 fs-24 text-black me-2"> {{ $totalGallery }}
                            </h3>
                        </div>
                    </div>
                </div>
        </div>

    </div>
@endsection

@push('scripts')
@endpush
