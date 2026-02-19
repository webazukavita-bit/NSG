@extends('admin.layouts.app')

@section('content')

<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">

        <div class="card-title d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                {{-- <i class="bx bxs-flag-checkered me-1 font-22 text-primary"></i> --}}
                <h5 class="mb-0 text-primary">Add Order Status</h5>
            </div>
            <div>
                <a href="{{ route('order-status.index') }}" class="btn btn-primary">
                    <i class="bx bx-list-ul"></i> Status List
                </a>
            </div>
        </div>

        <hr>

        <form action="{{ route('order-status.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf

            <div class="col-md-4">
                <label class="form-label">Status Name <code>*</code></label>
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Enter Status Name"
                       value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-2">
                <label class="form-label">Color <code>*</code></label>
                <input type="color" name="color"
                       class="form-control form-control-color
                       @error('color') is-invalid @enderror"
                       value="{{ old('color','#0d6efd') }}">
                @error('color')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-2">
                <label class="form-label">Order By</label>
                <input type="number" name="order_by"
                       class="form-control"
                       placeholder="1">
            </div>

            <div class="col-md-3">
                <label class="form-label">Image icon</label>
                <input type="file"
                       name="image_icon"
                       class="form-control"
                       >
            </div>

            <div class="col-12">
                <hr>
                <button type="submit" class="btn btn-primary radius-30 px-4">
                    <i class="bx bx-save"></i> Save Status
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
