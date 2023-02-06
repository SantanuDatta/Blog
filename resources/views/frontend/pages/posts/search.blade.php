@extends('frontend.layout.template')

@section('title', 'Search Post')
@section('body-content')
    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">{{ $search }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $search }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">

            <div class="row gy-4">

                <div class="col-lg-8">

                    <div class="row gy-4">
                        @foreach ($posts as $post)
                        <div class="col-sm-6">
                            <!-- post -->
                            <div class="post post-grid rounded bordered">
                                <div class="thumb top-rounded">
                                    <a class="category-badge position-absolute">
                                        @foreach (explode(",", $post->category_id) as $cat)
                                            @foreach (App\Models\Category::where('id', $cat)->get() as $allCat)
                                                {{ $allCat->name }}
                                            @endforeach
                                        @endforeach
                                    </a>
                                    <span class="post-format">
                                        <i class="icon-picture"></i>
                                    </span>
                                    <a href="{{ route('singlePost', $post->slug) }}">
                                        <div class="inner">
                                            @if (!is_null($post->image))
                                                <img src="{{ asset('backend/img/post-images/'.$post->image) }}" alt="post-title" />
                                            @else
                                                <img src="{{ asset('backend/img/post-images/post_default.png') }}" alt="post-title" />
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <div class="details">
                                    <ul class="meta list-inline mb-0">
                                        <li class="list-inline-item">by {{ $post->user->name }}</li>
                                        <li class="list-inline-item">{{ $post->created_at->toFormattedDateString() }}</li>
                                    </ul>
                                    <h5 class="post-title mb-3 mt-3"><a href="{{ route('singlePost', $post->slug) }}">{{ Str::limit($post->title, 40) }}</a></h5>
                                    <p class="excerpt mb-0">{!! Str::limit(strip_tags($post->description, '<p><br>'), 150, '...') !!}</p>
                                </div>
                                <div class="post-bottom clearfix d-flex align-items-center">
                                    <div class="social-share me-auto">
                                        <ul class="list-unstyled list-inline mb-0">
                                            @php
                                                $commentCount = DB::table('comments')->where('post_id', $post->id)->where('status', 1)->get();
                                            @endphp
                                            <li class="list-inline-item">{{ $commentCount->count() }} Comments </li>
                                        </ul>
                                    </div>
                                    <div class="more-button float-end">
                                        <a href="{{ route('singlePost', $post->slug) }}"><span class="icon-arrow-right"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item" aria-current="page">
                                {{ $posts->links() }}
                            </li>
                        </ul>
                    </nav>

                </div>
                <div class="col-lg-4">

                    <!-- sidebar -->
                    @include('frontend.includes.sidebar')

                </div>

            </div>

        </div>
    </section>
@endsection