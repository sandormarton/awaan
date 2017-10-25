<!--incude begins-->
@include('include.header')
<!--include ends-->
<body>
    <!-- MAIN CONTAINER [START] -->
    <div class="site-main-container innerpage-main-container">
        <!--call the home section from the master blade -->
        @yield('show')
        @yield('allshows')
        @yield('series')
        @yield('video')
        @yield('search')
        @yield('favoriteshows')
        @yield('favoritevideos')
        @yield('premium')
        @yield('subscribe')
        @yield('live')
        @yield('catchup')
        @yield('allvod')
        @yield('all_programs')
        @yield('categories')
        @yield('channelshows')
        @yield('applications')
        <!--footer begins-->

        <!--footer ends-->
    </div>
</body>
</html>



