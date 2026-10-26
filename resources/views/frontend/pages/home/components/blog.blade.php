    <!-- BLOG 2 START  -->
    @if(isset($latestBlogs) && $latestBlogs->count() > 0)
    <section class="fp__blog fp__blog2">
        <div class="fp__blog_overlay pt_95 pt_xs_60 pb_100 xs_pb_70">
            <div class="container">
                <div class="row wow fadeInUp" data-wow-duration="1s">
                    <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                        <div class="fp__section_heading mb_25">
                            <h4>news & blogs</h4>
                            <h2>our latest foods blog</h2>
                            <span>
                                <img src="{{ asset('frontend') }}/images/heading_shapes.png" alt="shapes"
                                    class="img-fluid w-100">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($latestBlogs as $blog)
                        <div class="col-xl-4 col-sm-6 col-lg-4 wow fadeInUp mb-4" data-wow-duration="1s">
                            <x-frontend.blog-card :blog="$blog" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- BLOG 2 END  -->
