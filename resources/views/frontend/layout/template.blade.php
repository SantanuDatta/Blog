<!DOCTYPE html>
<html lang="en-US">

<head>
    {{-- Header --}}
    @include('frontend.includes.header')
    <!-- STYLES -->
    @include('frontend.includes.css')

</head>

<body>

    <!-- preloader -->
    <div id="preloader">
        <div class="book">
            <div class="inner">
                <div class="left"></div>
                <div class="middle"></div>
                <div class="right"></div>
            </div>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>

    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>

        <!-- header -->
        <header class="header-default">
            {{-- Top Bar --}}
            @include('frontend.includes.topbar')
        </header>

        {{-- MainContent --}}
        @yield('body-content')


        {{-- Footer --}}
        @include('frontend.includes.footer')

    </div><!-- end site wrapper -->

    <!-- search popup area -->
    @include('frontend.includes.search')

    {{-- Script --}}
    @include('frontend.includes.script')
</body>

</html>
