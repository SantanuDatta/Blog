@extends('frontend.layout.template')

@section('title', 'Read Post')
@section('body-content')
    <!-- cover header -->
    <section class="single-cover data-bg-image" data-bg-image="{{ asset('backend/img/post-images/'.$post->image) }}">

        <div class="container-xl">

            <div class="cover-content post">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blogs') }}">Blogs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                    </ol>
                </nav>

                <!-- post header -->
                <div class="post-header">
                    <h1 class="title mt-0 mb-3">{{ $post->title }}</h1>
                    <ul class="meta list-inline mb-0">
                        <li class="list-inline-item">by {{ $post->user->name }}</li>
                        <li class="list-inline-item">
                            @foreach (explode(",", $post->category_id) as $cat)
                                @foreach (App\Models\Category::where('id', $cat)->get() as $allCat)
                                    {{ $allCat->name }}
                                @endforeach
                            @endforeach
                        </li>
                        <li class="list-inline-item">{{ $post->created_at->toFormattedDateString() }}</li>
                    </ul>
                </div>
            </div>

        </div>

    </section>

	<!-- section main content -->
	<section class="main-content">
		<div class="container-xl">

			<div class="row gy-4">

				<div class="col-lg-8">
					<!-- post single -->
                    <div class="post post-single">
						<!-- post content -->
						<div class="post-content clearfix">
							<p>
                                {!! $post->description !!}
                            </p>
						</div>
						<!-- post bottom section -->
						<div class="post-bottom">
							<div class="row d-flex align-items-center">
								<div class="col-md-6 col-12 text-center text-md-start">
									<!-- tags -->
									@foreach (explode(",", $post->tags) as $tag)
                                        <a href="#" class="tag">{{ $tag }}</a>
                                    @endforeach
								</div>
								<div class="col-md-6 col-12">
									<!-- social icons -->
									<ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
										<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
										<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
										<li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
										<li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
										<li class="list-inline-item"><a href="#"><i class="fab fa-telegram-plane"></i></a></li>
										<li class="list-inline-item"><a href="#"><i class="far fa-envelope"></i></a></li>
									</ul>
								</div>
							</div>
						</div>

                    </div>

					<div class="spacer" data-height="50"></div>

					<div class="spacer" data-height="50"></div>

					<!-- section header -->
					<div class="section-header">
                        @php
                            $commentCount = DB::table('comments')->where('post_id', $post->id)->where('status', 1)->get();
                        @endphp
						<h3 class="section-title">Comments ({{ $commentCount->count() }})</h3>
						<img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
					</div>
					<!-- post comments -->
					<div class="comments bordered padding-30 rounded">

						<ul class="comments">
							<!-- comment item -->
                            @foreach (App\Models\Comment::where('post_id', $post->id)->where('status', 1)->get() as $comment)
                                <li class="comment rounded">
                                    <div class="thumb">
                                        <img src="{{ asset('frontend/images/other/comment-1.png') }}" alt="User" />
                                    </div>
                                    <div class="details">
                                        <h4 class="name">{{ $comment->user->name }}</h4>
                                        <span class="date">{{ $comment->created_at->toFormattedDateString() }}</span>
                                        <p>{!! $comment->description !!}</p>
                                        {{-- <a href="#" class="btn btn-default btn-sm">Reply</a> --}}
                                    </div>
                                </li>
                            @endforeach
						</ul>
					</div>

					<div class="spacer" data-height="50"></div>

					<!-- section header -->
					<div class="section-header">
						<h3 class="section-title">Leave Comment</h3>
						<img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
					</div>
					<!-- comment form -->
					<div class="comment-form rounded bordered padding-30">
                        @if (Auth::check())
                            <form action="{{ route('post.comment', $post->id) }}" method="POST" id="comment-form" class="comment-form" method="post">
                                @csrf
                                <div class="messages"></div>
                                    <div class="row">
                                        <div class="column col-md-12">
                                            <!-- Comment textarea -->
                                            <div class="form-group">
                                                <textarea name="description" id="InputComment" class="form-control" rows="4" placeholder="Your comment here..." required="required"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <button type="submit" name="submit-contact" id="submit" value="Submit" class="btn btn-default">Submit</button><!-- Submit Button -->
                            </form>
                        @else
                            <div class="text-center">
                                <h2>You Are Not Signed In</h2><br>
                                <a href="{{ route('login') }}" class="text-center button-one">Login</a>
                                <span>Or</span>
                                <a href="{{ route('register') }}" class="text-center button-one">Signup</a>
                            </div>
                        @endif
					</div>
                </div>

				<div class="col-lg-4">

					<!-- sidebar -->
					@include('frontend.includes.sidebar')

				</div>

			</div>

		</div>
	</section>
@endsection