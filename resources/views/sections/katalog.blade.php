    <!-- Service section -->
    <section id="katalog" class="service-feature-section white-bg space-top mt-3">
        <div class="filter-mixtup">
            <div class="container">
                <div class="row g-4 justify-content-between align-items-end mb-60">
                    <div class="col-xxl-5 col-xl-7">
                        <div class="section-title">
                            <h5 class="p1-clr wow fadeInLeft" data-wow-delay="0.4s">
                                KATALOG
                            </h5>
                            <h2 class="wow fadeInDown" data-wow-delay=".3s">
                                Menjelajahi Keberagaman Ternak Unggulan Kami
                            </h2>
                        </div>
                    </div>
                    <div class="col-xxl-5 col-xl-5">
                        <div class="mixtup-filtering d-flex justify-content-end">
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

                       <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4 mix {{ $category }}" data-order="{{ $loop->iteration }}">
                            <div class="card h-100 shadow-sm border-0">
                                <img src="{{ asset('image_animal/' . $animal->image) }}" alt="{{ $animal->name }}"
                                    class="card-img-top" style="height: 200px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title fw-bold text-success">{{ $animal->name }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($animal->description, 60) }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-success mb-2">Rp{{ number_format($animal->price, 0, ',', '.') }}</h6>
                                        <a href="{{ url('katalog-detail/' . $animal->id) }}" class="btn btn-outline-success btn-sm w-100">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ url('katalogs') }}" class="btn btn-primary"
                        style="background: linear-gradient(45deg, #204f3e, #b38600); color: #fff; padding: 10px 25px; border-radius: 8px; font-weight: 600;">
                        Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
