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
                                    <a target="_blank" href="#">{{ config('app.address') }}</a>
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
                        <i class="fas fa-map-marker-alt"></i>
                        {{ config('app.address') }}
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
                                            <a href="index.html">
                                            Home 
                                            </a>
                                            <ul class="submenu has-home-menu">
                                                <li class="border-top-none">
                                                    <div class="row g-4">
                                                        <div class="col-lg-3 home-menu">
                                                            <div class="home-menu-thumb">
                                                                <img src="{{asset('front/assets/img/header/home-1.jpg')}}" alt="img">
                                                                <div class="demo-button">
                                                                    <a href="index.html" class="theme-btn">
                                                                        <span>View Demo</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="home-menu-content text-center">
                                                                <h4 class="home-menu-title">
                                                                    Home 01
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  home-menu">
                                                            <div class="home-menu-thumb mb-15">
                                                                <img src="{{asset('front/assets/img/header/home-2.jpg')}}" alt="img">
                                                                <div class="demo-button">
                                                                    <a href="index-2.html" class="theme-btn">
                                                                        <span>View Demo</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="home-menu-content text-center">
                                                                <h4 class="home-menu-title">
                                                                    Home 02
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 home-menu">
                                                            <div class="home-menu-thumb mb-15">
                                                                <img src="{{asset('front/assets/img/header/home-3.jpg')}}" alt="img">
                                                                <div class="demo-button">
                                                                    <a href="index-3.html" class="theme-btn">
                                                                        <span>View Demo</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="home-menu-content text-center">
                                                                <h4 class="home-menu-title">
                                                                    Home 03
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 home-menu">
                                                            <div class="home-menu-thumb mb-15">
                                                                <img src="{{asset('front/assets/img/header/home-4.jpg')}}" alt="img">
                                                                <div class="demo-button">
                                                                    <a href="index-4.html" class="theme-btn">
                                                                        <span>View Demo</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="home-menu-content text-center">
                                                                <h4 class="home-menu-title">
                                                                    Home 04
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="has-dropdown active d-xl-none">
                                            <a href="index.html" class="border-top-none">
                                            Home
                                            <i class="fas fa-angle-down"></i>
                                            </a>
                                            <ul class="submenu">
                                                <li><a href="index.html">Home 01</a></li>
                                                <li><a href="index-2.html">Home 02</a></li>
                                                <li><a href="index-3.html">Home 03</a></li>
                                                <li><a href="index-4.html">Home 04</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="about.html">About Us</a>
                                        </li>
                                        <li>
                                            <a href="service.html"> Services </a>
                                            <ul class="submenu">
                                                <li><a href="service-details.html">Service Details</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-dropdown active">
                                            <a href="shop.html">Shop</a>
                                            <ul class="submenu">
                                                <li><a href="shop-leftsidebar.html">Shop Left Sidebar</a></li>
                                                <li><a href="shop-rightsidebar.html">Shop Right Sidebar</a></li>
                                                <li><a href="shop-details.html">Shop Details</a></li>
                                                <li><a href="shop-cart.html">Shop Cart</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="sign-in.html">Sign In</a></li>
                                                <li><a href="sign-up.html">Sign Up</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-dropdown">
                                            <a href="news.html">
                                                Pages
                                            </a>
                                            <ul class="submenu">
                                                <li><a href="project.html">Project</a></li>
                                                <li><a href="project-details.html">Project Details</a></li>
                                                <li><a href="pricing.html">Our Pricing</a></li>
                                                <li><a href="faq.html">Faq's</a></li>
                                                <li><a href="404.html">404 Page</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="news.html">
                                                Blog
                                            </a>
                                            <ul class="submenu">
                                                <li><a href="news-grid.html">Blog Grid</a></li>
                                                <li><a href="news.html">Blog Standard </a></li>
                                                <li><a href="news-details.html">Blog Details</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="contact.html">Contact</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="header-right d-flex justify-content-end align-items-center">
                            <a href="#0" class="search-trigger search-icon"><i class="fal fa-search"></i></a>
                            <a href="sign-in.html" class="user-icon"><i class="far fa-user"></i></a>
                            <div class="menu-cart">
                                <button id="openButton" class="cart-icon">
                                    <i class="far fa-shopping-cart"></i>
                                </button>
                            </div>
                            <div class="header__hamburger d-xl-none my-auto">
                                <div class="sidebar__toggle">
                                    <img src="{{ asset('front/assets/img/toggle.svg') }}" alt="img">
                                </div>
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