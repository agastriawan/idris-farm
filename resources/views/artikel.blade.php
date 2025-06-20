@extends('layouts.app')

@section('title', 'Artikel - Idris Farm')

@section('content')
    <section class="banner-section style-v1 overflow-hidden custom-hero-style">
        <div class="container ">
            <div class="text-white position-relative py-5 px-2 px-md-5">
                <h2 class="text-white mb-2">Artikel</h2>
                <p class="mb-0">Home &gt; <span class="text-success">Artikel</span></p>
            </div>
        </div>
    </section>


    <section class="product-list-section overflow-hidden section-padding white-bg">
        <div class="container">
            <div class="row g-xl-4 g-3 justify-content-center">
                @foreach ($artikels as $artikel)
                    <div class="col-lg-4 col-md-6 col-sm-11 wow fadeInUp" data-wow-delay=".{{ 3 + $loop->index * 2 }}s">
                        <div class="blog-itemsv1">
                            <div class="thumb w-100">
                                <img src="{{ asset('image_artikel/' . $artikel->image) }}" alt="{{ $artikel->judul }}"
                                    class="w-100">
                                <div class="dates">{{ \Carbon\Carbon::parse($artikel->created_at)->format('d M') }}
                                </div>
                            </div>
                            <div class="content">
                                <ul class="comment-inner">
                                    <li class="text-success "><i class="text-success fa-regular fa-user"></i>
                                        {{ $artikel->user->nama ?? 'Admin' }}</li>
                                    <span class="badge bg-success me-1"><i class="fa-regular fa-tags me-1"></i>
                                        {{ $artikel->tags ?? '-' }}</span>
                                </ul>
                                <a href="{{ url('artikel-detail/' . $artikel->slug) }}"
                                    class="title">{{ $artikel->judul }}</a>
                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($artikel->isi), 90) }}</p>
                                <a href="{{ url('artikel-detail/' . $artikel->slug) }}" class="arrows">
                                    Detail Artikel <i class="fa-solid fa-arrow-right"></i>
                                </a>
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
                                @if ($artikels->onFirstPage())
                                    <li>
                                        <a href="#" class="disabled" aria-disabled="true">
                                            << </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $artikels->previousPageUrl() }}">
                                            << </a>
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
                                        <a href="{{ $artikels->nextPageUrl() }}">
                                            >>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="#" class="disabled" aria-disabled="true">
                                            >>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
