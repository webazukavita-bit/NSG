@extends('front.layouts.app')

@section('content')
	<!-- Page Header Start -->
	
	{{-- <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url({{asset('front/assets/img/breadcrumb.png')}});">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">{{$data->title}}</h1>
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                        <li>
                            <a href="{{ route('home') }}">
                            Home
                            </a>
                        </li>
                        <li>
                            <i class="fal fa-minus"></i>
                        </li>
                        <li>
                          {{ $data->title }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
	<!-- Page Header End -->
	<!-- Counter Section Start -->
	<div class="our-process" style="padding: 50px 0; background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);">
	<div class="container" style="max-width: 1100px; margin: 0 auto; ">
		<div class="section-title" style="margin-bottom: 20px;" >
			<h2 class="text-anime" style="display: block;">
				<div class="line" style="display: block; text-align: center; width: 100%;">
					@foreach(explode(' ', $data->title) as $word)
						<div class="word" style="display: inline-block;">
							@foreach(str_split($word) as $char)
								<div class="char text-anime"
									style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0,0); font-size: 2.5rem; font-weight: 700; color: #f62a42;">
									{{ $char }}
								</div>
							@endforeach
						</div>
						{{-- space between words --}}
						&nbsp;
					@endforeach
				</div>
			</h2>
		</div>
		<div style="background: rgb(250, 253, 252); padding: 50px; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);  line-height: 1.8; color: #4a5568; font-size: 1.1rem;">
			{!! $data->desc !!}
		</div>
	</div>
</div>
@endsection
@push('scripts')

@endpush