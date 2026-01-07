@extends('front.layouts.app')

@section('content')
  <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url({{asset('front/assets/img/breadcrumb.png')}});">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Blog Grid</h1>
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
                            Blog Grid
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- News Section Start -->
    <section class="news-section-section section-padding fix">
        <div class="container">
            <div class="row g-4">
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="news-card-items mt-0">
                        <div class="news-thumb">
                            <img src="{{asset('front/assets/img/news/04.jpg')}}" alt="img">
                            <div class="news-date">
                                <span>15</span>
                                <span>Mar</span>
                            </div>
                        </div>
                        <div class="news-content">
                            <div class="news-tag d-flex">
                                <a href="{{url('blog-details')}}">Printing</a>
                                <a href="{{url('blog-details')}}">Agency</a>
                            </div>
                            <h3><a href="{{url('blog-details')}}">What’s the Main Challange of Printing Service</a></h3>
                            <div class="client-info">
                                <div class="client-img bg-cover" style="background-image: url({{asset('front/assets/img/testimonial/01.png')}});"></div>
                                <div class="content">
                                    <h5>Shikhon Islam</h5>
                                    <p>June 29, 2025</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="news-card-items mt-0">
                        <div class="news-thumb">
                            <img src="{{asset('front/assets/img/news/05.jpg')}}" alt="img">
                            <div class="news-date">
                                <span>15</span>
                                <span>Mar</span>
                            </div>
                        </div>
                        <div class="news-content">
                            <div class="news-tag d-flex">
                                <a href="{{url('blog-details')}}">Printing</a>
                                <a href="{{url('blog-details')}}">Agency</a>
                            </div>
                            <h3><a href="{{url('blog-details')}}">Best 3D Printing Modern Equipment Team</a></h3>
                            <div class="client-info">
                                <div class="client-img bg-cover" style="background-image: url({{asset('front/assets/img/testimonial/02.png')}});"></div>
                                <div class="content">
                                    <h5>Salman Ahmed</h5>
                                    <p>June 29, 2025</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="news-card-items mt-0">
                        <div class="news-thumb">
                            <img src="{{asset('front/assets/img/news/06.jpg')}}" alt="img">
                            <div class="news-date">
                                <span>15</span>
                                <span>Mar</span>
                            </div>
                        </div>
                        <div class="news-content">
                            <div class="news-tag d-flex">
                                <a href="{{url('blog-details')}}">Printing</a>
                                <a href="{{url('blog-details')}}">Agency</a>
                            </div>
                            <h3><a href="{{url('blog-details')}}">What’s the Main Challange of Printing Service</a></h3>
                            <div class="client-info">
                                <div class="client-img bg-cover" style="background-image: url({{asset('front/assets/img/testimonial/03.png')}});"></div>
                                <div class="content">
                                    <h5>Kawser Ahmed</h5>
                                    <p>June 29, 2025</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="news-card-items mt-0">
                        <div class="news-thumb">
                            <img src="{{asset('front/assets/img/news/06.jpg')}}" alt="img">
                            <div class="news-date">
                                <span>15</span>
                                <span>Mar</span>
                            </div>
                        </div>
                        <div class="news-content">
                            <div class="news-tag d-flex">
                                <a href="{{url('blog-details')}}">Printing</a>
                                <a href="{{url('blog-details')}}">Agency</a>
                            </div>
                            <h3><a href="{{url('blog-details')}}">What’s the Main Challange of Printing Service</a></h3>
                            <div class="client-info">
                                <div class="client-img bg-cover" style="background-image: url({{asset('front/assets/img/testimonial/03.png')}});"></div>
                                <div class="content">
                                    <h5>Kawser Ahmed</h5>
                                    <p>June 29, 2025</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="news-card-items mt-0">
                        <div class="news-thumb">
                            <img src="{{asset('front/assets/img/news/04.jpg')}}" alt="img">
                            <div class="news-date">
                                <span>15</span>
                                <span>Mar</span>
                            </div>
                        </div>
                        <div class="news-content">
                            <div class="news-tag d-flex">
                                <a href="{{url('blog-details')}}">Printing</a>
                                <a href="{{url('blog-details')}}">Agency</a>
                            </div>
                            <h3><a href="{{url('blog-details')}}">What’s the Main Challange of Printing Service</a></h3>
                            <div class="client-info">
                                <div class="client-img bg-cover" style="background-image: url({{asset('front/assets/img/testimonial/01.png')}});"></div>
                                <div class="content">
                                    <h5>Shikhon Islam</h5>
                                    <p>June 29, 2025</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="news-card-items mt-0">
                        <div class="news-thumb">
                            <img src="{{asset('front/assets/img/news/05.jpg')}}" alt="img">
                            <div class="news-date">
                                <span>15</span>
                                <span>Mar</span>
                            </div>
                        </div>
                        <div class="news-content">
                            <div class="news-tag d-flex">
                                <a href="{{url('blog-details')}}">Printing</a>
                                <a href="{{url('blog-details')}}">Agency</a>
                            </div>
                            <h3><a href="{{url('blog-details')}}">Best 3D Printing Modern Equipment Team</a></h3>
                            <div class="client-info">
                                <div class="client-img bg-cover" style="background-image: url({{asset('front/assets/img/testimonial/02.png')}});"></div>
                                <div class="content">
                                    <h5>Salman Ahmed</h5>
                                    <p>June 29, 2025</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-nav-wrap mt-5 text-center wow fadeInUp" data-wow-delay=".3s">
                <ul>
                    <li><a class="page-numbers" href="#"><i class="fal fa-long-arrow-left"></i></a></li>
                    <li><a class="page-numbers" href="#">01</a></li>
                    <li><a class="page-numbers" href="#">02</a></li>
                    <li><a class="page-numbers" href="#">..</a></li>
                    <li><a class="page-numbers" href="#">10</a></li>
                    <li><a class="page-numbers" href="#">11</a></li>
                    <li><a class="page-numbers" href="#"><i class="fal fa-long-arrow-right"></i></a></li>
                </ul>
            </div>
        </div>
    </section>
@endsection