<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- ########## START: HEADER PANEL ########## -->
        @include('backend.includes.header')
        @yield('site-title')
        <!-- ########## END: HEADER PANEL ########## -->

        <!-- ########## START: CSS PANEL ########## -->
        @include('backend.includes.css')
        <!-- ########## END: CSS PANEL ########## -->
    </head>

    <body>

    <!-- ########## START: LEFT PANEL ########## -->
        @include('backend.includes.sidebar')
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
        @include('backend.includes.topbar')
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        @yield('body-content')
        <!-- ########## START: FOOTER PANEL ########## -->
            @include('backend.includes.footer')
        <!-- ########## END: FOOTER PANEL ########## -->
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

        <!-- ########## START: SCRIPT PANEL ########## -->
        @include('backend.includes.script')
        <!-- ########## START: SCRIPT PANEL ########## -->
    </body>
</html>