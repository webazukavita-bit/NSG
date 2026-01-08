@extends('front.layouts.app')

@section('content')
	 <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{asset('front/assets/img/breadcrumb.png')}}');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Articles details</h1>
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
                             Articles Details
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
                                    <h2 class="mt-0">{{ $blog->title }}</h2>
                                    <div class="post-meta mt-3">
                                        <span><i class="fal fa-user"></i>{{ $blog->status }}</span>
                                        {{-- <span><i class="fal fa-comments"></i></span> --}}
                                        <span><i class="fal fa-calendar-alt"></i>{{ $blog->created_at }}</span>
                                    </div>
                                    <p>
                                      {{ strip_tags($blog->content) }}

                                    </p>
                                    <img src="{{asset('images/blog/'.$blog->image)}}" alt="blog__img" class="single-post-image">
                                   
                                </div>
                            </div>
                        
                            <!-- comments section wrap start -->
                            {{-- <div class="comments-section-wrap pt-40">
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
                            </div> --}}
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
                            {{-- <div class="single-sidebar-widget">
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
                            </div> --}}
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h3>Categories</h3>
                                </div>
                                <div class="widget_categories">
                                    
                                    <ul>
                                         @foreach ($category as $cat)
                                            <li><a href="{{url('shop?category='.$cat->slug)}}">{{$cat->name}}</a></li>
                                        @endforeach
                                      
                                    </ul>
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