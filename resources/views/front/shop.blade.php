@extends('front.layouts.app')
<style>
    .book-btn {
    display: inline-block;
    padding: 10px 22px;
    background: linear-gradient(135deg, #1234a4, #45318e);
    color: #fff;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(241, 233, 238, 0.3);
}

.book-btn:hover {
    background: linear-gradient(135deg, #1234a4, #45318e);
    color: #fff;
    transform: translateY(-2px);
}

</style>
@section('content')
<!--<< Breadcrumb Section Start >>-->
     <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url({{asset('front/assets/img/breadcrumb.png')}});">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Shop List</h1>
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                        <li>
                            <a href="{{url('/')}}">
                            Home
                            </a>
                        </li>
                        <li>
                            <i class="fal fa-minus"></i>
                        </li>
                        <li>
                            Shop List
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Section Start -->
    <section class="shop-section fix section-paddings">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3 order-2 order-md-1">
                    <div class="shop-main-sidebar">
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h4>search here</h4>
                            </div>
                            <div class="search_widget">
                                <form action="{{ url('/shop') }}" method="GET">
    <input type="text" name="search" placeholder="Search products..."
           value="{{ request('search') }}">
    <button type="submit">
        <i class="fal fa-search"></i>
    </button>
</form>

                            </div>
                        </div>
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h4>Catagories</h4>
                            </div>
                            <div class="shop-catagory-items">
                                <ul>
                                    @foreach($categories as $category)
                                    <li>
                                       <a href="{{ url('/shop?category='.$category->slug) }}">
                                          {{ $category->name }}
                                       </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                      
                        
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-md-2">
                    <div class="row">
    @forelse($products as $product)
        <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
            <div class="feature-product-items">
                <div class="product-thumb">
                    <img src="{{ asset('images/product/'.$product->image[0]) }}" alt="{{ $product->name }}" style="height: 200px; widht:300px; border-radius:15px;">

                    <ul class="product-icon d-grid justify-content-center align-items-center">
                        <li><a href="#"><i class="far fa-heart"></i></a></li>
                        <li><a href="{{ url('shop-details/'.$product->id) }}"><i class="far fa-eye"></i></a></li>
                        {{-- <li><a href="#"><i class="fal fa-cart-plus"></i></a></li> --}}
                    </ul>
                </div>

                <div class="product-content text-center mt-3">

                    
                          <p style="height: 80px;"><a href="{{ url('shop-details/'.$product->id) }}">
                        {{ $product->category->name }}
                        </a>|<a href="{{ url('shop-details/'.$product->id) }}" 
                            style="text-transform: capitalize;">
                        {{ $product->name }}
                        </a></p>

                    

                    <ul class="price-list mt-2 justify-content-center">                       
                      <a href="{{ url('shop-details/'.$product->slug) }}" class="btn book-btn text-white">Order Now</a>
                    </ul>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center">No products found</p>
    @endforelse
</div>

                    <div class="page-nav-wrap mt-5 text-center wow fadeInUp" data-wow-delay=".3s">
                        <div class="mt-5 text-center">
    {{ $products->links('pagination::bootstrap-5') }}
</div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection