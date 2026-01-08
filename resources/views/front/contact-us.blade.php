@extends('front.layouts.app')

@section('content')
	<!-- Breadcrumb Section Start -->
	 <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url({{ asset('front/assets/img/breadcrumb.png') }});">
                    <div class="container">
                        <div class="page-heading">
                            <div class="breadcrumb-sub-title text-center">
                                <h1 class="wow fadeInUp" data-wow-delay=".3s">Contact Us</h1>
                                <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                                    <li>
                                        <a href="{{ url('/') }}">
                                        Home
                                        </a>
                                    </li>
                                    <li>
                                        <i class="fal fa-minus"></i>
                                    </li>
                                    <li>
                                        Contact Us
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Contact Info Section Start -->
                <section class="contact-page-wrap section-paddings">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-contact-card card1">
                                <div class="top-part">
                                    <div class="icon">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="title">
                                        <h4>Email Address</h4>
                                        <span>Sent mail asap anytime</span>
                                    </div>
                                </div>
                                <div class="bottom-part">                            
                                    <div class="info">
                                        <p><a href="https://modinatheme.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="bad3d4dcd5fadfc2dbd7cad6df94d9d5d7">{{ config('app.email_account') }}</a></p>
                                      
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-contact-card card2">
                                <div class="top-part">
                                    <div class="icon">
                                        <i class="fal fa-phone"></i>
                                    </div>
                                    <div class="title">
                                        <h4>Phone Number</h4>
                                        <span>call us asap anytime</span>
                                    </div>
                                </div>
                                <div class="bottom-part">                            
                                    <div class="info">
                                        <p>{{ config('app.contact_us') }}</p>
                                        {{-- <p>{{ config('app.contact_us') }}</p> --}}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-contact-card card3">
                                <div class="top-part">
                                    <div class="icon">
                                        <i class="fal fa-map-marker-alt"></i>
                                    </div>
                                    <div class="title">
                                        <h4>Office Address</h4>
                                        <span>Sent mail asap anytime</span>
                                    </div>
                                </div>
                                <div class="bottom-part">                            
                                    <div class="info">
                                        <p>{{ config('app.address') }}</p>
                                        {{-- <p>{{ config('app.address') }}</p> --}}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </section>
            
                <!-- Contact Section Start -->
                <section class="contact-section-2 fix section-padding pt-0">
                    <div class="container">
                        <div class="contact-form-items">
                            <div class="title text-center">
                                <h2 class="split-text right">Let’s Get in Touch</h2>
                                <p>Your email address will not be published. Required fields are marked *</p>
                            </div>
                            <form action="{{url('contact-submit')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                 @endif
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('error') }}
                                        </div>
                                    @endif
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="form-clt">
                                            <input type="text" name="name" id="name" placeholder="Your Name*">
                                        </div>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-clt">
                                            <input type="text" name="email" id="email" placeholder="Your Email*">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-clt">
                                            <input type="text" name="phone" id="phone" placeholder="phone*">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                      <div class="col-lg-6">
                                        <div class="form-clt">
                                            <input type="text" name="subject" id="subject" placeholder="Subject*">
                                            @error('subject')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-clt">
                                            <textarea name="message" id="message" placeholder="Write Message*"></textarea>
                                            @error('message')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <button type="submit" class="theme-btn">
                                            SEND YOUR MEASSAGE
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            
                <!-- Map Section Start -->
                <div class="office-google-map-wrapper wow fadeInUp">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6678.7619084840835!2d144.9618311901502!3d-37.81450084255415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642b4758afc1d%3A0x3119cc820fdfc62e!2sEnvato!5e0!3m2!1sen!2sbd!4v1641984054261!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            
	
	@endsection
@push('scripts')

@endpush