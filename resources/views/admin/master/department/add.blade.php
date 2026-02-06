@extends('admin.layouts.app')

@section('content')

<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">

        <div class="card-title d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="bx bx-category me-1 font-22 text-primary"></i>
                <h5 class="mb-0 text-primary">Add Department</h5>
            </div>
            <div>
                <a href="{{ route('department.index') }}" class="btn btn-primary">
                    <i class="bx bx-list-ol"></i> Department List
                </a>
            </div>
        </div>

        <hr>

        <form action="{{ route('department.store') }}" method="POST" class="row g-3">
            @csrf

            <div class="col-md-4">
                <label for="name" class="form-label">
                    Name <code>*</code>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Enter Department Name"
                       value="{{ old('name') }}"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="col-md-4">
                <label for="slug" class="form-label">
                    Slug <code>*</code>
                </label>
                <input type="text"
                       name="slug"
                       id="slug"
                       class="form-control @error('slug') is-invalid @enderror"
                       placeholder="department-slug"
                       value="{{ old('slug') }}"
                       required>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> --}}

            <hr>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-send"></i> Save
                </button>
            </div>
        </form>

    </div>
</div>

@endsection
