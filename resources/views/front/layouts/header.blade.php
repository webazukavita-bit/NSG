  <div id="preloader" class="preloader">
        <div class="animation-preloader">
            <div class="spinner">                
            </div>
            <div class="txt-loading">
                <span data-text-preloader="N" class="letters-loading">
                    N
                </span>
                <span data-text-preloader="S" class="letters-loading">
                    S
                </span>
                <span data-text-preloader="G" class="letters-loading">
                    G
                </span>
                 <span data-text-preloader="" class="letters-loading">
                    <img src="{{asset('images/config/'.config('app.logo'))}}" alt="" style="width: 90px; height: 90px;">
                </span>
                {{-- <span data-text-preloader="N" class="letters-loading">
                    N
                </span>
                <span data-text-preloader="T" class="letters-loading">
                    T
                </span>
                <span data-text-preloader="N" class="letters-loading">
                    N
                </span>
                <span data-text-preloader="0" class="letters-loading">
                    O
                </span>
                <span data-text-preloader="W" class="letters-loading">
                    W
                </span> --}}
            </div>
            <p class="text-center">Loading</p>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>

    <!--<< Mouse Cursor Start >>-->  
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <!-- Back To Top Start -->
    <div class="scroll-up">
        <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <!-- Offcanvas Area Start -->
    <div class="fix-area">
        <div class="offcanvas__info">
            <div class="offcanvas__wrapper">
                <div class="offcanvas__content">
                    <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                        <div class="offcanvas__logo">
                            <a href="">
                                <img src="{{ asset('images/config/'.config('app.logo')) }}" alt="logo-img" style="width: 165px;">
                            </a>
                        </div>
                        <div class="offcanvas__close">
                            <button>
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text d-none d-xl-block">
                        This involves interactions between a business and its customers. It's about meeting customers' needs and resolving their problems. Effective customer service is crucial.
                    </p>
                    <div class="mobile-menu fix mb-3"></div>
                    <div class="offcanvas__contact">
                        <h4>Contact Info</h4>
                        <ul>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a target="_blank" href="#">{{ config('app.contact_us') }}</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                     <a href="https://modinatheme.com/cdn-cgi/l/email-protection#6b02050d042b0e130a061b070e45080406"><span class="mailto:info@azent.com"><span class="__cf_email__" data-cfemail="5c35323a331c39243d312c3039723f3331">{{ config('app.email_account') }}</span></span></a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-clock"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a target="_blank" href="#">{{ config('app.open_hours') }}</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="far fa-phone"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="tel:+11002345909">+{{ config('app.contact_us') }}</a>
                                </div>
                            </li>
                        </ul>
                        <div class="header-button mt-4">
                            <a href="shop-details.html" class="theme-btn">Shop Now <i class="far fa-arrow-right"></i></a>
                        </div>
                        <div class="social-icon d-flex align-items-center">
                            <a href="{{ config('app.facebook') }}"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ config('app.twitter') }}"><i class="fab fa-twitter"></i></a>
                            <a href="{{ config('app.youtube') }}"><i class="fab fa-youtube"></i></a>
                            <a href="{{ config('app.linkedin') }}"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas__overlay"></div>

    <!-- Header Top Section Start -->
    <div class="header-top-section">
        <div class="container-fluid">
            <div class="header-top-wrapper">
                <ul class="contact-list">
                    <li>
                        <i class="far fa-envelope"></i>
                        <a href="https://modinatheme.com/cdn-cgi/l/email-protection#274e49414867425f464a574b420944484a" class="link"><span class="__cf_email__" data-cfemail="cda4a3aba28da8b5aca0bda1a8e3aea2a0">{{ config('app.email_account') }}</span></a>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        {{ config('app.contact_us') }}
                    </li>
                </ul>
                <div class="header-top-right">
                    <div class="social-icon d-flex align-items-center">
                        <a href="{{ config('app.facebook_url') }}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ config('app.twitter_url') }}"><i class="fab fa-twitter"></i></a>
                        <a href="{{ config('app.instagram_url') }}"><i class="fab fa-instagram"></i></a>
                        <a href="{{ config('app.linkedin_url') }}"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="nice-items">
                        <div class="nice-select" tabindex="0">
                            <span class="current">
                                USD
                            </span>
                            <ul class="list">
                                <li data-value="1" class="option selected focus">
                                    EURO
                                </li>
                                <li data-value="1" class="option">
                                    CNY
                                </li>
                                <li data-value="1" class="option">
                                    BSD
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Area Start -->
    <header class="header-section-1">
        <div id="header-sticky" class="header-1">
            <div class="container-fluid">
                <div class="mega-menu-wrapper">
                    <div class="header-main">
                        <div class="header-left">
                            <div class="logo">
                                <a href="index.html" class="header-logo">
                                    <img src="{{ asset('images/config/'.config('app.logo')) }}" alt="logo-img" style="width: 165px;">
                                </a>
                            </div>
                        </div>
                        <div class="mean__menu-wrapper">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li class="has-dropdown active menu-thumb">
                                            <a href="{{url('/')}}">
                                            Home 
                                            </a>
                                        </li>
                                        <li class="has-dropdown active d-xl-none">
                                            <a href="{{url('/')}}" class="border-top-none">
                                            Home
                                            <i class="fas fa-angle-down"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('about-us')}}">About Us</a>
                                        </li>
                                        <li>
                                            <a href="{{url('our-services')}}"> Services </a>
                                        </li>
                                         @if(Auth::check())
                                         <li>
                                            <a href="{{url('shop')}}">Add Order</a>
                                        </li>
                                        @else
                                         <li><a href="{{url('shop')}}">Add Order</a></li>
                                        @endif
                                        <li>
                                            <a href="{{url('/Articales')}}">
                                                Articles
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('contact-us')}}">Contact</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                           @php
            $profile = 'images/user-1.svg';
            if(!Auth::check()) {
                $profile = 'images/user-1.svg';
            }
            else
            if (Auth::user()->gender == 'Female') {
                $profile = 'images/user-2.svg';
            }
        @endphp
                       <div class="header-right d-flex justify-content-end align-items-center">
    <a href="#0" class="search-trigger search-icon"><i class="fal fa-search"></i></a>
    
    @if(!Auth::check())
        <a href="{{ url('login') }}" class="user-icon"><i class="far fa-user"></i></a>
    @else
        @if(Auth::user()->role_id == 4)
            <div class="dropdown user-dropdown">
                <a href="#" class="user-icon dropdown-toggle d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('images/profile/' . Auth::user()->image) }}" 
                         onerror="this.onerror=null;this.src='{{ asset($profile ?? 'front/assets/img/default-avatar.png') }}';" 
                         alt="User" 
                         class="rounded-circle bg-primary p-1" 
                         style="height: 40px; width: 40px;">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('myprofile') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ url('login') }}" class="user-icon"><i class="far fa-user"></i></a>
        @endif
    @endif
    
    <div class="header__hamburger d-xl-none my-auto">
        <div class="sidebar__toggle">
            <img src="{{ asset('front/assets/img/toggle.svg') }}" alt="img">
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Sidebar Area Here -->
    <div id="targetElement" class="side_bar slideInRight side_bar_hidden">
        <div class="side_bar_overlay"></div>
        <div class="cart-title mb-50">
            <h4>Shopping cart</h4>
        </div>
        <div class="cartmini__widget">
            <div class="cartmini__widget-item">
                <div class="cartmini__thumb">
                    <a href="product-details.html">
                   <img src="{{ asset('front/assets/img/header/product-1.jpg') }}" alt="img">
                </a>
                </div>
                <div class="cartmini__content">
                    <h5><a href="product-details.html">Level Bolt Smart Lock</a></h5>
                    <div class="cartmini__price-wrapper">
                        <span class="cartmini__price">$46.00</span>
                        <span class="cartmini__quantity">x2</span>
                    </div>
                </div>
                <button class="cartmini__del"><i class="fal fa-times"></i></button>
            </div>
            <div class="cartmini__widget-item">
                <div class="cartmini__thumb">
                    <a href="product-details.html">
                        <img src="{{ asset('front/assets/img/header/product-2.jpg') }}" alt="img">
                    </a>
                </div>
                <div class="cartmini__content">
                    <h5><a href="product-details.html">Trademil for younger</a></h5>
                    <div class="cartmini__price-wrapper">
                        <span class="cartmini__price">$78.00</span>
                        <span class="cartmini__quantity">x1</span>
                    </div>
                </div>
                <button class="cartmini__del"><i class="fal fa-times"></i></button>
            </div>
            <div class="cartmini__widget-item">
                <div class="cartmini__thumb">
                    <a href="product-details.html">
                        <img src="{{ asset('front/assets/img/header/product-3.jpg') }}" alt="img">
                    </a>
                </div>
                <div class="cartmini__content">
                    <h5><a href="product-details.html">ViewSonic VP2756-2K</a></h5>
                    <div class="cartmini__price-wrapper">
                        <span class="cartmini__price">$98.00</span>
                        <span class="cartmini__quantity">x3</span>
                    </div>
                </div>
                <button class="cartmini__del"><i class="fal fa-times"></i></button>
            </div>
            <div class="cartmini__checkout">
                <div class="cartmini__checkout-title mb-4">
                    <h4>Subtotal:</h4>
                    <span>$113.00</span>
                </div>
                <div class="cartmini__checkout-btn">
                    <a href="shop-cart.html" class="theme-btn mb-2 w-100"> view cart</a>
                    <a href="checkout.html" class="theme-btn w-100 style-2"> checkout</a>
                </div>
            </div>
        </div>
        <button id="closeButton" class="x-mark-icon"><i class="fas fa-times"></i></button>
    </div>

    <!-- Search Area Start -->
    <div class="search-wrap">
        <div class="search-inner">
            <i class="fas fa-times search-close" id="search-close"></i>
            <div class="search-cell">
                <form method="get">
                    <div class="search-field-holder">
                        <input type="search" class="main-search-input" placeholder="Search...">
                    </div>
                </form>
            </div>
        </div>
    </div>