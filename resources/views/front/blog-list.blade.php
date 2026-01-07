@extends('front.layouts.app')

@section('content')
  <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url({{asset('front/assets/img/breadcrumb.png')}});">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Articles</h1>
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                        <li>
                            <a href="{{url('/')}}">
                            Home
                            </a>
                        </li>
                        <li>
                            <i class="fal fa-minus"></i>
                        </li>
                        <li>
                            Articles
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- News Section Start -->
    <section class="news-section-section section-padding fix">
        <div class="container">
            <div class="row g-4">
                @forelse($data as $blog)
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="news-card-items mt-0">
                            <div class="news-thumb">
                                <img src="{{ $blog->image ? asset('images/blog/' . $blog->image) : asset('front/assets/img/news/04.jpg') }}" alt="{{ $blog->title }}">
                                <div class="news-date">
                                    {{-- <span>{{ $blog->created_at->format('d') }}</span>
                                    <span>{{ $blog->created_at->format('M') }}</span> --}}
                                </div>
                            </div>
                            <div class="news-content">
                                <div class="news-tag d-flex">
                                    @if($blog->category)
                                        <a href="{{ url('blog-category/' . $blog->category->slug) }}">{{ $blog->category->name }}</a>
                                    @endif
                                    @if($blog->tags)
                                        @foreach(explode(',', $blog->tags) as $tag)
                                            @if($loop->index < 2)
                                                <a href="{{ url('blog-tag/' . trim($tag)) }}">{{ trim($tag) }}</a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <h3>
                                    <a href="{{ url('blog-details/' . $blog->slug) }}">
                                        {{ Str::limit($blog->title, 60) }}
                                    </a>
                                </h3>
                                @if($blog->excerpt)
                                    <p>{{ Str::limit($blog->excerpt, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <h4>No articles found</h4>
                            <p>Please check back later for new content.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($data->hasPages())
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="pagination-wrap text-center">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection