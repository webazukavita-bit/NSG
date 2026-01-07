{{-- @extends('auth.layouts.app')
@section('content')
    <div class="text-center mb-4">
        <p class="mb-0">Please log in to your account</p>
    </div>
    <div class="form-body">        
        <form class="row g-3" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"placeholder="Enter username" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <div class="input-group" id="show_hide_password">
                    <input id="password" type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="current-password">
                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                </div>
            </div>
            <div class="col-md-6 text-end">	<a href="{{ route('password.request') }}">Forgot Password ?</a>
            </div>
            <div class="col-12">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
            <div class="col-12">
                <div class="text-center ">
                    <p class="mb-0">Don't have an account yet? <a href="{{ route('register') }}">Register here</a>
                    </p>
                </div>
            </div>
        </form>
    </div>					
@endsection --}}
@extends('front.layouts.app')
@section('content')
 <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{asset('front/assets/img/breadcrumb.png')}}');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Sign In</h1>
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                        <li>
                            <a href="{{url('/')}}}">
                            Home
                            </a>
                        </li>
                        <li>
                            <i class="fal fa-minus"></i>
                        </li>
                        <li>
                            Sign In
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign In Section Start -->
    <section class="signin-area section-paddings">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-7">
                <div class="signin-item">
                    <h3>Sign In to Your Account</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <!-- Email Field -->
                        <label for="email">Email</label>
                        <input id="email" 
                               type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Enter your email here"
                               required 
                               autocomplete="email" 
                               autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        <!-- Password Field -->
                        <label for="password">Password</label>
                        <input id="password" 
                               type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" 
                               placeholder="Enter your password"
                               required 
                               autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        <!-- Remember Me Checkbox -->
                        <div class="remember-forgot">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="remember" 
                                       id="remember" 
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" class="theme-btn w-100 text-center">Sign in</button>
                    </form>
                    
                    <div class="info text-center">
                        <p class="line1">Or <a href="{{ route('password.request') }}">Forgot Password?</a></p>
                        <p class="line2">Don't have an account? <a href="{{ route('register') }}">SIGN UP</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Cta Section Start -->
    {{-- <section class="cta-section-3">
        <div class="container">
            <div class="cta-wrapper-3 bg-cover" style="background-image: url({{asset('front/assets/img/cta-bg-3.jpg')}});">
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
@endsection