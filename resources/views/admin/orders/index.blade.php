@extends('admin.layouts.master')
@section('title', 'All Orders')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
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
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Orders Management</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="text-primary">{{ $title ?? 'All Orders' }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-orders" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer</th>
                                            <th>Order No</th>
                                            <th>Items Qty</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th style="width: 15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <strong>{{ $item->name }}</strong><br>
                                                    <small class="text-muted">{{ $item->email }}</small>
                                                </td>
                                                <td><span
                                                        class="badge badge-light font-weight-bold">#{{ $item->order_number }}</span>
                                                </td>
                                                <td>{{ $item->orderDetails->sum('qty') }}</td>
                                                <td><strong>{{ currencyPosition($item->amount) }}</strong></td>
                                                <td>
                                                    @if ($item->status === 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif ($item->status === 'progress')
                                                        <span class="badge badge-info">In Process</span>
                                                    @elseif ($item->status === 'delivered')
                                                        <span class="badge badge-success">Delivered</span>
                                                    @else
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span><br>
                                                    <small
                                                        class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.order.details', $item->id) }}"
                                                        class="btn btn-primary btn-sm" title="View Details">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
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

@push('scripts')
    <script src="{{ asset('admin/assets/modules/datatables/datatables.min.js') }}"></script>
    <script
        src="{{ asset('admin/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#table-orders').DataTable();
        });
    </script>
@endpush