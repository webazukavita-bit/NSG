@extends('admin.layouts.app')

@section('content')

    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">
            
            <div class="card-title d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="bx bx-file me-1 font-22 text-primary"></i>
                    <h5 class="mb-0 text-primary">Add Variation Type</h5>
                </div>
                <div>
                    <a href="{{ route('variation-type') }}" class="btn btn-primary"><i class="bx bx-list-ol"></i> Variation Type List</a> 
                </div>
            </div>
            <hr>
            
            <form action="{{ route('variation-type-add') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf

                <div class="col-md-6">
                    <label for="name" class="form-label">Name<code>*</code></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                    @error('name')
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

               
                <hr>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-send"></i> Save</button>
                </div>
            </form>




            {{-- <form action="" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf

                <div class="col-md-12">
                    <label class="form-label">Select Type <code>*</code></label>
                    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Select Variation Type --</option>

                         @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach 

                    </select>
                    @error('parent_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label">Value Name <code>*</code></label>
                    <input type="text" name="value_name" class="form-control @error('value_name') is-invalid @enderror"
                        placeholder="Enter Value (e.g., Red, Green, XL, Large)" required>
                    @error('value_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label">Image</label>
                    <input type="file" accept="image/*" name="value_image" class="form-control">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="value_description" class="form-control"></textarea>
                </div>

                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-success"><i class="bx bx-send"></i> Save Value</button>
                </div>
            </form>
            --}}

        </div>
    </div>
@endsection
