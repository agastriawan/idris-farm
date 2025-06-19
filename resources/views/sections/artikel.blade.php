    <!-- Blog section -->
    <section id="artikel" class="blog-section overflow-hidden blog-stylev1 white-bg space-top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-7 col-md-8 col-sm-11">
                    <div class="section-title mb-60 text-center">
                        <h5 class="p1-clr wow fadeInLeft" data-wow-delay="0.4s">ARTIKEL</h5>
                        <h2 class="wow fadeInDown" data-wow-delay=".3s">Menyajikan Pengetahuan Seputar Ternak Berkualitas</h2>
                    </div>
                </div>
            </div>
            <!-- Body -->
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
                <div class="d-flex justify-content-end mt-4 mb-4">
                  <a href="{{ url('artikels') }}"
                                class="btn btn-primary"
                                style="background: linear-gradient(45deg, #204f3e, #b38600); color: #fff; padding: 10px 25px; border-radius: 8px; font-weight: 600;">
                                Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                            </a>
                </div>
            </div>

        </div>
        <!-- Element -->
        <img src="{{ asset('assets/img/element/carrort-elemet-line.png') }}" alt="img" class="carrot-left">
        <img src="{{ asset('assets/img/element/carrot-element-cricle.png') }}" alt="img" class="carrot-right d-md-block d-none">
    </section>
