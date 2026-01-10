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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet">
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
    @stack('scripts')
</body>
</html>