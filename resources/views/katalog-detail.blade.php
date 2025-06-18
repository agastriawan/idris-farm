@extends('layouts.app')

@section('title', 'Katalog Detail - Idris Farm')

@section('content')
    <section class="banner-section style-v1 overflow-hidden custom-hero-style">
        <div class="container ">
            <div class="text-white position-relative py-5 px-2 px-md-5">
                <h2 class="text-white mb-2">Katalog Detail</h2>
                <p class="mb-0">Home &gt; <span class="text-success">Katalog Detail</span></p>
            </div>
        </div>
    </section>

    <section class="product-details-section overflow-hidden section-padding white-bg">
        <div class="container">
            <div class="row g-xl-4 g-3 justify-content-center">
                <div class="col-lg-9 col-md-7">
                    <div class="row g-4 mb-60">
                        <div class="col-xl-5 col-lg-6">
                            <div class="shop-details-wrap">
                                <div class="shop-details-bigthumb">
                                    <img src="{{ asset('image_animal/' . $animal->image) }}" alt="{{ $animal->name }}"
                                        class="w-100">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-7 col-lg-6">
                            <div class="product-infowrap">
                                <h3 class="title">
                                    {{ $animal->name }}
                                </h3>
                                <p>
                                    <span class="badge bg-success text-white" style="font-size: 14px;">
                                        {{ ucfirst($animal->type) }}
                                    </span>
                                </p>

                                <div class="ratting">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <h3 class="prices">
                                    Rp{{ number_format($animal->price, 0, ',', '.') }}
                                </h3>
                                <span class="d-block">
                                    {{ $animal->description }}
                                </span>
                                <span class="d-block">Ketersediaan: Tersedia</span>

                                @php
                                    $whatsappNumber = '6288295747113'; // no WhatsApp kamu
                                    $message =
                                        "Halo Admin, saya ingin menanyakan ketersediaan produk berikut:\n\n" .
                                        "Nama Hewan: {$animal->name}\n" .
                                        "Jenis: {$animal->type}\n" .
                                        'Harga: Rp' .
                                        number_format($animal->price, 0, ',', '.') .
                                        "\n" .
                                        'Deskripsi: ' .
                                        Str::limit($animal->description, 150) .
                                        "\n\n" .
                                        'Mohon informasinya lebih lanjut. Terima kasih.';

                                    $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($message);
                                @endphp

                                <a href="{{ $whatsappUrl }}" class="cmn-btn d-inline-flex mt-3">
                                    Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
