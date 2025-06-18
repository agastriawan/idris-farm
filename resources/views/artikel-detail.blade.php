@extends('layouts.app')

@section('title', 'Artikel Detail - UMKash')

@section('content')

    <!-- tp breadcrumb area start -->
    <section class="tp-breadcrumb-area tp-breadcrumb-5-ptb p-relative"
        data-background="{{ asset('assets/img/blog/blog-details/blog-details-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-breadcrumb-2-content p-relative">
                        <h4 class="tp-breadcrumb-title">{{ $artikels->judul }}</h4>
                        <div class="tp-breadcrumb-list">
                            <span><a href="{{ url('/') }}">Home</a></span>
                            <span class="dvdr"></span>
                            <span>Artikel</span>
                            <span class="dvdr"></span>
                            <span>{{ $artikels->tags }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- tp breadcrumb area end -->

    <!-- tp breadcrumb banner area start -->
    <div class="tp-breadcrumb-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="tp-breadcrumb-banner">
                        <div class="tp-breadcrumb-banner-img">
                            <img src="{{ asset('image_artikel/' . $artikels->image) }}" alt="" style="width: 1110px; height: 740px; object-fit: cover;" class="mx-auto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-xl-9 col-lg-9 col-md-7">
                    <div class="blog-details-banner">
                        <div class="blog-details-author-box d-flex align-items-center">
                            <div class="blog-details-author-info">
                                <h5>{{ $artikels->user->nama }}</h5>
                                <span>{{ $artikels->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-5">
                    <div class="blog-details-social-box z-index-3 text-md-end text-start">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-vimeo-v"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tp breadcrumb banner area end -->

    <!-- postbox area start -->
    <section class="postbox-area pt-80 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="postbox-details-wrapper">
                        <div class="postbox-details-content mb-25">
                            <h4 class="postbox-title">{{ $artikels->judul }}</h4>
                            <p style="text-align: justify;">{!! $artikels->isi !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <div class="sidebar-wrapper">
                        <div class="sidebar-widget sidebar-border-bottom pb-35 mb-40">
                            <h3 class="sidebar-widget-title">Artikel Terbaru</h3>
                            <div class="sidebar-widget-content">
                                <div class="sidebar-post">
                                    @if (!empty($recentPosts))
                                        @foreach ($recentPosts as $artikel)
                                            <div class="rc-post d-flex align-items-center">
                                                <div class="rc-post-thumb">
                                                    <a href="{{ url('artikel-detail') }}/{{ $artikel->slug }}"><img src="{{ asset('image_artikel/' . $artikel->image) }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="rc-post-content">
                                                    <h3 class="rc-post-title">
                                                        <a href="{{ url('artikel-detail') }}/{{ $artikel->slug }}">{{ \Illuminate\Support\Str::limit($artikel->judul, 45) }}</a>
                                                    </h3>
                                                    <div class="rc-meta">
                                                        <span>{{ $artikel->created_at->format('d M Y') }}</span>
                                                        <span>Minute</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- postbox area end -->

@endsection
