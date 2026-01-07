@extends('front.layouts.app')

@section('content')
	 <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{asset('front/assets/img/breadcrumb.png')}}');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">blog details</h1>
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
                             blog details
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--<< Blog Wrapper Here >>-->
    <section class="blog-wrapper news-wrapper section-padding">
        <div class="container">
            <div class="news-area">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="blog-post-details border-wrap mt-0">
                            <div class="single-blog-post post-details mt-0">
                                <div class="post-content pt-0">
                                    <h2 class="mt-0">The whimsically named Egg Canvas brainchild</h2>
                                    <div class="post-meta mt-3">
                                        <span><i class="fal fa-user"></i>Shikhon .Ha</span>
                                        <span><i class="fal fa-comments"></i>15 Comments</span>
                                        <span><i class="fal fa-calendar-alt"></i>4th February 2025</span>
                                    </div>
                                    <p>
                                        With worldwide annual spend on digital advertising surpassing $325 billion, it’s no surprise that different 
                                        approaches to online marketing are becoming available. One of these new approaches is performance marketing 
                                        or digital performance marketing. Keep reading to learn all about performance marketing, from how it works 
                                        to how it compares to digital marketing. Plus, get insight into the benefits and risks of performance 
                                        marketing and how it can affect your company’s long-term success and profitability. 
                                    </p>
                                    <p>
                                        With worldwide annual spend on digital advertising surpassing $325 billion, it’s no surprise that different 
                                        approaches to online marketing are becoming available. One of these new approaches is performance marketing 
                                        or digital performance marketing. Keep reading to learn all about performance marketing, from how it works 
                                        to how it compares to digital marketing. Plus, get insight into the benefits and risks of performance 
                                        marketing and how it can affect your company’s long-term success and profitability. 
                                    </p>
                                    <img src="{{asset('front/assets/img/news/post-4.jpg')}}" alt="blog__img" class="single-post-image">
                                    <h2>You Should Experience Agency At Least Once In Your Lifetime And Here's Why.</h2>
                                    <p>
                                        Performance marketing is an approach to digital marketing or advertising where businesses only pay when a 
                                        specific result occurs. This result could be a new lead, sale, or other outcome agreed upon by the advertiser 
                                        and business. Performance marketing involves channels such as affiliate marketing, online advertising.
                                    </p>
                                    <blockquote>
                                        Diam luctus nostra dapibus varius et semper semper rutrum ad risus felis
                                        eros. Cursus libero viverra tempus netus diam vestibulum
                                    </blockquote>
                                    <p>
                                        With worldwide annual spend on digital advertising surpassing $325 billion, it’s no surprise that different 
                                        approaches to online marketing are becoming available. One of these new approaches is performance marketing 
                                        or digital performance marketing. Keep reading to learn all about performance marketing
                                    </p>
                                    <ul class="checked-list mb-4">
                                        <li>Cooking is love made visible</li>
                                        <li>We’re an open book</li>
                                        <li>100% goes to the field</li>
                                        <li>Received the highest grades</li>
                                    </ul>
                                    <h4>Our G7 Certification Means You’ll Get</h4>
                                    <p>
                                        With worldwide annual spend on digital advertising surpassing $325 billion, it’s no surprise that different 
                                        approaches to online marketing are becoming available. One of these new approaches is performance marketing 
                                        or digital performance marketing. Keep reading to learn all about performance marketing, from how it works 
                                        to how it compares to digital marketing. Plus, get insight into the benefits and risks of performance 
                                        marketing and how it can affect your company’s long-term success and profitability.
                                    </p>
                                    <img class="alignleft" src="{{asset('front/assets/img/news/post-5.jpg')}}" alt="blog__img">
                                    <p>
                                        With worldwide annual spend on digital advertising surpassing $325 billion, it’s no surprise that different 
                                        approaches to online marketing are becoming available. One of these new approaches is performance marketing 
                                        or digital performance marketing. Keep reading to learn all about performance marketing
                                    </p>
                                    <p>
                                        With worldwide annual spend on digital advertising surpassing $325 billion, it’s no surprise that different 
                                        approaches to online marketing are becoming available. One of these new approaches is performance marketing 
                                        or digital performance marketing. Keep reading to learn all about performance marketing
                                    </p>
                                </div>
                            </div>
                            <div class="row tag-share-wrap">
                                <div class="col-lg-8 col-12">
                                    <h4>Releted Tags</h4>
                                    <div class="tagcloud">                                   
                                        <a href="{{url('blog-details')}}">Healthy</a>
                                        <a href="{{url('blog-details')}}">Make Up</a>
                                        <a href="{{url('blog-details')}}">Skin Solution</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mt-3 mt-lg-0 text-lg-end">
                                    <h4>Social Share</h4>
                                    <div class="social-share">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>                                    
                                    </div>
                                </div>
                            </div>
                            <!-- comments section wrap start -->
                            <div class="comments-section-wrap pt-40">
                                <div class="comments-heading">
                                    <h3>03 Comments</h3>
                                </div>
                                <ul class="comments-item-list">
                                    <li class="single-comment-item">
                                        <div class="author-img">
                                            <img src="{{asset('front/assets/img/news/author_img2.jpg')}}" alt="img">
                                        </div>
                                        <div class="author-info-comment">
                                            <div class="info">
                                                <h5><a href="#">Rosalina Kelian</a></h5>
                                                <span>19th May 2025</span>
                                                <a href="#" class="theme-btn minimal-btn"><i class="fal fa-reply"></i>Reply</a>
                                            </div>
                                            <div class="comment-text">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna. Ut enim ad minim veniam, quis nostrud  laboris nisi ut aliquip ex ea commodo consequat.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="single-comment-item">
                                        <div class="author-img">
                                            <img src="{{asset('front/assets/img/news/author_img3.jpg')}}" alt="img">
                                        </div>
                                        <div class="author-info-comment">
                                            <div class="info">
                                                <h5><a href="#">Arista Williamson</a></h5>
                                                <span>21th Feb 2025</span>
                                                <a href="#" class="theme-btn minimal-btn"><i class="fal fa-reply"></i>Reply</a>
                                            </div>
                                            <div class="comment-text">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco nisi ut aliquip ex ea commodo consequat.</p>
                                            </div>
                                        </div>
                                        <ul class="replay-comment">
                                            <li class="single-comment-item">
                                                <div class="author-img">
                                                    <img src="{{asset('front/assets/img/news/author_img4.jpg')}}" alt="img">
                                                </div>
                                                <div class="author-info-comment">
                                                    <div class="info">
                                                        <h5><a href="#">Salman Ahmed</a></h5>
                                                        <span>29th Jan 2021</span>
                                                        <a href="#" class="theme-btn minimal-btn"><i class="fal fa-reply"></i>Reply</a>
                                                    </div>
                                                    <div class="comment-text">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam..</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="comment-form-wrap d-block pt-5">

                                <h3>Post Comment</h3>
                                <form action="#" class="comment-form">
                                    <div class="single-form-input">
                                        <textarea placeholder="Type your comments...."></textarea>
                                    </div>
                                    <div class="single-form-input">
                                        <input type="text" placeholder="Type your name....">
                                    </div>
                                    <div class="single-form-input">
                                        <input type="email" placeholder="Type your email....">
                                    </div>
                                    <div class="single-form-input">
                                        <input type="text" placeholder="Type your website....">
                                    </div>
                                    <button class="theme-btn center" type="submit">
                                         <span><i class="fal fa-comments"></i>Post Comment</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="main-sidebar">
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h3>Search</h3>
                                </div>
                                <div class="search_widget">
                                    <form action="#">
                                        <input type="text" placeholder="Keywords here....">
                                        <button type="submit"><i class="fal fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h3>Popular Feeds</h3>
                                </div>
                                <div class="popular-posts">
                                    <div class="single-post-item">
                                        <div class="thumb bg-cover" style="background-image: url({{asset('front/assets/img/news/pp1.jpg')}});"></div>
                                        <div class="post-content">
                                            <h5><a href="{{url('blog-details')}}">
                                                Keep Your Business Safe Ensure High</a></h5>
                                            <div class="post-date">
                                                <i class="far fa-calendar-alt"></i>24th March 2025
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-post-item">
                                        <div class="thumb bg-cover" style="background-image: url({{asset('front/assets/img/news/pp2.jpg')}});"></div>
                                        <div class="post-content">
                                            <h5><a href="{{url('blog-details')}}">We’ve Been a Strategy Thought Leader for Nearly</a></h5>
                                            <div class="post-date">
                                                <i class="far fa-calendar-alt"></i>25th March 2025
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-post-item">
                                        <div class="thumb bg-cover" style="background-image: url({{asset('front/assets/img/news/pp3.jpg')}});"></div>
                                        <div class="post-content">
                                            <h5><a href="{{url('blog-details')}}">
                                                This Week’s Top Stories About It</a></h5>
                                            <div class="post-date">
                                                <i class="far fa-calendar-alt"></i>26th March 2025
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h3>Categories</h3>
                                </div>
                                <div class="widget_categories">
                                    <ul>
                                        <li><a href="news.html">Data Visualization  <span>02</span></a></li>
                                        <li><a href="news.html">Product Development  <span>06</span></a></li>
                                        <li><a href="news.html">Security System  <span>11</span></a></li>
                                        <li><a href="news.html">UI/UX Designing  <span>05</span></a></li>
                                        <li><a href="news.html">Digital Marketing  <span>06</span></a></li>
                                        <li><a href="news.html">Data Analytics  <span>10</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h3>Never Miss News</h3>
                                </div>
                                <div class="social-link">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h3>Popular Tags</h3>
                                </div>
                                <div class="tagcloud">
                                    <a href="{{url('blog-details')}}">symphony</a>     
                                    <a href="{{url('blog-details')}}">nokia</a>
                                    <a href="{{url('blog-details')}}">tech</a>
                                    <a href="{{url('blog-details')}}">Samsung</a>
                                    <a href="{{url('blog-details')}}">Alcatel</a>
                                    <a href="{{url('blog-details')}}">mous</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

@endpush