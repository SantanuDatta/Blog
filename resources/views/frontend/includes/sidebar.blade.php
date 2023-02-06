<!-- sidebar -->
<div class="sidebar">

    <div class="post-tabs rounded bordered">
        <!-- tab navs -->
        <ul class="nav nav-tabs nav-pills nav-fill" id="postsTab" role="tablist">
            <li class="nav-item" role="presentation"><button aria-controls="popular" aria-selected="true" class="nav-link active" data-bs-target="#popular" data-bs-toggle="tab" id="popular-tab" role="tab" type="button">Popular</button></li>
            <li class="nav-item" role="presentation"><button aria-controls="recent" aria-selected="false" class="nav-link" data-bs-target="#recent" data-bs-toggle="tab" id="recent-tab" role="tab" type="button">Recent</button></li>
        </ul>
        <!-- tab contents -->
        <div class="tab-content" id="postsTabContent">
            <!-- loader -->
            <div class="lds-dual-ring"></div>
            <!-- popular posts -->
            <div aria-labelledby="popular-tab" class="tab-pane fade show active" id="popular" role="tabpanel">
                <!-- post -->
                @foreach (App\Models\Post::where('is_featured', 1)->orderBy('id', 'desc')->take(4)->get() as $pPost)
                    <div class="post post-list-sm circle">
                        <div class="thumb rounded">
                            <a href="{{ route('singlePost', $pPost->slug) }}">
                                <div class="inner">
                                    @if (!is_null($pPost->image))
                                        <img src="{{ asset('backend/img/post-images/'.$pPost->image) }}" alt="post-title" />
                                    @else
                                        <img src="{{ asset('backend/img/post-images/post_default.png') }}" alt="post-title" />
                                    @endif
                                </div>
                            </a>
                        </div>
                        <div class="details clearfix">
                            <h6 class="post-title my-0"><a href="{{ route('singlePost', $pPost->slug) }}">{{ Str::limit($pPost->title, 40) }}</a></h6>
                            <ul class="meta list-inline mt-1 mb-0">
                                <li class="list-inline-item">{{ $pPost->created_at->toFormattedDateString() }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
                
            </div>
            <!-- recent posts -->
            <div aria-labelledby="recent-tab" class="tab-pane fade" id="recent" role="tabpanel">
                <!-- post -->
                @foreach ($latestPosts as $lPost)
                    <div class="post post-list-sm circle">
                        <div class="thumb rounded">
                            <a href="{{ route('singlePost', $lPost->slug) }}">
                                <div class="inner">
                                    @if (!is_null($lPost->image))
                                        <img src="{{ asset('backend/img/post-images/'.$lPost->image) }}" alt="post-title" />
                                    @else
                                        <img src="{{ asset('backend/img/post-images/post_default.png') }}" alt="post-title" />
                                    @endif
                                </div>
                            </a>
                        </div>
                        <div class="details clearfix">
                            <h6 class="post-title my-0"><a href="{{ route('singlePost', $lPost->slug) }}">{{ Str::limit($lPost->title, 40) }}</a></h6>
                            <ul class="meta list-inline mt-1 mb-0">
                                <li class="list-inline-item">{{ $lPost->created_at->toFormattedDateString() }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- widget categories -->
    <div class="widget rounded">
        <div class="widget-header text-center">
            <h3 class="widget-title">Explore Topics</h3>
            <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
        </div>
        <div class="widget-content">
            <ul class="list">
                @foreach (App\Models\Category::where('is_parent', 0)->where('status', 1)->orderBY('name', 'asc')->get() as $pCat)
                    <li>
                        @php
                            $numOfPPost = DB::table('posts')
                            ->where('category_id', 'LIKE', '%'.$pCat->id.'%')
                            ->count();
                        @endphp
                        <a href="{{ route('categoryPost', $pCat->slug) }}">
                            {{ $pCat->name }} <span>{{ $numOfPPost }}</span>
                        </a>
                    </li>
                    @foreach (App\Models\Category::orderBy('name', 'asc')->where('is_parent', $pCat->id)->get() as $childCat)
                        <li>
                            @php
                                $numOfCPost = DB::table('posts')
                                ->where('category_id', 'LIKE', '%'.$childCat->id.'%')
                                ->count();
                            @endphp
                            <a href="{{ route('categoryPost', $childCat->slug) }}">
                                &#8627; {{ $childCat->name }} <span>{{ $numOfCPost }}</span>
                            </a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
        
    </div>

    <!-- widget tags -->
    {{-- <div class="widget rounded">
        <div class="widget-header text-center">
            <h3 class="widget-title">Tags</h3>
            <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
        </div>
        <div class="widget-content">
            <a href="#" class="tag">#Trending</a>
            <a href="#" class="tag">#Video</a>
            <a href="#" class="tag">#Featured</a>
            <a href="#" class="tag">#Gallery</a>
            <a href="#" class="tag">#Celebrities</a>
        </div>		
    </div> --}}

    <!-- widget advertisement -->
    <div class="widget no-container rounded text-md-center">
        <span class="ads-title">- Sponsored Ad -</span>
        <a href="#" class="widget-ads">
            <img src="{{ asset('frontend/images/ads/ad-360.png') }}" alt="Advertisement" />	
        </a>
    </div>

    <!-- widget newsletter -->
    <div class="widget rounded">
        <div class="widget-header text-center">
            <h3 class="widget-title">Newsletter</h3>
            <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
        </div>
        <div class="widget-content">
            <span class="newsletter-headline text-center mb-3">Join 70,000 subscribers!</span>
            <form action="{{ route('subscribe') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <input class="form-control w-100 text-center" placeholder="Email address…" type="email" name="email" id="email" value="{{ old('email') }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" /><br>
                </div>
                <button class="btn btn-default btn-full" name="subscribe" type="submit">Subscribe</button>
            </form>
            <span class="newsletter-privacy text-center mt-3">By signing up, you agree to our <a href="#">Privacy Policy</a></span>
        </div>		
    </div>

</div>