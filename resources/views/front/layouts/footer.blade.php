<footer class="footer-section bg-cover" style="background-image: url('{{asset('front/assets/img/footer-bg.png')}}');">
        <div class="container">
            <div class="footer-widgets-wrapper">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <a href="{{ url('/') }}" class="footer-logo">
                                    <img src="{{ asset('images/config/'.config('app.logo')) }}" alt="logo-img" style="width: 165px;">
                                </a>
                            </div>
                            <div class="footer-content">
                                <div class="contact-info-area">
                                    <div class="contact-items">
                                        <div class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="content">
                                            <p>Address</p>
                                            <h4>{{ config('app.address') }}</h4>
                                        </div>
                                    </div>
                                    <div class="contact-items">
                                        <div class="icon">
                                            <i class="fas fa-phone-alt"></i>
                                        </div>
                                        <div class="content">
                                            <p>
                                                Phone Number</p>
                                            <h4><a href="javascript:void(0)">{{ config('app.contact_us') }} </a></h4>
                                        </div>
                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-md-6 col-lg-4 ps-lg-5 wow fadeInUp" data-wow-delay=".4s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <h3>Usefull Links</h3>
                            </div>
                            <ul class="list-items">
                                 <li>
                                    <a href="{{url('/about-us')}}">
                                        About us
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('/contact-us')}}">
                                        Contact us
                                    </a>
                                </li>
                               
                                <li>
                                    <a href="{{url('services')}}">
                                        Services
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('blog')}}">
                                        Blogs
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('/terms-and-conditions')}}">
                                        Terms &amp; Services
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-md-6 col-lg-4 ps-lg-2 wow fadeInUp" data-wow-delay=".6s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <h3>More Servicve</h3>
                            </div>
                            <ul class="list-items">
                                <li>
                                    <a href="{{ url('services') }}">
                                        Digital Printing
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('services') }}">
                                        3d Printing
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('services') }}">
                                        Ofset Printing
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('services') }}">
                                        Logo Design
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('services') }}">
                                        Card Printing
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".8s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <h3>Newsletter</h3>
                            </div>
                            <div class="footer-content">
                                <p>Send us a newsletter to get update</p>
                                <div class="footer-input">
                                    <input type="email" id="email" placeholder="Your Email">
                                    <button class="newsletter-btn" type="submit">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                              
                                <div class="social-icon d-flex align-items-center">
                                    <a href="{{ config('app.facebook_url') }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ config('app.twitter_url') }}"><i class="fab fa-twitter"></i></a>
                                    <a href="{{ config('app.instagram_url') }}"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ config('app.linkedin_url') }}"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-wrapper">
                    <p class="wow fadeInUp" data-wow-delay=".3s">Copyright 2026 © . All rights reserved.</p>
                    <img src="{{asset('front/assets/img/card.png')}}" alt="img" class="wow fadeInUp" data-wow-delay=".5s">
                </div>
            </div>
        </div>
    </footer>

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="{{asset('front/assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('front/assets/js/viewport.jquery.js')}}"></script>
    <script src="{{asset('front/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('front/assets/js/gsap/gsap.js')}}"></script>
    <script src="{{asset('front/assets/js/gsap/gsap-scroll-to-plugin.js')}}"></script>
    <script src="{{asset('front/assets/js/gsap/gsap-scroll-smoother.js')}}"></script>
    <script src="{{asset('front/assets/js/gsap/gsap-scroll-trigger.js')}}"></script>
    <script src="{{asset('front/assets/js/gsap/gsap-split-text.js')}}"></script>
    <script src="{{asset('front/assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('front/assets/js/jquery.waypoints.js')}}"></script>
    <script src="{{asset('front/assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('front/assets/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('front/assets/js/jquery.meanmenu.min.js')}}"></script>
    <script src="{{asset('front/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('front/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('front/assets/js/main.js')}}"></script>
        {{-- <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"version":"2024.11.0","token":"90f7972af14a48b4add7da2b74f5d675","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script> --}}