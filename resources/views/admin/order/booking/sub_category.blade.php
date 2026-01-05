

@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-2">
        <h3 class="fw-bold text-dark mb-0">
            {{ $category->name }}
        </h3>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3">
        @foreach ($products as $cat)
            <div class="col">
                <a href="{{ route('booking-details',['id' => $category->id]) }}"
                   class="text-decoration-none">
                    
                    <div class="bg-white rounded-3 shadow-sm">
                        <div class="position-relative">
                            <img src="{{ asset('images/product/' . ($cat->image)) }}" 
                                 class="w-100 rounded-top object-fit-cover p-1 border-bottom" 
                                 alt="{{ $cat->name }}" 
                                 height="140">
                        </div>

                        <div class="p-2 pt-0">
                                <h6 class="text-dark fw-bold mb-0 text-truncate">
                                    {{ $cat->name }}
                                </h6>
                               <small class="text-muted">(QTY: {{$cat->stock_quantity}})</small>
                            <div class=" overflow-auto" style="height: 60px;">
                                @foreach($cat->variations as $variation)
                                    <div class="mb-0 text-dark">
                                           <strong> {{ $variation->variationType->name }}:</strong> {{ $variation->variationValue->name }}

                                    </div>
                                @endforeach
                            </div>
                            {{-- <small class="text-muted">(QTY: {{$cat->stock_quantity}})</small> --}}
                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                <span class="text-dark">Price</span>
                                <span class="fw-bold text-primary fs-6">
                                    ₹{{ number_format($cat->price, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                </a>
            </div>
        @endforeach
    </div>

</div>


@endsection
