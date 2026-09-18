@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="text-capitalize">Profile</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="{{ auth()->user()->name }}"
                                src="{{ auth()->user()->avatar ?? asset('admin/assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle profile-widget-picture" />
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Joining</div>
                                    <div class="profile-widget-item-value">
                                        {{ auth()->user()->created_at->format('M Y') }}
                                    </div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Your Products</div>
                                    <div class="profile-widget-item-value">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">
                                {{ auth()->user()->name }}
                                <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div>
                                    {{ auth()->user()->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card card-primary">
                        <form enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-header">
                                <h4 class="text-capitalize">Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="first_name"
                                                value="{{ old('first_name', auth()->user()->first_name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name"
                                                value="{{ old('last_name', auth()->user()->last_name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email', auth()->user()->email) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ old('phone', auth()->user()->phone) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" class="form-control" name="password"
                                                value="{{ old('password') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="text" class="form-control" name="confirm-password"
                                                value="{{ old('confirm-password') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label>Avatar</label>
                                            <input type="file" class="form-control" name="avatar" accept="image/*">
                                            @if (auth()->user()->avatar)
                                                <small class="text-muted">Current avatar:
                                                    <img src="{{ auth()->user()->avatar }}" alt="avatar"
                                                        class="img-thumbnail mt-2" style="max-width: 100px;">
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-left">
                                <button type="submit" class="btn btn-icon icon-left btn-primary">
                                    <i class="far fa-check-circle"></i> Update
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon icon-left btn-danger">
                                    <i class="fas fa-ban"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
