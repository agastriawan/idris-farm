@extends('layouts.app')

@section('title', 'Artikel Detail - Idris Farm')

@section('content')
    <section class="banner-section style-v1 overflow-hidden custom-hero-style">
        <div class="container ">
            <div class="text-white position-relative py-5 px-2 px-md-5">
                <h2 class="text-white mb-2">Artikel Detail</h2>
                <p class="mb-0">Home &gt; <span class="text-success">Artikel Detail</span></p>
            </div>
        </div>
    </section>

    <section class="blog-section overflow-hidden section-padding white-bg">
        <div class="container">
            <div class="row g-xl-4 g-4 justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-post-details">
                        <div class="explore-details-content">
                            <h2 class="wow fadeInUp" data-wow-delay=".2s">
                                {{ $artikels->judul }}
                            </h2>

                            <ul class="comment-inner wow fadeInUp" data-wow-delay=".3s">
                                <li>
                                    <a href="#"><i class="fa-regular fa-user"></i> By
                                        {{ $artikels->user->nama ?? 'Admin' }}</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-tags"></i> {{ $artikels->tags ?? '-' }}</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-calendar-days"></i>
                                        {{ \Carbon\Carbon::parse($artikels->created_at)->format('F d, Y') }}
                                    </a>
                                </li>
                            </ul>
                            
                            <div class="thumb w-100 mb-40 wow fadeInUp" data-wow-delay=".4s">
                                <img src="{{ asset('image_artikel/' . $artikels->image) }}" alt="{{ $artikels->judul }}"
                                    class="w-100"
                                    style="width: 850px; height: 361px; object-fit: cover; border-radius: 8px;">
                            </div>

                            <p class="fist-pra wow fadeInUp" data-wow-delay=".4s">
                                {!! $artikels->isi !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
