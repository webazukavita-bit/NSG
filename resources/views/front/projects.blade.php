@extends('front.layouts.app')

@section('content')
	<!-- Page Header Start -->
	<div class="page-header parallaxie">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Page Header Box Start -->
					<div class="page-header-box">
						<h1 class="text-anime">Our Projects</h1>
						<nav class="wow fadeInUp" data-wow-delay="0.25s">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
								<li class="breadcrumb-item"><a href="javascript:;">></a></li>
								<li class="breadcrumb-item active" aria-current="page">Projects</li>
							</ol>
						</nav>
					</div>
					<!-- Page Header Box End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header End -->

	<!-- Our Projects Page Start -->
	<div class="our-projects">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<!-- Project Item Start -->
					<div class="project-item wow fadeInUp" data-wow-delay="0.25s">
						<div class="project-image">
							<figure>
								<img src="{{ asset('assets/images/project-1.jpg') }}" alt="">
							</figure>
						</div>

						<div class="project-content">
							<h2><a href="#">Photon Fusion</a></h2>
							<p>Solar Power</p>
						</div>

						<div class="project-link">
							<a href="#"><img src="{{ asset('assets/images/icon-link.svg') }}" alt=""></a>
						</div>
					</div>
					<!-- Project Item End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Project Item Start -->
					<div class="project-item wow fadeInUp" data-wow-delay="0.5s">
						<div class="project-image">
							<figure>
								<img src="{{ asset('assets/images/project-2.jpg') }}" alt="">
							</figure>
						</div>

						<div class="project-content">
							<h2><a href="#">LuxSolar Dynamics</a></h2>
							<p>Wind Energy</p>
						</div>

						<div class="project-link">
							<a href="#"><img src="{{ asset('assets/images/icon-link.svg') }}" alt=""></a>
						</div>
					</div>
					<!-- Project Item End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Project Item Start -->
					<div class="project-item wow fadeInUp" data-wow-delay="0.75s">
						<div class="project-image">
							<figure>
								<img src="{{ asset('assets/images/project-3.jpg') }}" alt="">
							</figure>
						</div>

						<div class="project-content">
							<h2><a href="#">HelioHarbor Dynamics</a></h2>
							<p>Geothermal Energy</p>
						</div>

						<div class="project-link">
							<a href="#"><img src="{{ asset('assets/images/icon-link.svg') }}" alt=""></a>
						</div>
					</div>
					<!-- Project Item End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Project Item Start -->
					<div class="project-item wow fadeInUp" data-wow-delay="1.0s">
						<div class="project-image">
							<figure>
								<img src="{{ asset('assets/images/project-4.jpg') }}" alt="">
							</figure>
						</div>

						<div class="project-content">
							<h2><a href="#">SolarLoom Energy</a></h2>
							<p>Solar Power</p>
						</div>

						<div class="project-link">
							<a href="#"><img src="{{ asset('assets/images/icon-link.svg') }}" alt=""></a>
						</div>
					</div>
					<!-- Project Item End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Project Item Start -->
					<div class="project-item wow fadeInUp" data-wow-delay="1.25s">
						<div class="project-image">
							<figure>
								<img src="{{ asset('assets/images/project-5.jpg') }}" alt="">
							</figure>
						</div>

						<div class="project-content">
							<h2><a href="#">HelioHarbor Dynamics</a></h2>
							<p>Geothermal Energy</p>
						</div>

						<div class="project-link">
							<a href="#"><img src="{{ asset('assets/images/icon-link.svg') }}" alt=""></a>
						</div>
					</div>
					<!-- Project Item End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Project Item Start -->
					<div class="project-item wow fadeInUp" data-wow-delay="1.5s">
						<div class="project-image">
							<figure>
								<img src="{{ asset('assets/images/project-6.jpg') }}" alt="">
							</figure>
						</div>

						<div class="project-content">
							<h2><a href="#">SolarLoom Energy</a></h2>
							<p>Solar Power</p>
						</div>

						<div class="project-link">
							<a href="#"><img src="{{ asset('assets/images/icon-link.svg') }}" alt=""></a>
						</div>
					</div>
					<!-- Project Item End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Project Item Start -->
					<div class="project-item wow fadeInUp" data-wow-delay="1.75s">
						<div class="project-image">
							<figure>
								<img src="{{ asset('assets/images/project-7.jpg') }}" alt="">
							</figure>
						</div>

						<div class="project-content">
							<h2><a href="#">EcoHarbor</a></h2>
							<p>Geothermal Energy</p>
						</div>

						<div class="project-link">
							<a href="#"><img src="{{ asset('assets/images/icon-link.svg') }}" alt=""></a>
						</div>
					</div>
					<!-- Project Item End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Project Item Start -->
					<div class="project-item wow fadeInUp" data-wow-delay="2.0s">
						<div class="project-image">
							<figure>
								<img src="{{ asset('assets/images/project-8.jpg') }}" alt="">
							</figure>
						</div>

						<div class="project-content">
							<h2><a href="#">GreenVista Homes</a></h2>
							<p>Solar Power</p>
						</div>

						<div class="project-link">
							<a href="#"><img src="{{ asset('assets/images/icon-link.svg') }}" alt=""></a>
						</div>
					</div>
					<!-- Project Item End -->
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<!-- Post Pagination Start -->
					<div class="post-pagination wow fadeInUp" data-wow-delay="1.5s">
						<ul class="pagination">
							<li><a href="#"><i class="fa-solid fa-arrow-left-long"></i></a></li>
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#"><i class="fa-solid fa-arrow-right-long"></i></a></li>
						</ul>
					</div>
					<!-- Post Pagination End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Our Projects Page End -->
@endsection
@push('scripts')

@endpush