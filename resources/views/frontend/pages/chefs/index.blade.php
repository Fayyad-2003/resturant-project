@extends('frontend.layouts.master')

@section('title', 'Meet Our Expert Chefs')

@section('content')
    <!-- BREADCRUMB START -->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend') }}/images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Meet Our Expert Chefs</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="javascript:;">Chefs</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->

    <!-- TEAM PAGE START -->
    <section class="fp__team_page pt_95 xs_pt_65 pb_100 xs_pb_70">
        <div class="container">
            <div class="row">
                @forelse ($chefs as $chef)
                    <div class="col-xl-3 col-sm-6 col-lg-4 wow fadeInUp mb-4" data-wow-duration="1s">
                        <div class="fp__single_team">
                            <div class="fp__single_team_img">
                                <img src="{{ asset($chef->image) }}" alt="{{ $chef->name }}" class="img-fluid w-100" style="height: 320px; object-fit: cover;">
                            </div>
                            <div class="fp__single_team_text">
                                <h4>{{ $chef->name }}</h4>
                                <p>{{ $chef->designation }}</p>
                                <ul class="d-flex flex-wrap justify-content-center">
                                    @if ($chef->facebook)
                                        <li><a href="{{ $chef->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif
                                    @if ($chef->instagram)
                                        <li><a href="{{ $chef->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if ($chef->twitter)
                                        <li><a href="{{ $chef->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    @endif
                                    @if ($chef->behance)
                                        <li><a href="{{ $chef->behance }}" target="_blank"><i class="fab fa-behance"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="card p-5 border-0 shadow-sm">
                            <i class="fas fa-user-friends fa-4x text-muted mb-3"></i>
                            <h4 class="text-secondary">No chefs found</h4>
                            <p class="text-muted">Our culinary team will be introduced shortly. Stay tuned!</p>
                            <div class="mt-3">
                                <a href="{{ route('home') }}" class="btn btn-warning text-white">Back to Home</a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($chefs->hasPages())
                <div class="fp__pagination mt_50">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $chefs->links('vendor.pagination.food-park-pagination') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- TEAM PAGE END -->
@endsection

