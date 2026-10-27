@extends('admin.layouts.master')
@section('title', 'Customer Contact Messages')

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

        .badge-unread {
            background-color: #fc544b;
            color: white;
            font-size: 0.8rem;
            padding: 0.35rem 0.65rem;
            border-radius: 0.5rem;
        }

        .badge-read {
            background-color: #47c363;
            color: white;
            font-size: 0.8rem;
            padding: 0.35rem 0.65rem;
            border-radius: 0.5rem;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Customer Inquiries & Messages</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="text-primary">All Received Contact Messages</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-messages" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Received At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($messages as $msg)
                                            <tr id="row-{{ $msg->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td><strong>{{ $msg->name }}</strong></td>
                                                <td><a href="mailto:{{ $msg->email }}">{{ $msg->email }}</a></td>
                                                <td>{{ $msg->phone ?? 'N/A' }}</td>
                                                <td>{{ Str::limit($msg->subject, 30) }}</td>
                                                <td>
                                                    <span id="badge-{{ $msg->id }}" class="{{ $msg->is_read ? 'badge-read' : 'badge-unread' }}">
                                                        {{ $msg->is_read ? 'Read' : 'New' }}
                                                    </span>
                                                </td>
                                                <td>{{ $msg->created_at->format('M d, Y H:i') }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info view-message-btn" data-id="{{ $msg->id }}" title="View Message">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger delete-message-btn" data-id="{{ $msg->id }}" title="Delete Message">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted py-4">No contact messages received yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $messages->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Message Details Modal -->
    <div class="modal fade" id="messageDetailsModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="messageModalLabel"><i class="fas fa-envelope-open-text me-2"></i> Message Details</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="font-weight-bold">Sender Name:</label>
                            <p id="modal-sender-name" class="text-muted"></p>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold">Sender Email:</label>
                            <p id="modal-sender-email" class="text-muted"></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="font-weight-bold">Phone Number:</label>
                            <p id="modal-sender-phone" class="text-muted"></p>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold">Date Received:</label>
                            <p id="modal-received-date" class="text-muted"></p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold">Subject:</label>
                        <p id="modal-subject" class="font-weight-bold text-dark"></p>
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold">Message Content:</label>
                        <div id="modal-body-content" class="p-3 bg-light rounded" style="white-space: pre-wrap; line-height: 1.6;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="modal-reply-btn" href="#" class="btn btn-primary"><i class="fas fa-reply me-1"></i> Reply by Email</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // View message modal
            $('.view-message-btn').on('click', function() {
                let id = $(this).data('id');
                let url = "{{ route('admin.contact-messages.show', ':id') }}".replace(':id', id);

                $.ajax({
                    method: 'GET',
                    url: url,
                    success: function(response) {
                        if (response.status === 'success') {
                            let msg = response.data;
                            $('#modal-sender-name').text(msg.name);
                            $('#modal-sender-email').html('<a href="mailto:' + msg.email + '">' + msg.email + '</a>');
                            $('#modal-sender-phone').text(msg.phone || 'N/A');
                            $('#modal-subject').text(msg.subject);
                            $('#modal-body-content').text(msg.message);
                            $('#modal-received-date').text(new Date(msg.created_at).toLocaleString());
                            $('#modal-reply-btn').attr('href', 'mailto:' + msg.email + '?subject=Re: ' + encodeURIComponent(msg.subject));

                            // Update badge to Read
                            $('#badge-' + id).removeClass('badge-unread').addClass('badge-read').text('Read');

                            $('#messageDetailsModal').modal('show');
                        }
                    },
                    error: function() {
                        toastr.error('Failed to load message details.');
                    }
                });
            });

            // Delete message
            $('.delete-message-btn').on('click', function() {
                let id = $(this).data('id');
                let url = "{{ route('admin.contact-messages.destroy', ':id') }}".replace(':id', id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    $('#row-' + id).fadeOut(300, function() {
                                        $(this).remove();
                                    });
                                    toastr.success(response.message);
                                }
                            },
                            error: function() {
                                toastr.error('Failed to delete message.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush

