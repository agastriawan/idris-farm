@extends('layouts.app')

@section('title', 'Katalog - Idris Farm')

@section('content')
    <section class="banner-section style-v1 overflow-hidden custom-hero-style">
        <div class="container ">
            <div class="text-white position-relative py-5 px-2 px-md-5">
                <h2 class="text-white mb-2">Katalog</h2>
                <p class="mb-0">Home &gt; <span class="text-success">Katalog</span></p>
            </div>
        </div>
    </section>


    <section class="product-list-section overflow-hidden section-padding white-bg">
            <div class="container">
                <div class="row g-xl-4 g-3 justify-content-center">
                    <div class="col-lg-12">
                    <div class="filter-mixtup">
                        <div class="mixtup-filtering d-flex justify-content-center mb-60">
                            <div class="filter-btns">
                                <button type="button" data-filter="all">
                                    All
                                </button>
                                <button type="button" data-filter=".category-a">
                                    Sapi
                                </button>
                                <button type="button" data-filter=".category-b">
                                    Kambing
                                </button>
                                <button type="button" data-filter=".category-c">
                                    Domba
                                </button>
                            </div>
                        </div>
                        <div class="row all-catagorys">
                            @foreach ($animals as $animal)
                                @php
                                    $category = '';
                                    switch (strtolower($animal->type)) {
                                        case 'sapi':
                                            $category = 'category-a';
                                            break;
                                        case 'kambing':
                                            $category = 'category-b';
                                            break;
                                        case 'domba':
                                            $category = 'category-c';
                                            break;
                                    }
                                @endphp

                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 mix {{ $category }}" data-order="{{ $loop->iteration }}">
                                    <div class="h-100 border rounded shadow-sm d-flex flex-column">
                                        <img src="{{ asset('image_animal/' . $animal->image) }}" alt="{{ $animal->name }}"
                                            class="w-100 rounded-top" style="height: 200px; object-fit: cover;">
                                        
                                        <div class="p-3 d-flex flex-column justify-content-between flex-grow-1">
                                            <div>
                                                <a href="{{ url('katalog-detail/' . $animal->id) }}"
                                                class="fw-bold text-dark d-block mb-2" style="font-size: 1.1rem;">
                                                    {{ $animal->name }}
                                                </a>
                                                <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                                    {{ Str::limit($animal->description, 60) }}
                                                </p>
                                            </div>
                                            
                                            <div class="mt-auto">
                                                <h5 class="text-success fw-semibold mb-2">
                                                    Rp{{ number_format($animal->price, 0, ',', '.') }}
                                                </h5>
                                                <a href="{{ url('katalog-detail/' . $animal->id) }}"
                                                class="btn btn-outline-success btn-sm w-100">
                                                    Lihat Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="basic-pagination pt-30 text-center">
                        <nav>
                            <ul class="pagination justify-content-center" style="gap: 10px;">

                                {{-- Tombol Previous --}}
                                @if ($animals->onFirstPage())
                                    <li>
                                        <a href="#" class="disabled" aria-disabled="true">
                                            << </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $animals->previousPageUrl() }}">
                                            << </a>
                                    </li>
                                @endif

                                {{-- Nomor Halaman --}}
                                @for ($i = 1; $i <= $animals->lastPage(); $i++)
                                    <li>
                                        @if ($i == $animals->currentPage())
                                            <span class="current">{{ $i }}</span>
                                        @else
                                            <a href="{{ $animals->url($i) }}">{{ $i }}</a>
                                        @endif
                                    </li>
                                @endfor

                                {{-- Tombol Next --}}
                                @if ($animals->hasMorePages())
                                    <li>
                                        <a href="{{ $animals->nextPageUrl() }}">
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
