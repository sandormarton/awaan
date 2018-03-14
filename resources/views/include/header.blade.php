<!DOCTYPE html>
<html lang="{{empty(Session::get('lang'))?"ar":Session::get('lang')}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--        @section('title', 'Welcome Awaan ')-->
        <title> @yield('title')</title>
        @yield('social_header_meta')

            <meta name="csrf-token" content="{{ csrf_token() }}" />

            <meta name="apple-itunes-app" content="app-id=641607453, affiliate-data=myAffiliateData, app-argument=https://itunes.apple.com/us/app/dcn-digital/id641607453?mt=8">

            <link type="image/x" href="{{ asset("images/favicon.png")}}" rel="shortcut icon" />

		    {{--<link rel="stylesheet" type="text/css" href="{{ asset("/css/bootstrap.min.css")}}" />--}}

            <link rel="stylesheet" type="text/css" href="{{asset("/css/_styles.min.css")}}" />

            @if(Session::get('lang') == 'ar')
		    <link rel="stylesheet" type="text/css" href="{{ asset("/css/bootstrap-rtl.min.css")}}" />
            @endif

        	{{--<link rel="stylesheet" type="text/css" href="{{asset("/css/bootstrap-theme.min.css")}}" />--}}
        	{{--<link rel="stylesheet" type="text/css" href="{{asset("/css/font-awesome.min.css")}}" />--}}
        	{{--<link rel="stylesheet" type="text/css" href="{{asset("/css/mCustomScrollbar.min.css")}}" />--}}
        	{{--<link rel="stylesheet" type="text/css" href="{{asset("/css/owl.carousel.min.css")}}" />--}}
        	{{--<link rel="stylesheet" type="text/css" href="{{asset("/css/select2.min.css")}}" />--}}
        	{{--<link rel="stylesheet" type="text/css" href="{{asset("/css/loader.css")}}" />--}}

            <link rel="stylesheet" type="text/css" href="{{asset("/css/template.css")}}" />


            @if(Session::get('lang') == 'en')
                <link rel="stylesheet" type="text/css" href="{{asset("/css/template-en.css")}}" />
            @endif
        	{{--<link rel="stylesheet" type="text/css" href="{{asset("/css/colors.css")}}" />--}}
            {{--<link rel="stylesheet" type="text/css" href="{{asset("/js/rating/jquery.rateyo.min.css")}}" />--}}

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
            {{--<script src="{{asset('/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>--}}
            {{--<script src="{{asset('/js/bootstrap.min.js')}}"></script>--}}
            {{--<script src="{{asset('/js/loader.min.js')}}"></script>--}}
            {{--<script src="{{asset('/js/owl.carousel.min.js')}}"></script>--}}
            {{--<script src="{{asset('/js/jssor.slider-26.3.0.min.js')}}"></script>--}}
            {{--<script src="{{asset('/js/jquery.maskedinput.min.js')}}"></script>--}}
            {{--<script src="{{asset('/js/jquery.unveil.js')}}"></script>--}}
            {{--<script src="{{asset('/js/jquery.lazy.min.js')}}"></script>--}}
            {{--<script src="{{asset('/js/select2.full.min.js')}}"></script>--}}

            <script src="{{asset('/js/_scripts.js')}}"></script>

            <script src="{{asset('/js/template.js')}}"></script>
            <script src="{{asset('/js/main.js')}}"></script>


            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

            <script type="text/javascript" src="https://imasdk.googleapis.com/js/sdkloader/gpt_proxy.js"></script>

            <script type="text/javascript" src="https://happinessmeterqa.dubai.gov.ae/HappinessMeter2/source/jquery.fancybox.js?v=2.1.5"></script>
            <link rel="stylesheet" type="text/css" href="https://happinessmeterqa.dubai.gov.ae/HappinessMeter2/source/jquery.fancybox.css?v=2.1.5" media="screen" />
            <style type="text/css">
                .fancybox-custom .fancybox-skin {
                    box-shadow: 0 0 50px #222;
                }

                body {
                    /*max-width: 700px;*/
                    margin: 0 auto;
                }

                #foo {
                    position: fixed;
                    bottom: 15px;
                    left: 15px;
                    background-color: #318ECD;
                    padding: 10px;
                    z-index: 1;
                }
            </style>

            <script type="text/javascript">
                $(document).ready(function () {
                    $('.fancybox').fancybox();
                });

                var pageName = (function () {
                    var a = window.location.href,
                        b = a.lastIndexOf("/");
                    return a.substr(b + 1);
                }());

                function autoClick() {
                    if (pageName == 'TransactionIndex.aspx') {
                        document.getElementById('onload').click();
                    }
                }

            </script>
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
