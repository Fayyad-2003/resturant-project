@extends('admin.layouts.master')
@section('title', 'Create Blog Category')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Blog Category</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>New Blog Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.blog-categories.store') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Category Name" required>
                                    @error('name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Category</button>
                                <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

