<!DOCTYPE html>
<html lang="en">
 
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="modinatheme">
        <meta name="description" content="Printnow - Printing Company & Design Services HTML Template">
        <title>{{ config('app.name') }}</title>
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/config/'.config('app.auth_logo')) }}">
        <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/font-awesome.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/meanmenu.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/swiper-bundle.min.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/nice-select.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/main.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">
    </head>

    <body>
        {{-- Header Section --}}
        @include('front.layouts.header')
        {{-- Main Section --}}
    <!-- Hero Section Start -->
       @yield('content')
    <!-- Hero Section End -->

    <!-- Footer Section Start -->
    @include('front.layouts.footer')
</body>
</html>