@extends('admin.layouts.master')
@section('title', 'Table Reservations')

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
            <h1>Table Reservations</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="text-primary">All Table Reservations</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-reservations" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer Name</th>
                                            <th>Phone</th>
                                            <th>Date</th>
                                            <th>Time Slot</th>
                                            <th>Persons</th>
                                            <th>Status</th>
                                            <th style="width: 20%">Change Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reservations as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <strong>{{ $item->name }}</strong>
                                                    @if ($item->user_id)
                                                        <br><small class="text-muted"><i class="fas fa-user-check text-success"></i> Registered Member</small>
                                                    @else
                                                        <br><small class="text-muted"><i class="fas fa-user-clock text-warning"></i> Guest</small>
                                                    @endif
                                                </td>
                                                <td><a href="tel:{{ $item->phone }}">{{ $item->phone }}</a></td>
                                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d M, Y') }}</td>
                                                <td><span class="badge badge-info">{{ $item->time }}</span></td>
                                                <td><span class="badge badge-dark">{{ $item->persons }} Persons</span></td>
                                                <td>
                                                    @if ($item->status == 'pending')
                                                        <span class="badge badge-warning text-dark font-weight-bold">Pending</span>
                                                    @elseif ($item->status == 'approved')
                                                        <span class="badge badge-success font-weight-bold">Approved</span>
                                                    @elseif ($item->status == 'canceled')
                                                        <span class="badge badge-danger font-weight-bold">Canceled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.reservations.update-status', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <select name="status" class="form-control form-control-sm d-inline-block" style="width: auto;" onchange="this.form.submit()">
                                                            <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="approved" {{ $item->status == 'approved' ? 'selected' : '' }}>Approve</option>
                                                            <option value="canceled" {{ $item->status == 'canceled' ? 'selected' : '' }}>Cancel</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.reservations.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this reservation?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
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
    <script src="{{ asset('admin/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table-reservations').DataTable({
                "order": [[0, "asc"]],
                "pageLength": 10
            });
        });
    </script>
@endpush

