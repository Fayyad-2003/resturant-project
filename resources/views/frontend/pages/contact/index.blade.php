@extends('frontend.layouts.master')

@section('title', 'Contact Us - ' . config('app.name', 'FoodPark'))

@section('content')
    <!-- BREADCRUMB START -->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Contact With Us</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->

    <!-- CONTACT PAGE START -->
    <section class="fp__contact mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <!-- Contact Info Cards -->
            <div class="row">
                @forelse ($contactInfos as $info)
                    <div class="col-xl-4 col-md-6 col-lg-4 mb-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__contact_info">
                            <span><i class="{{ $info->icon }}"></i></span>
                            <div class="text">
                                <h3>{{ $info->title }}</h3>
                                @if ($info->info_1)
                                    <p>{{ $info->info_1 }}</p>
                                @endif
                                @if ($info->info_2)
                                    <p>{{ $info->info_2 }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-xl-4 col-md-6 col-lg-4 mb-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__contact_info">
                            <span><i class="fal fa-phone-alt"></i></span>
                            <div class="text">
                                <h3>Call Us</h3>
                                <p>+123 456 7890</p>
                                <p>+123 456 7899</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 mb-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__contact_info">
                            <span><i class="fal fa-envelope"></i></span>
                            <div class="text">
                                <h3>Email Us</h3>
                                <p>support@foodpark.com</p>
                                <p>info@foodpark.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 mb-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__contact_info">
                            <span><i class="fal fa-map-marker-alt"></i></span>
                            <div class="text">
                                <h3>Location</h3>
                                <p>7232 Broadway Suite 308,</p>
                                <p>Jackson Heights, NY 11372</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Contact Form Area -->
            <div class="fp__contact_form_area mt_75 xs_mt_45">
                <div class="row">
                    <div class="col-xl-12 wow fadeInUp" data-wow-duration="1s">
                        <form id="contactForm" class="fp__contact_form">
                            @csrf
                            <h3>Get In Touch</h3>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fp__contact_form_input">
                                        <span><i class="fal fa-user"></i></span>
                                        <input type="text" name="name" placeholder="Your Name" value="{{ auth()->user()->name ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fp__contact_form_input">
                                        <span><i class="fal fa-envelope"></i></span>
                                        <input type="email" name="email" placeholder="Your Email" value="{{ auth()->user()->email ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fp__contact_form_input">
                                        <span><i class="fal fa-phone-alt"></i></span>
                                        <input type="text" name="phone" placeholder="Your Phone Number (Optional)">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fp__contact_form_input">
                                        <span><i class="fal fa-edit"></i></span>
                                        <input type="text" name="subject" placeholder="Subject" required>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="fp__contact_form_input textarea">
                                        <span><i class="fal fa-comment-alt-lines"></i></span>
                                        <textarea rows="5" name="message" placeholder="Write your message here..." required></textarea>
                                    </div>
                                    <button type="submit" id="submitContactBtn" class="common_btn mt_20">
                                        <span>Send Message</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Google Map -->
                <div class="row mt_100 xs_mt_70">
                    <div class="col-xl-12 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__contact_map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1689233827532!5m2!1sen!2sbd"
                                style="border:0; width: 100%; height: 420px; border-radius: 10px;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTACT PAGE END -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let btn = $('#submitContactBtn');
        let originalText = btn.html();

        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sending...');

        $.ajax({
            method: 'POST',
            url: "{{ route('contact.message.send') }}",
            data: form.serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    toastr.success(response.message);
                    form[0].reset();
                } else {
                    toastr.error(response.message || 'Something went wrong.');
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, val) {
                        toastr.error(val[0]);
                    });
                } else {
                    toastr.error('An error occurred while sending your message. Please try again.');
                }
            },
            complete: function() {
                btn.prop('disabled', false).html(originalText);
            }
        });
    });
});
</script>
@endpush

