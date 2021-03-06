<!DOCTYPE html>
<html lang="{{empty(Session::get('lang'))?"ar":Session::get('lang')}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--        @section('title', '404')-->
    <title> @yield('title')</title>
    @yield('social_header_meta')

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="apple-itunes-app" content="app-id=641607453, affiliate-data=myAffiliateData, app-argument=https://itunes.apple.com/us/app/dcn-digital/id641607453?mt=8">

    <link type="image/x" href="{{ asset("images/favicon.png")}}" rel="shortcut icon" />


    <link rel="stylesheet" type="text/css" href="{{ asset("/css/bootstrap.min.css")}}" />
    @if(Session::get('lang') == 'ar')
        <link rel="stylesheet" type="text/css" href="{{ asset("/css/bootstrap-rtl.min.css")}}" />
    @endif
    <link rel="stylesheet" type="text/css" href="{{asset("/css/bootstrap-theme.min.css")}}" />
    <link rel="stylesheet" type="text/css" href="{{asset("/css/font-awesome.min.css")}}" />
    <link rel="stylesheet" type="text/css" href="{{asset("/css/mCustomScrollbar.min.css")}}" />
    <link rel="stylesheet" type="text/css" href="{{asset("/css/owl.carousel.min.css")}}" />
    <link rel="stylesheet" type="text/css" href="{{asset("/css/select2.min.css")}}" />
    <link rel="stylesheet" type="text/css" href="{{asset("/css/loader.css")}}" />
    <link rel="stylesheet" type="text/css" href="{{asset("/css/template.css")}}" />
    <link rel="stylesheet" type="text/css" href="{{asset("/css/main.css")}}?v=12" />







    @if(Session::get('lang') == 'en')
        <link rel="stylesheet" type="text/css" href="{{asset("/css/template-en.css")}}" />
    @endif
    <link rel="stylesheet" type="text/css" href="{{asset("/css/colors.css")}}" />
    <link rel="stylesheet" type="text/css" href="{{asset("/js/rating/jquery.rateyo.min.css")}}" />

    <script>
        var user_id = {{(Session::has('user_info')) ? Session::get('user_info')->id : 'false'}};
        var lang = '{{(Session::has('lang')) ? Session::get('lang') : 'ar'}}';
    </script>

    <!--[if lt IE 9]>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js" type="text/javascript"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="{{asset("/js/jquery.min.js")}}"></script>
    <!--<![endif]-->

    {{--<script src="{{asset('/js/jquery.nicescroll.min.js')}}"></script>--}}
    <script src="{{asset('/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/loader.min.js')}}"></script>
    <script src="{{asset('/js/owl.carousel.min.js')}}"></script>
    {{--<script src="{{asset('/js/jssor.slider-26.3.0.min.js')}}"></script>--}}
    <script src="{{asset('/js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('/js/jquery.unveil.js')}}"></script>
    <script src="{{asset('/js/jquery.lazy.min.js')}}"></script>
    <script src="{{asset('/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/js/template.js')}}"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script type="text/javascript" src="https://imasdk.googleapis.com/js/sdkloader/gpt_proxy.js"></script>




    <?php
    $apiobj = new \App\Providers\ApiRequest();
    if(ends_with(Route::currentRouteAction(), 'Shows@index')){
        $id = Request::segment(2);
        $ads = $apiobj->getSuggested($id, 0, 'verify');
    }elseif(ends_with(Route::currentRouteAction(), 'Video@watch')){
        $id = Request::segment(2);
        $ads = $apiobj->getSuggested(0, $id, 'verify');
    }else{
        $ads = $apiobj->getAds(0, 0);
    }
    if(isset($ads) and $ads != false){
        $ads = end($ads);
        echo $ads->dfp_header;
    }
    ?>

</head>


<body>

    <!-- MAIN CONTAINER [START] -->
    <div class="site-main-container innerpage-main-container">

        <div class="pagenotfound-wrapper">

            <div class="container">
                <div id="wrapper">
                    <header class="clearfix">

                        <h3 class="brand"><a href="/" title="404"><img src="{{ asset("images/logo-2.png")}}" class="img-responsive center-block" /></a></h3>

                        <!--end-of-row-->
                    </header>
                    <article>

                        <!-- Tab panes -->

                        <div class="box">
                            <span class="section-icon"><i class="fa fa-chain-broken fa-2x"></i></span>
                            <h1>404</h1>
                            <h4>Sorry - Page Not Found!</h4>
                            <p>The page you are looking for was moved, removed, renamed or might never existed. <br>
                                You stumbled upon a broken link :(</p>
                            <a href="http://awaan.ae"><div class="btn btn-back-home">Back To Home</div></a>
                        </div>

                    </article>
                    <footer>

                        <ul class="footer-sm-ul">
                            <li><a target="_blank"  rel="noopener noreferrer" title="Facebook" href="https://www.facebook.com/OnAwaan/"><img src="{{ asset("images/icon-sm-facebook.png")}} " alt="Facebook"></a></li>
                            <li><a target="_blank"  rel="noopener noreferrer" title="Twitter" href="https://twitter.com/OnAwaan"><img src="{{ asset("images/icon-sm-twitter.png")}}" alt="Twitter"></a></li>
                        </ul>

                    </footer>
                </div>
                <!--end-of-wrapper-->
            </div>
            <!--end-of-container-->

        </div>

    </div>
    <!-- MAIN CONTAINER [END] -->

</body>
</html>
