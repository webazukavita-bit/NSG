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

    <!-- Service Section Start -->
    <section class="service-section section-padding">
        <div class="bg-shape">
            <img src="{{asset('front/assets/img/service/bg-shape.png')}}" alt="img">
        </div>
        <div class="container">
            <div class="service-wrapper-2">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="service-box-items wow fadeInUp" data-wow-delay=".3s">
                                    <div class="icon">
                                        <i class="fal fa-print"></i>
                                    </div>
                                    <div class="content">
                                        <h3><a href="javascript:void(0)">Printing Services</a></h3>
                                        <p>It is a long established fact xbliuthat a reader will be distracteda the readable content of a page when looking</p>
                                    </div>
                                </div>
                                <div class="service-box-items wow fadeInUp" data-wow-delay=".3s">
                                    <div class="icon">
                                        <i class="fal fa-desktop-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h3><a href="javascript:void(0)">Design Service</a></h3>
                                        <p>It is a long established fact xbliuthat a reader will be distracteda the readable content of a page when looking</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="service-box-items style-2 wow fadeInUp" data-wow-delay=".5s">
                                    <div class="icon">
                                        <i class="fal fa-shopping-bag"></i>
                                    </div>
                                    <div class="content">
                                        <h3><a href="javascript:void(0)">Promotional Product</a></h3>
                                        <p>It is a long established fact xbliuthat a reader will be distracteda the readable content of a page when looking</p>
                                    </div>
                                </div>
                                <div class="service-box-items wow fadeInUp" data-wow-delay=".5s">
                                    <div class="icon">
                                        <i class="fal fa-user"></i>
                                    </div>
                                    <div class="content">
                                        <h3><a href="javascript:void(0)">T-Shirt Printing</a></h3>
                                        <p>It is a long established fact xbliuthat a reader will be distracteda the readable content of a page when looking</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="service-right-content">
                            <div class="section-title">
                                <div class="sub-title wow fadeInUp">
                                    <span>Printing made easy</span>
                                </div>
                                <h2 class="split-text right">
                                    Fast And Quality <br> Service
                                </h2>
                            </div>
                            <p class="mt-3 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                                It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point of using lorem the is Ipsum Xbuild less normal  distribution best company in world of letters.
                                It is a long established fact that a reader will be distracted the readable content point.
                            </p>
                            <div class="icon-items wow fadeInUp" data-wow-delay=".3s">
                                <div class="icon">
                                    <img src="{{asset('front/assets/img/service/icon-1.png')}}" alt="img">
                                </div>
                                <div class="content">
                                    <h4>Payment Secure</h4>
                                    <span>Payment Secure</span>
                                </div>
                            </div>
                            <div class="icon-items wow fadeInUp" data-wow-delay=".5s">
                                <div class="icon">
                                    <img src="{{asset('front/assets/img/service/icon-2.png')}}" alt="img">
                                </div>
                                <div class="content">
                                    <h4>Payment Secure</h4>
                                    <span>Payment Secure</span>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="theme-btn wow fadeInUp" data-wow-delay=".3s">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Section Start -->
    <section class="service-section fix section-padding pt-0">
        <div class="container">
            <div class="section-title text-center">
                <div class="sub-title wow fadeInUp">
                    <span>OUR SERVICES</span>
                </div>
                <h2 class="split-text right">
                    Our Printnow Services
                </h2>
            </div>
            <div class="service-wrapper">
                <div class="swiper service-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="service-image">
                                <img src="{{asset('front/assets/img/service/01.jpg')}}" alt="img">
                                <div class="service-content">
                                    <h3><a href="javascript:void(0)">POD For Online Stores</a></h3>
                                </div>
                                <a href="javascript:void(0)" class="icon">
                                    <i class="far fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="service-image">
                                <img src="{{asset('front/assets/img/service/02.jpg')}}" alt="img">
                                <a href="javascript:void(0)" class="icon">
                                    <i class="far fa-long-arrow-right"></i>
                                </a>
                                <div class="service-content">
                                    <h3><a href="javascript:void(0)">Digital Scanning</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="service-image">
                                <img src="{{asset('front/assets/img/service/03.jpg')}}" alt="img">
                                <a href="javascript:void(0)" class="icon">
                                    <i class="far fa-long-arrow-right"></i>
                                </a>
                                <div class="service-content">
                                    <h3><a href="javascript:void(0)">Stickers And Labels</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="service-image">
                                <img src="{{asset('front/assets/img/feature-product/01.png')}}" alt="img" style="height: 430px;">
                                <a href="javascript:void(0)" class="icon">
                                    <i class="far fa-long-arrow-right"></i>
                                </a>
                                <div class="service-content">
                                    <h3><a href="javascript:void(0)">Printing Service</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-dot mt-5">
                        <div class="dot"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section Start -->
    <section class="pricing-section fix section-padding section-bg">
        <div class="pricing-shape">
            <img src="{{asset('front/assets/img/pricing-shape.png')}}" alt="img">
        </div>
        <div class="container">
            <div class="section-title text-center">
                <div class="sub-title wow fadeInUp">
                    <span>PRICING & PLAN</span>
                </div>
                <h2 class="split-text right">
                    Effective & Flexible <br> Pricing Plan
                </h2>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="pricing-single-items">
                        <div class="pricing-header">
                            <div class="post-head">Basic</div>
                            <p>Ideal for those who has small business.</p>
                            <h2>
                                $25000/ <sub>Year</sub>
                            </h2>
                        </div>
                        <ul class="price-list">
                            <li><i class="fas fa-check-circle"></i>3-5 days turnaround</li>
                            <li><i class="fas fa-check-circle"></i>
                                Native Development</li>
                            <li><i class="fas fa-check-circle"></i>Task delivered one-by-one</li>
                            <li><i class="fas fa-check-circle"></i>Dedicated dashboard</li>
                            <li><i class="fas fa-check-circle"></i>
                                Updates via dashboard & slack</li>
                            <li><i class="fas fa-check-circle"></i>
                                50k design & prints</li>
                        </ul>
                        <div class="pricing-button">
                            <a href="javascript:void(0)" class="theme-btn">choose pricing plan</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="pricing-single-items active">
                        <div class="pricing-header">
                            <div class="post-head">Pro Plus</div>
                            <p>Ideal for those who has small business.</p>
                            <h2>
                                $38000/ <sub>Year</sub>
                            </h2>
                        </div>
                        <ul class="price-list">
                            <li><i class="fas fa-check-circle"></i>3-5 days turnaround</li>
                            <li><i class="fas fa-check-circle"></i>
                                Native Development</li>
                            <li><i class="fas fa-check-circle"></i>Task delivered one-by-one</li>
                            <li><i class="fas fa-check-circle"></i>Dedicated dashboard</li>
                            <li><i class="fas fa-check-circle"></i>
                                Updates via dashboard & slack</li>
                            <li><i class="fas fa-check-circle"></i>
                                50k design & prints</li>
                        </ul>
                        <div class="pricing-button">
                            <a href="javascript:void(0)" class="theme-btn">choose pricing plan</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="pricing-single-items">
                        <div class="pricing-header">
                            <div class="post-head">Custom</div>
                            <p>Best for large business</p>
                            <h2>
                                $50000/ <sub>Year</sub>
                            </h2>
                        </div>
                        <ul class="price-list">
                            <li><i class="fas fa-check-circle"></i>3-5 days turnaround</li>
                            <li><i class="fas fa-check-circle"></i>
                                Native Development</li>
                            <li><i class="fas fa-check-circle"></i>Task delivered one-by-one</li>
                            <li><i class="fas fa-check-circle"></i>Dedicated dashboard</li>
                            <li><i class="fas fa-check-circle"></i>
                                Updates via dashboard & slack</li>
                            <li><i class="fas fa-check-circle"></i>
                                50k design & prints</li>
                        </ul>
                        <div class="pricing-button">
                            <a href="javascript:void(0)" class="theme-btn">choose pricing plan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Section Start -->
    <section class="service-section fix section-padding">
        <div class="container">
            <div class="section-title text-center">
                <div class="sub-title wow fadeInUp">
                    <span>our services</span>
                </div>
                <h2 class="split-text right">
                    Explore Our All Catagories
                </h2>
            </div>
            <div class="row">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="service-card-items">
                        <div class="service-thumb">
                            <img src="{{asset('front/assets/img/service/01.png')}}" alt="img">
                        </div>
                        <div class="service-content">
                            <h3><a href="javascript:void(0)">Printing Service</a></h3>
                            <p>
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered. There are many variations
                            </p>
                            <a href="javascript:void(0)" class="link-btn">Read More <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="service-card-items">
                        <div class="service-thumb">
                            <img src="{{asset('front/assets/img/service/02.png')}}" alt="img">
                        </div>
                        <div class="service-content">
                            <h3><a href="javascript:void(0)">Digital Scaning</a></h3>
                            <p>
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered. There are many variations
                            </p>
                            <a href="javascript:void(0)" class="link-btn">Read More <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="service-card-items">
                        <div class="service-thumb">
                            <img src="{{asset('front/assets/img/service/03.png')}}" alt="img">
                        </div>
                        <div class="service-content">
                            <h3><a href="javascript:void(0)">Design Services</a></h3>
                            <p>
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered. There are many variations
                            </p>
                            <a href="javascript:void(0)" class="link-btn">Read More <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="service-card-items">
                        <div class="service-thumb">
                            <img src="{{asset('front/assets/img/service/04.png')}}" alt="img">
                        </div>
                        <div class="service-content">
                            <h3><a href="javascript:void(0)">Brand Strategy</a></h3>
                            <p>
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered. There are many variations
                            </p>
                            <a href="javascript:void(0)" class="link-btn">Read More <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cta Section Start -->
    {{-- <section class="cta-section-3">
        <div class="container">
            <div class="cta-wrapper-3 bg-cover" style="background-image: url('{{asset('front/assets/img/cta-bg-3.jpg')}}');">
                <div class="cta-content">
                    <h2 class="split-text right">
                        Ready to Create Some <br>
                        Custome Products?
                    </h2>
                    <a href="contact.html" class="theme-btn wow fadeInUp" data-wow-delay=".5s">Contact Us</a>
                </div>
                <div class="cta-shape wow fadeInUp" data-wow-delay=".3s"> 
                    <img src="{{asset('front/assets/img/cta-2-shape2.png')}}" alt="img">
                </div>
            </div>
        </div>
    </section> --}}
	<!-- Why Choose us Section End -->
@endsection
@push('scripts')

@endpush