@extends('front.layouts.app')

@section('content')
   <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url({{asset('front/assets/img/breadcrumb.png')}});">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Our Service</h1>
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                        <li>
                            <a href="index.html">
                            Home
                            </a>
                        </li>
                        <li>
                            <i class="fal fa-minus"></i>
                        </li>
                        <li>
                            Our Service
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
     <section class="feature-product-section fix section-padding pt-0">
         <div class="container">
            <div class="section-title text-center">
                <h2 class="split-text right mt-5">
                    Explore Our All Services
                </h2>
            </div>
            <div class="row">
                 @foreach($data as $category)
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="feature-product-items">
                        <div class="product-thumb">
                            <img src="{{ asset('images/product/category/'.$category->image) }}" alt="img" style="height: 200px; widht:300px; border-radius:15px;">
                            <ul class="product-icon d-flex justify-content-center align-items-center">
                                {{-- <li>
                                   <a href="{{ url('/shop?category/'.$category->slug) }}"><i class="fal fa-heart"></i></a>
                                </li>
                                <li>
                                    <a href="Javascript:void(0)">
                                        <i class="far fa-shopping-bag"></i>
                                    </a>
                                </li> --}}
                                <li>
                                   <a href="{{ url('/shop?category='.$category->slug) }}"><i class="far fa-eye"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product-content text-center mt-3">
                            <h4> <a href="{{ url('/shop?category='.$category->slug) }}">
                            {{ $category->name }}
                        </a></h4>
                        </div>
                    </div>
                </div>
                  @endforeach
            </div>
        </div>
    </section>
    <!-- Service Section Start -->
@endsection
@push('scripts')

@endpush