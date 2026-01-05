@extends('admin.layouts.app')

@section('content')

    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">
            
            <div class="card-title d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="bx bx-file me-1 font-22 text-primary"></i>
                    <h5 class="mb-0 text-primary">Update Variation Value</h5>
                </div>
                <div>
                    <a href="{{ route('variation-value') }}" class="btn btn-primary"><i class="bx bx-list-ol"></i> Variation List</a> 
                </div>
            </div>
            <hr>
            
            <form action="{{ route('variation-value-update', ['id' => $data->id]) }}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf

                <div class="col-md-3">
                    <label for="parent_id" class="form-label">Type<code>*</code></label>
                    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" id="parent_id">
                        <option selected disabled value="">Choose...</option>
                        @foreach ($types as $type)
                        <option value="{{ $type->id }}" @selected($type->id == old('parent_id', $data->parent_id))>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="value" class="form-label">Value</label>
                    <input type="text" name="value" class="form-control @error('value') is-invalid @enderror" id="value" placeholder="Enter Name" value="{{ old('value', $data->name) }}">
                    @error('value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" accept="image/*" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Enter image" id="image" value="{{ old('image') }}">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="" class="form-label">Old Image</label>
                    <img src="{{ asset('images/variation/value/' . $data->image) }}" class="product-img-2" alt="variation img" style="margin-right: 8px;">
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control">{!! old('description', $data->description) !!}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-send"></i> Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection