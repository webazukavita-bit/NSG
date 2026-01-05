
{{-- 
@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-uppercase">Printing Services</h3>
    </div>

    <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
        @foreach ($data as $category)
            <div class="col">
                <a href="{{ route('booking-sub-category',['id' => $category->id]) }}"
                   class="text-decoration-none text-dark">

                    <div class="card">
            
                     <img src="{{ asset('images/product/category/' . ($category->image ?? '')) }}" class=""
                                 alt="category image" height="120">
                     

                        <div class="card-body text-center">
                            <h6 class="card-title m-0 text-primary">
                                {{ $category->name }}
                            </h6>
                        </div>
                    </div>

                </a>
            </div>
        @endforeach
    </div>
</div>

@endsection --}}


@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
<div class="d-flex justify-content-between align-items-center mb-2">
    <h3 class="fw-bold text-uppercase text-primary">Printing Services</h3>
</div>

    <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
        @foreach ($data as $category)
            <div class="col">
                <a href="{{ route('booking-sub-category',['id' => $category->id]) }}"
                   class="text-decoration-none">

                    <div class="card h-100 border-0">
                        <div class="position-relative overflow-hidden bg-light">
                            <img src="{{ asset('images/product/category/' . ($category->image ?? '')) }}" 
                                 class="card-img-top w-100 object-fit-cover p-1"
                                 style="height: 120px;"
                                 alt="{{ $category->name }}">
                        </div>

                        <div class="card-body text-center p-2">
                            <h5 class="card-title fw-bold text-dark mb-0 small">
                                {{ $category->name }}
                            </h5>
                        </div>
                    </div>

                </a>
            </div>
        @endforeach
    </div>
</div>


@endsection


