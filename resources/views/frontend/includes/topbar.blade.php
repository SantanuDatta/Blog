<nav class="navbar navbar-expand-lg">
    <div class="container-xl">
        <!-- site logo -->
        @foreach ($settings as $setting)
            <a class="navbar-brand" href="{{ route('home') }}"><img
                    src="{{ asset('backend/img/settings/logo/' . $setting->logo) }}" alt="logo" /></a>
        @endforeach

        <div class="collapse navbar-collapse">
            <!-- menus -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if (Route::is('home')) active @endif">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item @if (Route::is('blogs') || Route::is('singlePost')) active @endif">
                    <a class="nav-link" href="{{ route('blogs') }}">Blogs</a>
                </li>
                <li class="nav-item dropdown @if (Route::is('categoryPost')) active @endif"">
                    <a class="nav-link dropdown-toggle" href="#">Categories</a>
                    <ul class="dropdown-menu">
                        @foreach (App\Models\Category::where('is_parent', 0)->where('status', 1)->orderBY('name', 'asc')->get() as $pCat)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('categoryPost', $pCat->slug) }}">{{ $pCat->name }}</a>
                            </li>
                            @foreach (App\Models\Category::orderBy('name', 'asc')->where('is_parent', $pCat->id)->get() as $childCat)
                                <li>
                                    <a class="dropdown-item" href="{{ route('categoryPost', $childCat->slug) }}">
                                        &#8627; {{ $childCat->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item @if (Route::is('contact')) active @endif">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>

                <li class="nav-item pro-button dropdown">
                    <i class="icon-user"></i>
                    @if (Auth::check())
                        <ul class="dropdown-menu">
                            @if (Auth::user()->role == 1)
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            @elseif (Auth::user()->role == 2)
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            @else
                                <li><a class="dropdown-item" href="">Settings</a></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="" class="dropdown-item"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">{{ __('Logout') }}</a>
                                </form>
                            </li>
                        </ul>
                    @else
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login In</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Sign Up</a></li>
                        </ul>
                    @endif
                </li>
            </ul>
        </div>

        <!-- header right section -->
        <div class="header-right">
            <!-- social icons -->
            <ul class="social-icons list-unstyled list-inline mb-0">
                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
            </ul>
            <!-- header buttons -->
            <div class="header-buttons">
                <button class="search icon-button">
                    <i class="icon-magnifier"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
