@extends('front.layouts.app')
@section('content')
  <!--<< Breadcrumb Section Start >>-->
     <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url({{asset('front/assets/img/breadcrumb.png')}});">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Shop Details</h1>
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
                            Shop Details
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Details Section Start -->
    <section class="shop-details-section section-padding">
        <div class="container">
        <div class="shop-details-wrapper">
            <div class="row">
                <div class="col-lg-5">
                    <div class="shop-details-image">
                    <div class="tab-content">
                        <div id="thumb1" class="tab-pane fade show active">
                            <div class="shop-thumb">
                                <img src="{{asset('front/assets/img/shop/details.jpg')}}" alt="img">
                            </div>
                        </div>
                        <div id="thumb2" class="tab-pane fade">
                            <div class="shop-thumb">
                                <img src="{{asset('front/assets/img/shop/details-2.jpg')}}" alt="img">
                            </div>
                        </div>
                        <div id="thumb3" class="tab-pane fade">
                            <div class="shop-thumb">
                                <img src="{{asset('front/assets/img/shop/details-3.jpg')}}" alt="img">
                            </div>
                        </div>
                        <div id="thumb4" class="tab-pane fade">
                            <div class="shop-thumb">
                                <img src="{{asset('front/assets/img/shop/details-4.jpg')}}" alt="img">
                            </div>
                        </div>
                        </div>
                        <ul class="nav mb-5">
                        <li class="nav-item">
                            <a href="#thumb1" data-bs-toggle="tab" class="nav-link ps-0 active">
                            <img src="{{asset('front/assets/img/shop/sm-1.jpg')}}" alt="img">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#thumb2" data-bs-toggle="tab" class="nav-link">
                            <img src="{{asset('front/assets/img/shop/sm-2.jpg')}}" alt="img">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#thumb3" data-bs-toggle="tab" class="nav-link">
                            <img src="{{asset('front/assets/img/shop/sm-3.jpg')}}" alt="img">
                            </a>
                        </li>
                        <li class="nav-item">
                        <a href="#thumb4" data-bs-toggle="tab" class="nav-link">
                            <img src="{{asset('front/assets/img/shop/sm-4.jpg')}}" alt="img">
                        </a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="product-details-content">
                        <h2 class="pb-3">Modern World History</h2>
                        <div class="star pb-3">
                            <a href="#"> <i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                            <a href="#"> <i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                            <span>(25 Customer Review)</span>
                        </div>
                        <p class="mb-3">
                            In today’s online world, a brand’s success lies in combining
                            technological planning and social strategies to draw
                            customers in–and keep them coming back
                        </p>
                        <div class="price-list">
                            <h3>$19.99</h3>
                        </div>
                        <div class="cart-wrp">
                            <div class="cart-quantity">
                                <form id='myform' method='POST' class='quantity' action='#'>
                                    <input type='button' value='-' class='qtyminus minus'>
                                    <input type='text' name='quantity' value='0' class='qty'>
                                    <input type='button' value='+' class='qtyplus plus'>
                                </form>
                            </div>
                            <a href="{{url('shop-details')}}" class="icon">
                                <i class="far fa-heart"></i>
                            </a>
                            <a href="{{url('shop-details')}}" class="icon">
                                <i class="far fa-share"></i>
                            </a>
                        </div>
                        <div class="shop-btn">
                            <a href="{{url('shop-details')}}" class="theme-btn">
                                <span> Add to cart</span>
                            </a>
                            <a href="{{url('shop-details')}}" class="theme-btn">
                                <span> Buy now</span>
                            </a>
                        </div>
                        <h6 class="details-info"><span>SKU:</span> <a href="{{url('shop-details')}}">124224</a></h6>
                        <h6 class="details-info"><span>Categories:</span> <a href="{{url('shop-details')}}">Crux Indoor Fast and Easy</a></h6>
                        <h6 class="details-info style-2"><span>Tags:</span> <a href="{{url('shop-details')}}"> <b>accessories</b> <b>business</b></a></h6>
                    </div>
                </div>
            </div>
            <div class="single-tab">
                <ul class="nav mb-5">
                    <li class="nav-item">
                    <a href="#description" data-bs-toggle="tab" class="nav-link ps-0 active">
                        <h6>Description</h6>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="#additional" data-bs-toggle="tab" class="nav-link">
                        <h6>Additional Information  </h6>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="#review" data-bs-toggle="tab" class="nav-link">
                        <h6>reviews (3)</h6>
                    </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="description" class="tab-pane fade show active">
                    <div class="description-items">
                        <div class="description-content">
                            <h3>Product descriptions</h3>
                            <p class="mb-4">
                                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.  When purchasing or selling a handcrafted painting, it's essential to have a clear understanding of these product details to make an informed decision and to provide potential buyers with a comprehensive description of the artwork. Additionally, the value and significance of a handcrafted painting can be influenced by factors like the artist's reputation, the rarity of the piece, and the demand for their work in the
                                art market.
                            </p>
                            <p>
                                When purchasing or selling a handcrafted painting, it's essential to have a clear understanding of these product details to make an informed decision and to provide potential buyers with a comprehensive description of the artwork. Additionally, the value and significance of a handcrafted painting can be influenced by factors like the artist's reputation, the rarity of the piece, and the demand for their work in the
                                art market.painting can be influenced by factors like the artist's reputation, the rarity of the piece, and the demand for their work in the
                                art market.
                            </p>
                            <div class="description-list-items d-flex justify-content-between">
                                <ul class="description-list">
                                <li>
                                    Model wears:
                                    <span>UK 10/ EU 38/ US 6</span>
                                </li>
                                <li>
                                    Occasion:
                                    <span> Lifestyle, Sport</span>
                                </li>
                                <li>
                                    Country:
                                    <span>Italy</span>
                                </li>
                                </ul>
                                <ul class="description-list">
                                <li>
                                    Model wears:
                                    <span>UK 10/ EU 38/ US 6</span>
                                </li>
                                <li>
                                    Occasion:
                                    <span> Lifestyle, Sport</span>
                                </li>
                                <li>
                                    Country:
                                    <span>Italy</span>
                                </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div id="additional" class="tab-pane fade">
                    <div class="table-responsive mb-15">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                <td>Weight</td>
                                <td>240 Ton</td>
                                </tr>
                                <tr>
                                <td>Dimensions</td>
                                <td>20 × 30 × 40 cm</td>
                                </tr>
                                <tr>
                                <td>Colors</td>
                                <td>Black, Blue, Green</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div id="review" class="tab-pane fade">
                    <div class="review-items">
                        <div class="admin-items d-flex flex-wrap flex-md-nowrap align-items-center pb-4">
                            <div class="admin-img pb-4 pb-md-0 me-4">
                                <img src="{{asset('front/assets/img/shop/r-1.jpg')}}" alt="image">
                            </div>
                            <div class="content p-4">
                                <div class="head-content pb-1 d-flex flex-wrap justify-content-between">
                                <h5>miklos salsa<span>27June 2025 at 5.44pm</span></h5>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                </div>
                                <p>
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Curabitur vulputate vestibulum Phasellus rhoncus dolor eget viverra pretium.Curabitur vulputate vestibulum Phasellus rhoncus dolor eget viverra pretium.
                                </p>
                            </div>
                        </div>
                        <div class="admin-items d-flex flex-wrap flex-md-nowrap align-items-center pb-4">
                            <div class="admin-img pb-4 pb-md-0 me-4">
                                <img src="{{asset('front/assets/img/shop/r-2.jpg')}}" alt="image">
                            </div>
                            <div class="content p-4">
                                <div class="head-content pb-1 d-flex flex-wrap justify-content-between">
                                <h5>Ethan Turner <span>27June 2025 at 5.44pm</span></h5>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                </div>
                                <p>
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Curabitur vulputate vestibulum Phasellus rhoncus dolor eget viverra pretium.Curabitur vulputate vestibulum Phasellus rhoncus dolor eget viverra pretium.
                                </p>
                            </div>
                        </div>
                        <div class="admin-items d-flex flex-wrap flex-md-nowrap align-items-center pb-4">
                            <div class="admin-img pb-4 pb-md-0 me-4">
                                <img src="{{asset('front/assets/img/shop/r-3.png')}}" alt="image">
                            </div>
                            <div class="content p-4">
                                <div class="head-content pb-1 d-flex flex-wrap justify-content-between">
                                <h5>Devid Miller<span>27June 2025 at 5.44pm</span></h5>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                </div>
                                <p>
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Curabitur vulputate vestibulum Phasellus rhoncus dolor eget viverra pretium.Curabitur vulputate vestibulum Phasellus rhoncus dolor eget viverra pretium.
                                </p>
                            </div>
                        </div>
                        <div class="review-title mt-5 py-15 mb-30">
                            <h4>add a review</h4>
                            <div class="rate-now d-flex align-items-center">
                                <p>Rate this product? *</p>
                                <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="review-form">
                            <form action="#" id="contact-form" method="POST">
                                <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <input type="text" name="name" id="name" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <input type="text" name="email" id="email" placeholder="email addres">
                                    </div>
                                </div>
                                <div class="col-lg-12 wow fadeInUp" data-wow-delay=".8">
                                    <div class="form-clt-big form-clt">
                                        <textarea name="message" id="message" placeholder="message"></textarea> 
                                    </div>
                                </div>
                                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".9">
                                    <button type="submit" class="theme-btn">
                                        <span>Post Submit</span>
                                    </button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

    <!-- Product Section Start -->
    <section class="product-section fix section-padding pt-0">
        <div class="container">
            <div class="section-title text-center">
                <div class="sub-title wow fadeInUp">
                    <span>our Product</span>
                </div>
                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                    Related Products
                </h2>
            </div>
            <div class="swiper product-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="products-box-items">
                            <ul class="product-top">
                                <li>Mug</li>
                                <li>$59.00</li>
                            </ul>
                            <div class="product-thumb">
                                <img src="{{asset('front/assets/img/product/p-1.jpg')}}" alt="img">
                                <ul class="product-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{url('shop-details')}}">
                                            <i class="fal fa-expand-arrows"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('shop-details')}}"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <a href="shop-cart.html" class="theme-btn">Add To cart</a>
                            </div>
                            <div class="product-content">
                                <h4><a href="{{url('shop-details')}}">Coffee Mug</a></h4>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="products-box-items">
                            <ul class="product-top">
                                <li>Hoodie</li>
                                <li>$70.00</li>
                            </ul>
                            <div class="product-thumb">
                                <img src="{{asset('front/assets/img/feature-product/05.webp')}}" alt="img" style="height: 320px;">
                                <ul class="product-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{url('shop-details')}}">
                                            <i class="fal fa-expand-arrows"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('shop-details')}}"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <a href="shop-cart.html" class="theme-btn">Add To cart</a>
                            </div>
                            <div class="product-content">
                                <h4><a href="{{url('shop-details')}}">Stylish Hoodie</a></h4>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="products-box-items">
                            <ul class="product-top">
                                <li>Packet</li>
                                <li>$30.00</li>
                            </ul>
                            <div class="product-thumb">
                                <img src="{{asset('front/assets/img/product/p-3.jpg')}}" alt="img">
                                <ul class="product-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{url('shop-details')}}">
                                            <i class="fal fa-expand-arrows"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('shop-details')}}"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <a href="shop-cart.html" class="theme-btn">Add To cart</a>
                            </div>
                            <div class="product-content">
                                <h4><a href="{{url('shop-details')}}">Packaging</a></h4>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="products-box-items">
                            <ul class="product-top">
                                <li>Bag</li>
                                <li>$49.00</li>
                            </ul>
                            <div class="product-thumb">
                                <img src="{{asset('front/assets/img/product/p-2.jpg')}}" alt="img">
                                <ul class="product-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{url('shop-details')}}">
                                            <i class="fal fa-expand-arrows"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('shop-details')}}"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <a href="shop-cart.html" class="theme-btn">Add To cart</a>
                            </div>
                            <div class="product-content">
                                <h4><a href="{{url('shop-details')}}">Shopping Bag</a></h4>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-dot mt-2">
                    <div class="dot"></div>
                </div>
            </div>
        </div>
    </section>

@endsection