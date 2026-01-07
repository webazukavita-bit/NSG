@extends('front.layouts.app')
@section('content')
 <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url({{ asset('front/assets/img/breadcrumb.png') }});">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Service Details</h1>
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
                            Service Details
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

     <!-- service Section Start -->
     <section class="service-details-section fix section-padding section-bg-2">
        <div class="container">
           <div class="service-details-wrapper">
               <div class="row g-5">
                   <div class="col-lg-8">
                       <div class="service-details-image">
                           <img src="{{ asset('front/assets/img/digital-print-services.png') }}" alt="img">
                       </div>
                       <div class="service-details-content">
                           <h3>Any type of Printing Design & Service</h3>
                           <p class="mt-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat qui ducimus illum modi?  perspiciatis
                                accusamus soluta perferendis, ad illum, nesciunt, reiciendis iusto et cupidit Repudiandae provident to
                                consectetur, sapiente, libero iure necessitatibus corporis nulla voluptate, quisquam aut perspiciatis?
                                Fugiat labore aspernatur eius, perspiciatis ut molestiae, delectus rem.
                            </p>
                               <h3 class="mt-5">Sed ut perspiciatis unde omnis iste natus et</h3>
                               <p class="mt-3">
                                   Need something changed or is there something not quite working the way you envisaged? Is your van a
                                   little old and tired and need refreshing? Lorem Ipsum is simply dummy text of the printing and typesetting
                                   industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an
                                   unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                   only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                               </p>
                               <div class="service-details-video">
                                   <div class="row g-4 align-items-center">
                                       <div class="col-lg-6">
                                           <div class="video-image">
                                               <img src="{{ asset('front/assets/img/service/details-2.jpg') }}" alt="img">
                                               <div class="video-box">
                                                   <a href="https://www.youtube.com/watch?v=Cn4G2lZ_g2I" class="video-btn ripple video-popup">
                                                       <i class="fas fa-play"></i>
                                                   </a>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-6">
                                           <div class="details-video-content">
                                               <ul>
                                                   <li>
                                                        <i class="far fa-check"></i>
                                                        Research beyond the business plan
                                                   </li>
                                                   <li>
                                                        <i class="far fa-check"></i>
                                                         Marketing options and rates
                                                   </li>
                                                   <li>
                                                        <i class="far fa-check"></i>
                                                        Sit amet tempor mi auctor nec.
                                                   </li>
                                                    <li>
                                                        <i class="far fa-check"></i>
                                                        Pellentesque aliquet est massa, sit
                                                    </li>
                                                    <li>
                                                        <i class="far fa-check"></i>
                                                        Pellentesque aliquet est massa, sit
                                                    </li>
                                               </ul>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <p>
                                   There are many variations of passages of lorem ipsum is simply free text available in the market, but the
                                   majority time you put aside to be in our office. Lorem ipsum dolor sit amet, consectetLorem ipsum dolor sit
                                   amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                            </p>
                            <div class="highlight-text">
                                <h5>
                                    Business is the activity of making one's living or making money by produ The NDIS <br>
                                    Cing or buying and selling products akes a lifetime</h5>
                            </div>
                            <p class="mt-4">
                                There are many variations of passages of lorem ipsum is simply free text available in the market, but the
                                majority time you put aside to be in our office. Lorem ipsum dolor sit amet, consectetLorem ipsum dolor sit
                                amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua.
                            </p>
                            <h3 class="mt-4">Printing Process</h3>
                            <p class="mt-3">
                                There are many variations of passages of lorem ipsum is simply free text available in the market, but the
                                majority time you put aside to be in our office. Lorem ipsum dolor sit amet, consectetLorem ipsum dolor sit
                                amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua.
                            </p>
                            <h3 class="mt-5 mb-4">Frequntly Asked Any Questions</h3>
                            <div class="faq-wrapper">
                                <div class="faq-content style-2">
                                    <div class="faq-accordion">
                                        <div class="accordion" id="accordion">
                                            <div class="accordion-item mb-4 wow fadeInUp" data-wow-delay=".3s">
                                                <h5 class="accordion-header">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                                       <span>1.</span> I'm a total beginner. Can I still follow along?
                                                    </button>
                                                </h5>
                                                <div id="faq1" class="accordion-collapse show" data-bs-parent="#accordion">
                                                    <div class="accordion-body">
                                                        It is a long established fact that a reader will be distr acted bioiiy the rea dablea content of a page when looking at its layout  Thoiie point of the most useful that is so beauiful
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item mb-4 wow fadeInUp" data-wow-delay=".5s">
                                                <h5 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                                        <span>2.</span>What Let your interior tell your story?
                                                    </button>
                                                </h5>
                                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                                    <div class="accordion-body">
                                                        It is a long established fact that a reader will be distr acted bioiiy the rea dablea content of a page when looking at its layout  Thoiie point of the most useful that is so beauiful
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item mb-4 wow fadeInUp" data-wow-delay=".7s">
                                                <h5 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                                       <span>3.</span> What do Logical Drives do?
                                                    </button>
                                                </h5>
                                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                                    <div class="accordion-body">
                                                        It is a long established fact that a reader will be distr acted bioiiy the rea dablea content of a page when looking at its layout  Thoiie point of the most useful that is so beauiful
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                   </div>
                    <div class="col-lg-4">
                        <div class="service-sidebar">
                            <div class="service-widget-categories">
                                <h4>Service Offer</h4>
                                <ul>
                                    <li><a href="javascript:void(0)">Data Visualization  </a> <span><i class="far fa-long-arrow-right"></i></span></li>
                                    <li><a href="javascript:void(0)">Product Development </a> <span><i class="far fa-long-arrow-right"></i></span></li>
                                    <li class="active"><a href="javascript:void(0)">Security System </a><span><i class="far fa-long-arrow-right"></i></span></li>
                                    <li><a href="javascript:void(0)">UI/UX Designing </a> <span><i class="far fa-long-arrow-right"></i></span></li>
                                    <li><a href="javascript:void(0)">Package Crafting Desgin </a> <span><i class="far fa-long-arrow-right"></i></span></li>
                                    <li><a href="javascript:void(0)">Priority Transportation </a> <span><i class="far fa-long-arrow-right"></i></span></li>
                                </ul>
                            </div>
                            <div class="contact-bg text-center bg-cover" style="background-image: url({{ asset('front/assets/img/service/contact-bg.jpg') }});">
                                <div class="icon">
                                    <i class="far fa-phone-alt"></i>
                                </div>
                                <h3>
                                    Looking for <br>
                                    printing service <br>
                                    Provider?
                                </h3>
                                <p>Call anytime</p>
                                <a href="tel:+2871382023" class="theme-btn w-100">
                                   {{ config('app.contact_us') }}
                                </a>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
        </div>
    </section>
   
    {{-- <!-- Cta Section Start -->
    <section class="cta-section-3">
        <div class="container">
            <div class="cta-wrapper-3 bg-cover" style="background-image: url('assets/img/cta-bg-3.jpg');">
                <div class="cta-content">
                    <h2 class="split-text right">
                        Ready to Create Some <br>
                        Custome Products?
                    </h2>
                    <a href="contact.html" class="theme-btn wow fadeInUp" data-wow-delay=".5s">Contact Us</a>
                </div>
                <div class="cta-shape wow fadeInUp" data-wow-delay=".3s"> 
                    <img src="assets/img/cta-2-shape2.png" alt="img">
                </div>
            </div>
        </div>
    </section> --}}
@endsection