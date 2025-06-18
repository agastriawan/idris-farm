@extends('layouts.app')

@section('title', 'Galeri - Idris Farm')

@section('content')
    <section class="banner-section style-v1 overflow-hidden custom-hero-style">
        <div class="container ">
            <div class="text-white position-relative py-5 px-2 px-md-5">
                <h2 class="text-white mb-2">Galeri</h2>
                <p class="mb-0">Home &gt; <span class="text-success">Galeri</span></p>
            </div>
        </div>
    </section>


    <section class="gallery-section overflow-hidden section-padding white-bg">
        <div class="container">
            <div class="row g-xl-4 g-3 justify-content-center">
                @foreach ($galleries as $gallery)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="gallery-static-item">
                            <img src="{{ asset('image_gallery/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                class="w-100 mimg">
                            <div class="content">
                                <span>Galeri Peternakan</span>
                                <a href="#" class="title">{{ $gallery->title }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="basic-pagination pt-30 text-center">
                        <nav>
                            <ul class="pagination justify-content-center" style="gap: 10px;">

                                {{-- Tombol Previous --}}
                                @if ($galleries->onFirstPage())
                                    <li><a href="#" class="disabled" aria-disabled="true">«</a></li>
                                @else
                                    <li><a href="{{ $galleries->previousPageUrl() }}">«</a></li>
                                @endif

                                {{-- Nomor Halaman --}}
                                @for ($i = 1; $i <= $galleries->lastPage(); $i++)
                                    <li>
                                        @if ($i == $galleries->currentPage())
                                            <span class="current">{{ $i }}</span>
                                        @else
                                            <a href="{{ $galleries->url($i) }}">{{ $i }}</a>
                                        @endif
                                    </li>
                                @endfor

                                {{-- Tombol Next --}}
                                @if ($galleries->hasMorePages())
                                    <li><a href="{{ $galleries->nextPageUrl() }}">»</a></li>
                                @else
                                    <li><a href="#" class="disabled" aria-disabled="true">»</a></li>
                                @endif

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
