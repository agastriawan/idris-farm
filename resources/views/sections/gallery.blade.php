    <!-- Gallery Section -->>
    <section id="galeri" class="gallery-section p100-bg section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-7 col-md-8 col-sm-11">
                    <div class="section-title mb-60 text-center">
                        <h5 class="p1-clr wow fadeInLeft" data-wow-delay="0.4s">
                            GALERI
                        </h5>
                        <h2 class="wow fadeInDown" data-wow-delay=".3s">
                            Dari peternakan sehat, hadir daging segar dan susu berkualitas untuk Anda
                        </h2>
                    </div>
                </div>
            </div>
            <!-- Body -->
            <div class="row g-lg-4 g-3 justify-content-center">
                @php
                    $first = $galleries[0] ?? null;
                    $second = $galleries[1] ?? null;
                    $third = $galleries[2] ?? null;
                    $fourth = $galleries[3] ?? null;
                    $fifth = $galleries[4] ?? null;
                @endphp

                <div class="col-md-7 col-sm-7">
                    @if ($first)
                        <a href="{{ asset('image_gallery/' . $first->image) }}"
                            class="gallery-com-thumb first-item img-popup w-100 round20">
                            <img src="{{ asset('image_gallery/' . $first->image) }}" alt="img" class="round20">
                        </a>
                    @endif
                </div>

                <div class="col-md-5 col-sm-5">
                    @if ($second)
                        <a href="{{ asset('image_gallery/' . $second->image) }}"
                            class="gallery-com-thumb first-item img-popup w-100 round20">
                            <img src="{{ asset('image_gallery/' . $second->image) }}" alt="img" class="round20">
                        </a>
                    @endif
                </div>

                <div class="d-flex flex-sm-nowrap flex-wrap justify-content-between gap-lg-4 gap-3">
                    @if ($third)
                        <a href="{{ asset('image_gallery/' . $third->image) }}"
                            class="gallery-com-thumb secound img-popup w-100 round20">
                            <img src="{{ asset('image_gallery/' . $third->image) }}" alt="img" class="round20">
                        </a>
                    @endif

                    @if ($fourth)
                        <a href="{{ asset('image_gallery/' . $fourth->image) }}"
                            class="gallery-com-thumb secound img-popup w-100 round20">
                            <img src="{{ asset('image_gallery/' . $fourth->image) }}" alt="img" class="round20">
                        </a>
                    @endif

                    <div class="d-grid gap-lg-4 gap-3">
                        @if ($fifth)
                            <a href="{{ asset('image_gallery/' . $fifth->image) }}"
                                class="gallery-com-thumb thard img-popup w-100 round20">
                                <img src="{{ asset('image_gallery/' . $fifth->image) }}" alt="img" class="round20">
                            </a>
                        @endif

                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ url('galeri') }}" class="cmn-btn round100 wow fadeInUp" data-wow-delay="0.9s">
                        Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
