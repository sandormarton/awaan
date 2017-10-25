<!--incude begins-->
@include('include.header')
<!--include ends-->
<body>
    <!-- MAIN CONTAINER [START] -->
    <div class="site-main-container newspage-main-container">
        <!--call the home section from the master blade -->
        @yield('news')
        @yield('newsvideos')
        @yield('news_categ_videos')
        <!--footer begins-->

        <!--footer ends-->
    </div>
</body>
</html>


<!--//@yield('application')-->




