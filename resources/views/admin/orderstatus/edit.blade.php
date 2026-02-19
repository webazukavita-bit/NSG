@extends('admin.layouts.app')

@section('content')

<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">

        <div class="card-title d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="bx bxs-edit-alt me-1 font-22 text-primary"></i>
                <h5 class="mb-0 text-primary">Edit Order Status</h5>
            </div>
            <div>
                <a href="{{ route('order-status.index') }}" class="btn btn-primary">
                    <i class="bx bx-list-ul"></i> Status List
                </a>
            </div>
        </div>

        <hr>

        <form action="{{ route('order-status.update', $orderStatus->id) }}"
              method="POST" class="row g-3"   enctype="multipart/form-data" >
            @csrf

            <div class="col-md-4">
                <label class="form-label">Status Name <code>*</code></label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $orderStatus->name) }}"
                       placeholder="Enter Status Name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
             
            <div class="col-md-2">
                <label class="form-label">Color <code>*</code></label>
                <input type="color"
                       name="color"
                       class="form-control form-control-color
                       @error('color') is-invalid @enderror"
                       value="{{ old('color', $orderStatus->color) }}">
                @error('color')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-2">
                <label class="form-label">Order By</label>
                <input type="number"
                       name="order_by"
                       class="form-control"
                       value="{{ old('order_by', $orderStatus->order_by) }}">
            </div>

          <div class="col-md-3">
    <label class="form-label">Image Icon</label>
    <input type="file"
           name="image_icon"
           class="form-control @error('image_icon') is-invalid @enderror" >

    @error('image_icon')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if(!empty($orderStatus->image_icon))
        <div class="mt-2">
            <img src="{{ asset('images/order-status/'.$orderStatus->image_icon) }}"
                 width="40" height="40">
        </div>
    @endif
</div>


            <div class="col-12">
                <hr>
                <button type="submit" class="btn btn-success radius-30 px-4">
                    <i class="bx bx-check-circle"></i> Update Status
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
