    <!-- ADD SLIDER START  -->
    @if(isset($advertisements) && $advertisements->count() > 0)
    <section class="fp__add_slider mt_100 xs_mt_70 pt_100 xs_pt_70 pb_100 xs_pb_70">
        <div class="container">
            <div class="row add_slider wow fadeInUp" data-wow-duration="1s">
                @foreach ($advertisements as $ads)
                    <div class="col-xl-4">
                        <a href="{{ $ads->url && $ads->url != '#' ? $ads->url : 'javascript:;' }}" class="fp__add_slider_single" style="background: url({{ asset($ads->image) }});">
                            <div class="text">
                                <h3>{{ $ads->title }}</h3>
                                <p>{!! $ads->details !!}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- ADD SLIDER END  -->
