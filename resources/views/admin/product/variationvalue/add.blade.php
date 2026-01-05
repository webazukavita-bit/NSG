@extends('admin.layouts.app')

@section('content')

    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">
            
            <div class="card-title d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="bx bx-file me-1 font-22 text-primary"></i>
                    <h5 class="mb-0 text-primary">Add Variation Value</h5>
                </div>
                <div>
                    <a href="{{ route('variation-value') }}" class="btn btn-primary"><i class="bx bx-list-ol"></i> Variation Value List</a> 
                </div>
            </div>
            <hr>




            <form action="{{route('variation-value-store')}}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf


                <div class="col-md-6">
                    <label for="parent_id" class="form-label">Type</label>
                    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" id="parent_id">
                        <option selected disabled value="">Choose...</option>
                        @foreach ($data as $type)
                        <option value="{{ $type->id }}" @selected($type->id == old('parent_id'))>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Value <code>*</code></label>
                    <input type="text" name="value" class="form-control @error('value') is-invalid @enderror"
                        placeholder="Enter Value" value="{{old('value')}}" required>
                    @error('value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" accept="image/*" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Enter image" id="image" value="{{ old('image') }}">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea  name="description" class="form-control">{!! old('description') !!}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-success"><i class="bx bx-send"></i> Save Value</button>
                </div>
            </form>
           

        </div>
    </div>
@endsection
