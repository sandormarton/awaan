<!--incude begins-->
@include('include.header')
<!--include ends-->

<body>

    <div id="loader-wrapper">
        <div id="loader">
        </div>

    </div>

    <div class="site-main-container" id="site-main-container">

        <!--call the home section from the master blade -->
        @include('home.header')
        <div class="site-context-height">
        @yield('home')
        @yield('main-content')
        </div>
        <!--footer begins-->
        @if(ends_with(Route::currentRouteAction(), 'RadioController@show_details') || ends_with(Route::currentRouteAction(), 'RadioController@index')  || ends_with(Route::currentRouteAction(), 'RadioController@catchup') )
            @include('include.footer_audio')
        @else
            @include('include.footer')
        @endif
        <!--footer ends-->
    </div>
    <div class="scrollup_area"><a class="scrollup" href="javascript:void(0)"><p style="display: none;">To Top</p><i class="fa fa-top"></i></a></div>

    <script>

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-23118519-1', 'auto');
        ga('send', 'pageview');

    </script>
</body>
</html>
