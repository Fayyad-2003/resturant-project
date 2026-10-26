@extends('admin.layouts.master')
@section('title', 'Blog Posts')

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
            <h1>Blog Posts</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="text-primary">All Blog Articles</h4>
                            <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Write Article
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-blog-posts" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th style="width: 15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $key => $post)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" style="width: 60px; height: 50px; object-fit: cover; border-radius: 6px;">
                                                </td>
                                                <td>
                                                    <strong>{{ Str::limit($post->title, 40) }}</strong>
                                                    <br><small class="text-muted"><code>/blog/{{ $post->slug }}</code></small>
                                                </td>
                                                <td><span class="badge badge-info">{{ $post->category->name ?? 'Uncategorized' }}</span></td>
                                                <td>{{ $post->user->name ?? 'Admin' }}</td>
                                                <td>
                                                    @if ($post->status == 1)
                                                        <span class="badge badge-success">Published</span>
                                                    @else
                                                        <span class="badge badge-secondary">Draft</span>
                                                    @endif
                                                </td>
                                                <td>{{ $post->created_at->format('d M, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.blog-posts.edit', $post->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.blog-posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this blog post?');">
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
            $('#table-blog-posts').DataTable({
                "order": [[0, "asc"]],
            });
        });
    </script>
@endpush

