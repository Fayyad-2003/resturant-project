@if(isset($counters) && $counters->count() > 0)
<section class="fp__counter" style="background: url({{ asset('frontend/images/counter_bg2.jpg') }});">
    <div class="fp__counter_overlay pt_100 xs_pt_70 pb_100 xs_pb_70">
        <div class="container">
            <div class="row">
                @foreach ($counters as $counter)
                    <div class="col-xl-3 col-sm-6 col-lg-3 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__single_counter">
                            <i class="{{ $counter->icon }}"></i>
                            <div class="text">
                                <h2 class="counter">{{ $counter->number }}</h2>
                                <p>{{ $counter->title }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
