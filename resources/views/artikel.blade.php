@extends('layouts.app')

@section('title', 'Artikel - Idris Farm')

@section('content')
    <!-- tp breadcrumb area start -->
    <section class="tp-breadcrumb-2-ptb pt-250 pb-150 p-relative" data-background="{{ asset('assets/img/artikel.jpg') }}">
        <div class="tp-breadcrumb-4-bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-breadcrumb-2-content text-center p-relative">
                        <h4 class="tp-breadcrumb-title">Artikel & Wawasan <br>
                            untuk UMKM</h4>
                        <div class="tp-breadcrumb-list">
                            <span><a href="index.html">Beranda</a></span>
                            <span class="dvdr"></span>
                            <span>Artikel</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- tp breadcrumb area end -->

    <!-- blog area start -->
    <div class="tp-blog-2-area tp-blog-2-ptb pt-120 pb-90">
        <div class="container">
            <div class="row">
                @if (!empty($artikels))
                    @foreach ($artikels as $artikel)
                        <div class="col-lg-4 col-md-6">
                            <div class="tp-blog-2-item tp-blog mb-30 wow tpfadeUp" data-wow-duration=".9s"
                                data-wow-delay=".3s">
                                <div class="tp-blog-2-thumb mb-25 fix">
                                    <a href="{{ url('artikel-detail') }}/{{ $artikel->slug }}"><img src="{{ asset('image_artikel/' . $artikel->image) }}" alt=""style="width: 329px; height: 220px; object-fit: cover;" class="mx-auto"></a>
                                </div>
                                <div class="tp-blog-2-category">
                                    <a href="#">{{ $artikel->tags }}</a>
                                </div>
                                <div class="tp-blog-2-content">
                                    <h4 class="tp-blog-2-title"><a
                                            href="{{ url('artikel-detail') }}/{{ $artikel->slug }}">{{ $artikel->judul }}</a>
                                    </h4>
                                </div>
                                <div class="tp-blog-2-author-box d-flex align-items-center justify-content-between">
                                    <div class="tp-blog-2-author d-flex align-items-center">
                                        <div class="tp-blog-2-author-info">
                                            <h4><i>By</i> {{ $artikel->user->nama }}</h4>
                                        </div>
                                    </div>
                                    <div class="tp-blog-2-author-view d-flex align-items-center">
                                        <span><i class="fa-light fa-clock"></i>
                                            {{ $artikel->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="basic-pagination pt-30 text-center">
                        <nav>
                            <ul class="pagination justify-content-center" style="gap: 10px;">

                                {{-- Tombol Previous --}}
                                @if ($artikels->onFirstPage())
                                    <li>
                                        <a href="#" class="disabled" aria-disabled="true">
                                            <svg width="15" height="13" viewBox="0 0 15 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.00017 6.77879L14 6.77879" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M6.24316 11.9999L0.999899 6.77922L6.24316 1.55762"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $artikels->previousPageUrl() }}">
                                            <svg width="15" height="13" viewBox="0 0 15 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.00017 6.77879L14 6.77879" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M6.24316 11.9999L0.999899 6.77922L6.24316 1.55762"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif

                                {{-- Nomor Halaman --}}
                                @for ($i = 1; $i <= $artikels->lastPage(); $i++)
                                    <li>
                                        @if ($i == $artikels->currentPage())
                                            <span class="current">{{ $i }}</span>
                                        @else
                                            <a href="{{ $artikels->url($i) }}">{{ $i }}</a>
                                        @endif
                                    </li>
                                @endfor

                                {{-- Tombol Next --}}
                                @if ($artikels->hasMorePages())
                                    <li>
                                        <a href="{{ $artikels->nextPageUrl() }}" class="next page-numbers">
                                            <svg width="15" height="13" viewBox="0 0 15 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.9998 6.77883L1 6.77883" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8.75684 1.55767L14.0001 6.7784L8.75684 12" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="#" class="disabled" aria-disabled="true">
                                            <svg width="15" height="13" viewBox="0 0 15 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.9998 6.77883L1 6.77883" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8.75684 1.55767L14.0001 6.7784L8.75684 12" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- blog area end -->

@endsection
