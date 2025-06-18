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
                <div class="all-catagorys">
                    @foreach ($animals as $animal)
                        @php
                            $categoryClass = '';
                            switch (strtolower($animal->type)) {
                                case 'sapi':
                                    $categoryClass = 'category-a';
                                    break;
                                case 'kambing':
                                    $categoryClass = 'category-b';
                                    break;
                                case 'domba':
                                    $categoryClass = 'category-c';
                                    break;
                            }
                        @endphp

                        <div class="mix {{ $categoryClass }}" data-order="{{ $loop->iteration }}">
                            <div class="feature-itemsv1">
                                <img src="{{ asset('image_animal/' . $animal->image) }}" alt="{{ $animal->name }}"
                                    class="f-thumb">
                                <div class="content">
                                    <a href="{{ url('katalog-detail/' . $animal->id) }}"
                                        class="title">{{ $animal->name }}</a>
                                    <p>{{ Str::limit($animal->description, 60) }}</p>
                                    <h5>Rp{{ number_format($animal->price, 0, ',', '.') }}</h5>
                                    <a href="{{ url('katalog-detail/' . $animal->id) }}" class="add-tocart">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ url('katalogs') }}" class="cmn-btn round100 wow fadeInUp" data-wow-delay="0.9s">
                        Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
