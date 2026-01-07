{{-- @extends('auth.layouts.app')
@section('content')

<div class="text-center mb-4">
    <p class="mb-0">Please fill the below details to create your account</p>
</div>
<div class="form-body">
    <form class="row g-3" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="col-12">
            <label for="inputUsername" class="form-label">Username</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Username" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-12">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <div class="input-group" id="show_hide_password">
                <input id="password" type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="new-password">
                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-12">
            <label for="password-confirm" class="form-label">Confirmation Password</label>
            <div class="input-group" id="show_hide_password">
                <input id="password-confirm" type="password" class="form-control border-end-0" name="password_confirmation" placeholder="Enter Confirm Password" required autocomplete="new-password">
                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
            </div>
        </div>
        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="terms">
                <label class="form-check-label" for="terms">I read and agree to Terms & Conditions</label>
            </div>
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
        <div class="col-12">
            <div class="text-center ">
                <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </div>
    </form>
</div>
@endsection						 --}}
@extends('front.layouts.app')
@section('content')
 <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{asset('front/assets/img/breadcrumb.png')}}');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Sign Up</h1>
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
                            Sign up
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
      <section class="signup-area fix section-paddings">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-7">
                    <div class="signin-item">
                        <h3>Sign Up to Your Account</h3>
                        <form  method="POST" action="{{ route('register') }}">
                        @csrf
                            <label for="first-name">Username</label>
                            <input id="first-name" type="text" placeholder="Enter your  name "name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                              @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                            <label for="email">Email</label>
                            <input id="email" type="email" placeholder="Enter your email" name="email" value="{{ old('email') }}" required autocomplete="email">
                             @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                          <label for =" phone_number">Phone Number</label>
                            <input id="phone_number" type="text" placeholder="Enter your phone number" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>
                             @error('phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                            <label for="password">Password</label>
                            <input id="password" type="password" placeholder="Enter your password" name="password" required autocomplete="new-password">
                             @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                            <label for="confirm-password">Confirm Password</label>
                            <input id="confirm-password" type="password" placeholder="Enter your password" name="password_confirmation" required autocomplete="new-password">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label ps-2" for="flexCheckDefault">
                                    I agree to <a href="#0">Terms</a> and <a href="#0">policy</a>
                                </label>
                            </div>
                          <button type="submit" style="color: white; font-weight: bold;"  class="theme-btn mt-40 w-100 text-center">Sign up</button>
                            <span class="fs-18 text-center d-block my-4">Already have an account? <a href="{{ route('login') }}">Login here</a></span>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection