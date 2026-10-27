    <!-- DOWNLOAD APP START  -->
    <section class="fp__download mt_100 xs_mt_70">
        <div class="fp__download_bg" style="background: url({{ asset('frontend') }}/images/download_bg.jpg);">
            <div class="fp__download_overlay">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-5 col-md-6 wow fadeInUp" data-wow-duration="1s">
                            <div class="fp__download_img">
                                <img src="{{ asset('frontend') }}/images/download_img.png" alt="download"
                                    class="img-fluid w-100" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 wow fadeInUp" data-wow-duration="1s">
                            <div class="fp__download_text">
                                <div class="fp__section_heading mb_25">
                                    <h2>download our mobile apps</h2>
                                    <p>
                                        Order your favorite delicious food online anywhere, anytime with our fast and responsive mobile applications.
                                    </p>
                                </div>
                                <ul class="d-flex flex-wrap">
                                    @forelse ($platforms ?? [] as $platform)
                                        <li>
                                            <a href="{{ $platform->url ?? '#' }}" target="_blank">
                                                <i class="{{ $platform->icon }}"></i>
                                                <p>
                                                    <span>{{ $platform->title }}</span>
                                                    {{ $platform->heading }}
                                                </p>
                                            </a>
                                        </li>
                                    @empty
                                        <li>
                                            <a href="https://play.google.com" target="_blank">
                                                <i class="fab fa-google-play"></i>
                                                <p>
                                                    <span>Available on the</span>
                                                    Google Play
                                                </p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://apple.com/app-store" target="_blank">
                                                <i class="fab fa-apple"></i>
                                                <p>
                                                    <span>Download on the</span>
                                                    Apple Store
                                                </p>
                                            </a>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- DOWNLOAD APP END  -->
