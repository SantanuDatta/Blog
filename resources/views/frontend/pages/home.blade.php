@extends('frontend.layout.template')

@section('title', 'Home')
@section('body-content')
    <!-- hero section -->
    <section class="hero-carousel">
        <div class="container-xl">
            <div class="post-carousel-lg">
                <!-- post -->
                @foreach (App\Models\Post::orderBy('id', 'desc')->where('is_featured', 1)->take(5)->get() as $lPost)
                    <div class="post featured-post-xl">
                        @php
                            $commentCount = DB::table('comments')
                                ->where('post_id', $lPost->id)
                                ->where('status', 1)
                                ->get();
                        @endphp
                        <div class="details clearfix">
                            <a class="category-badge lg">
                                @foreach (explode(',', $lPost->category_id) as $cat)
                                    @foreach (App\Models\Category::where('id', $cat)->get() as $allCat)
                                        {{ $allCat->name }}
                                    @endforeach
                                @endforeach
                            </a>
                            <h4 class="post-title"><a href="{{ route('singlePost', $lPost->slug) }}">{{ $lPost->title }}</a>
                            </h4>
                            <ul class="meta list-inline mb-0">
                                <li class="list-inline-item">by {{ $lPost->user->name }}</li>
                                <li class="list-inline-item">{{ $lPost->created_at->toFormattedDateString() }}</li>
                                <li class="list-inline-item">{{ $commentCount->count() }} Comments </li>
                            </ul>
                        </div>
                        <a href="{{ route('singlePost', $lPost->slug) }}">
                            <div class="thumb rounded">
                                @if (!is_null($lPost->image))
                                    <div class="inner data-bg-image"
                                        data-bg-image=" {{ asset('backend/img/post-images/' . $lPost->image) }}"></div>
                                @else
                                    <div class="inner data-bg-image"
                                        data-bg-image=" {{ asset('backend/img/post-images/post_default.png') }}"></div>
                                @endif

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">

            <div class="row gy-4">

                <div class="col-lg-8">

                    <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Latest Stories</h3>
                        <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
                    </div>

                    <div class="padding-30 rounded bordered">
                        <div class="row gy-5">
                            <div class="col-sm-6">
                                <!-- post -->
                                @foreach (App\Models\Post::orderBy('id', 'desc')->take(1)->get() as $post)
                                    <div class="post">
                                        <div class="thumb rounded">
                                            <a class="category-badge position-absolute">{{ $post->category->name }}</a>
                                            <span class="post-format">
                                                <i class="icon-picture"></i>
                                            </span>
                                            <a href="{{ route('singlePost', $post->slug) }}">
                                                <div class="inner">
                                                    @if (!is_null($post->image))
                                                        <img src="{{ asset('backend/img/post-images/' . $post->image) }}"
                                                            alt="post-title" />
                                                    @else
                                                        <img src="{{ asset('backend/img/post-images/post_default.png') }}"
                                                            alt="post-title" />
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                        <ul class="meta list-inline mt-4 mb-0">
                                            <li class="list-inline-item">{{ $post->user->name }}</a></li>
                                            <li class="list-inline-item">{{ $post->created_at->toFormattedDateString() }}
                                            </li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3"><a
                                                href="{{ route('singlePost', $post->slug) }}">{{ Str::limit($post->title, 50) }}</a>
                                        </h5>
                                        <p class="excerpt mb-0">{!! Str::limit(strip_tags($post->description, '<p><br>'), 150, '...') !!}</p>
                                    </div>
                                @endforeach

                            </div>
                            <div class="col-sm-6">
                                <!-- post -->
                                @foreach ($latestPosts as $lPost)
                                    @if (!$loop->first)
                                        <div class="post post-list-sm square">
                                            <div class="thumb rounded">
                                                <a href="{{ route('singlePost', $lPost->slug) }}">
                                                    <div class="inner">
                                                        @if (!is_null($lPost->image))
                                                            <img src="{{ asset('backend/img/post-images/' . $lPost->image) }}"
                                                                alt="post-title" />
                                                        @else
                                                            <img src="{{ asset('backend/img/post-images/post_default.png') }}"
                                                                alt="post-title" />
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details clearfix">
                                                <h6 class="post-title my-0"><a
                                                        href="{{ route('singlePost', $lPost->slug) }}">{{ Str::limit($lPost->title, 40) }}</a>
                                                </h6>
                                                <ul class="meta list-inline mt-1 mb-0">
                                                    <li class="list-inline-item">
                                                        {{ $lPost->created_at->toFormattedDateString() }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <!-- horizontal ads -->
                    <div class="ads-horizontal text-md-center">
                        <span class="ads-title">- Sponsored Ad -</span>
                        <a href="#">
                            <img src="{{ asset('frontend/images/ads/ad-750.png') }}" alt="Advertisement" />
                        </a>
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    @foreach ($cDetails as $category)
                        <div class="section-header">
                            <h3 class="section-title">{{ $category->name }}</h3>
                            <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
                            <div class="slick-arrows-top">
                                <button type="button" data-role="none" class="carousel-topNav-prev slick-custom-buttons"
                                    aria-label="Previous"><i class="icon-arrow-left"></i></button>
                                <button type="button" data-role="none" class="carousel-topNav-next slick-custom-buttons"
                                    aria-label="Next"><i class="icon-arrow-right"></i></button>
                            </div>
                        </div>

                        <div class="row post-carousel-twoCol post-carousel">
                            <!-- post -->
                            @foreach (App\Models\Post::orderBy('id', 'desc')->where('category_id', $category->id)->where('status', 1)->take(5)->get() as $postDetails)
                                <div class="post post-over-content col-md-6">
                                    <div class="details clearfix">
                                        @foreach (explode(',', $post->category_id) as $cat)
                                            @foreach (App\Models\Category::where('id', $cat)->get() as $allCat)
                                                <a href="{{ route('categoryPost', $allCat->slug) }}"
                                                    class="category-badge">{{ $allCat->name }}</a>
                                            @endforeach
                                        @endforeach
                                        <h4 class="post-title"><a
                                                href="{{ route('singlePost', $postDetails->slug) }}">{{ Str::limit($postDetails->title, 40) }}</a>
                                        </h4>
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item">by {{ $postDetails->user->name }}</li>
                                            <li class="list-inline-item">
                                                {{ $postDetails->created_at->toFormattedDateString() }}</li>
                                            @php
                                                $commentCount = DB::table('comments')
                                                    ->where('post_id', $postDetails->id)
                                                    ->where('status', 1)
                                                    ->get();
                                            @endphp
                                            <li class="list-inline-item">{{ $commentCount->count() }} Comments </li>
                                        </ul>
                                    </div>
                                    <a href="{{ route('singlePost', $postDetails->slug) }}">
                                        <div class="thumb rounded">
                                            <div class="inner">
                                                @if (!is_null($postDetails->image))
                                                    <img src="{{ asset('backend/img/post-images/' . $postDetails->image) }}"
                                                        alt="thumb" />
                                                @else
                                                    <img src="{{ asset('backend/img/post-images/post_default.png') }}"
                                                        alt="thumb" />
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="spacer" data-height="50"></div>
                    @endforeach


                </div>
                <div class="col-lg-4">

                    {{-- Sidebar --}}
                    @include('frontend.includes.sidebar')
                </div>

            </div>

        </div>
    </section>
@endsection
