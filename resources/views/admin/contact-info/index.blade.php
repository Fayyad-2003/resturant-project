@extends('admin.layouts.master')
@section('title', 'Manage Contact Info Cards')

@push('styles')
    <style>
        .card {
            border: 1px solid #e3e3e0;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #1b1b18;
            color: #EDEDEC;
            border-bottom: 2px solid #F8B803;
            border-radius: 0.75rem 0.75rem 0 0 !important;
            padding: 1.25rem 1.5rem;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 600;
            color: #EDEDEC;
        }

        .icon-box-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #fff2e7;
            color: #f75d34;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Contact Cards & Details</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="text-primary">Contact Info Cards Displayed on Contact Us Page</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Icon</th>
                                            <th>Title</th>
                                            <th>Detail 1</th>
                                            <th>Detail 2</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($contactInfos as $info)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="icon-box-circle">
                                                        <i class="{{ $info->icon }}"></i>
                                                    </span>
                                                </td>
                                                <td><strong>{{ $info->title }}</strong></td>
                                                <td>{{ $info->info_1 ?? 'N/A' }}</td>
                                                <td>{{ $info->info_2 ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge {{ $info->status ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $info->status ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.contact-info.edit', $info->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">No contact info cards found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

