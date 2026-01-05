@extends('front.layouts.app')

@section('content')
    <!-- Page Header Start -->
	<div class="page-header parallaxie">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Page Header Box Start -->
					<div class="page-header-box">
						<h1 class="text-anime">Our Services</h1>
						<nav class="wow fadeInUp" data-wow-delay="0.25s">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
								<li class="breadcrumb-item"><a href="javascript:;">></a></li>
								<li class="breadcrumb-item active" aria-current="page">Services</li>
							</ol>
						</nav>
					</div>
					<!-- Page Header Box End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header End -->

	<!-- Services List Page Start -->
	<div class="page-services">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="0.25s">
						<a href="#" class="service-box-link"></a>

						<div class="service-image">
							<figure>
								<img src="{{ asset('assets/images/service-1.jpg') }}" alt="">
							</figure>

							<div class="service-icon">
								<img src="{{ asset('assets/images/icon-service-1.svg') }}" alt="">
							</div>
						</div>

						<div class="service-content">
							<h3>Solar Maintenance</h3>
							<p>Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.</p>
						</div>
					</div>
					<!-- Service Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="0.5s">
						<a href="#" class="service-box-link"></a>

						<div class="service-image">
							<figure>
								<img src="{{ asset('assets/images/service-2.jpg') }}" alt="">
							</figure>

							<div class="service-icon">
								<img src="{{ asset('assets/images/icon-service-2.svg') }}" alt="">
							</div>
						</div>

						<div class="service-content">
							<h3>Energy Saving Devices</h3>
							<p>Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.</p>
						</div>
					</div>
					<!-- Service Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="0.75s">
						<a href="#" class="service-box-link"></a>

						<div class="service-image">
							<figure>
								<img src="{{ asset('assets/images/service-3.jpg') }}" alt="">
							</figure>

							<div class="service-icon">
								<img src="{{ asset('assets/images/icon-service-3.svg') }}" alt="">
							</div>
						</div>

						<div class="service-content">
							<h3>Solar Solutions</h3>
							<p>Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.</p>
						</div>
					</div>
					<!-- Service Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="1.0s">
						<a href="#" class="service-box-link"></a>

						<div class="service-image">
							<figure>
								<img src="{{ asset('assets/images/service-4.jpg') }}" alt="">
							</figure>

							<div class="service-icon">
								<img src="{{ asset('assets/images/icon-service-4.svg') }}" alt="">
							</div>
						</div>

						<div class="service-content">
							<h3>Solar PV Systems </h3>
							<p>Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.</p>
						</div>
					</div>
					<!-- Service Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="1.25s">
						<a href="#" class="service-box-link"></a>

						<div class="service-image">
							<figure>
								<img src="{{ asset('assets/images/service-5.jpg') }}" alt="">
							</figure>

							<div class="service-icon">
								<img src="{{ asset('assets/images/icon-service-5.svg') }}" alt="">
							</div>
						</div>

						<div class="service-content">
							<h3>Hybrid Energy</h3>
							<p>Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.</p>
						</div>
					</div>
					<!-- Service Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="1.5s">
						<a href="#" class="service-box-link"></a>

						<div class="service-image">
							<figure>
								<img src="{{ asset('assets/images/service-6.jpg') }}" alt="">
							</figure>

							<div class="service-icon">
								<img src="{{ asset('assets/images/icon-service-6.svg') }}" alt="">
							</div>
						</div>

						<div class="service-content">
							<h3>Renewable Energy</h3>
							<p>Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.</p>
						</div>
					</div>
					<!-- Service Item End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Services List Page End -->

	<!-- Infobar Section Start -->
	<div class="infobar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="cta-box">
						<div class="row align-items-center">
							<div class="col-lg-4">
								<!-- CTA Image Start -->
								<div class="cta-image">
									<figure class="image-anime">
										<img src="{{ asset('assets/images/cta-image.jpg') }}" alt="">
									</figure>
								</div>
								<!-- CTA Image End -->
							</div>

							<div class="col-lg-8">
								<!-- CTA Content Start -->
								<div class="cta-content">
									<div class="phone-icon">
										<figure>
											<img src="{{ asset('assets/images/icon-cta-phone.svg') }}" alt="">
										</figure>
									</div>									
									<h3 class="text-anime">Have Questions? <span>Call Us</span> {{ config('app.contact_us') }}</h3>
									<p class="wow fadeInUp" data-wow-delay="0.25s">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
								</div>
								<!-- CTA Content End -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Infobar Section End -->

	<!-- Why Choose us Section Start -->
	<div class="why-choose-us">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Section Title Start -->
					<div class="section-title">
						<h3 class="wow fadeInUp">Why Choose Us</h3>
						<h2 class="text-anime">Providing Solar Energy Solutions</h2>
					</div>
					<!-- Section Title End -->
				</div>
			</div>

			<div class="row">
				<div class="col-lg-3 col-md-6">
					<!-- Why Choose Item Start -->
					<div class="why-choose-item wow fadeInUp" data-wow-delay="0.25s">
						<div class="why-choose-image">
							<img src="{{ asset('assets/images/whyus-1.jpg') }}" alt="">
						</div>

						<div class="why-choose-content">
							<div class="why-choose-icon">
								<img src="{{ asset('assets/images/icon-whyus-1.svg') }}" alt="">
							</div>

							<h3>Efficiency & Power</h3>
							<p>Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.</p>
						</div>
					</div>
					<!-- Why Choose Item End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Why Choose Item Start -->
					<div class="why-choose-item wow fadeInUp" data-wow-delay="0.5s">
						<div class="why-choose-image">
							<img src="{{ asset('assets/images/whyus-2.jpg') }}" alt="">
						</div>

						<div class="why-choose-content">
							<div class="why-choose-icon">
								<img src="{{ asset('assets/images/icon-whyus-2.svg') }}" alt="">
							</div>

							<h3>Trust & Warranty</h3>
							<p>Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.</p>
						</div>
					</div>
					<!-- Why Choose Item End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Why Choose Item Start -->
					<div class="why-choose-item wow fadeInUp" data-wow-delay="0.75s">
						<div class="why-choose-image">
							<img src="{{ asset('assets/images/whyus-3.jpg') }}" alt="">
						</div>

						<div class="why-choose-content">
							<div class="why-choose-icon">
								<img src="{{ asset('assets/images/icon-whyus-3.svg') }}" alt="">
							</div>

							<h3>High Quality Work</h3>
							<p>Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.</p>
						</div>
					</div>
					<!-- Why Choose Item End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Why Choose Item Start -->
					<div class="why-choose-item wow fadeInUp" data-wow-delay="1.0s">
						<div class="why-choose-image">
							<img src="{{ asset('assets/images/whyus-4.jpg') }}" alt="">
						</div>

						<div class="why-choose-content">
							<div class="why-choose-icon">
								<img src="{{ asset('assets/images/icon-whyus-4.svg') }}" alt="">
							</div>

							<h3>24*7 Support</h3>
							<p>Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.</p>
						</div>
					</div>
					<!-- Why Choose Item End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Why Choose us Section End -->
@endsection
@push('scripts')

@endpush