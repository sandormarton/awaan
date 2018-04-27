<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Awaan - We know what you did</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset("/css/owl.carousel.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("/knows/css/owl.theme.default.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("/css/font-awesome.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("/css/bootstrap.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("/knows/css/weknow.css")}}"/>
    <meta property="og:title" content="Awaan">
    <meta property="og:type" content="website">

    @if(Request::segment(2) == 0)
        <meta property="og:url"
              content="{{URL::to('')}}/WeKnow/{{Request::segment(2)}}/?device_id={{$device_id}}"/>
        <meta property="og:image" content="{{URL::to('')}}/knows/images/weknow-viewed-shows.png">
        @if(isset($most_viewed_shows) && is_array($most_viewed_shows) && count($most_viewed_shows) > 0)
            <meta property="og:description"
                  content="اوان OnAwaan@ تعرف ماذا شاهدت! برنامجي المفضل هو {{$most_viewed_shows[0]->title_ar}} في 2017">
        @endif

    @elseif(Request::segment(2) == 1)
        <meta property="og:url"
              content="{{URL::to('')}}/WeKnow/{{Request::segment(2)}}/?device_id={{$device_id}}"/>
        <meta property="og:image" content="{{URL::to('')}}/knows/images/weknow.png">
        <meta property="og:description" content="نعرف ماذا شاهدت في 2017">

    @elseif(Request::segment(2) == 2)
        <meta property="og:url"
              content="{{URL::to('')}}/WeKnow/{{Request::segment(2)}}/?device_id={{$device_id}}"/>
        <meta property="og:image" content="{{URL::to('')}}/knows/images/test_{{$timestamp}}_{{$device_id}}.jpg">
        @if(isset($videos_count) && isset($videos_count->data->count) && count($videos_count) > 0)
            <meta property="og:description"
                  content="اوان OnAwaan@ تعرف ماذا شاهدت! لقد شاهدت {{$videos_count->data->count}} فيديو في 2017 ">
        @endif

    @elseif(Request::segment(2) == 3)
        <meta property="og:url"
              content="{{URL::to('')}}/WeKnow/{{Request::segment(2)}}/?device_id={{$device_id}}"/>
        <meta property="og:image" content="{{URL::to('')}}/knows/images/weknow-fav-channel.png">
        @if(isset($fav_channel) && count($fav_channel) > 0)
            <meta property="og:description"
                  content="اوان OnAwaan@ تعرف ماذا شاهدت! قناتي المفضلة هي {{$fav_channel->data->title_ar}} في 2017">
        @endif
    @elseif(Request::segment(2) == 4)
        <meta property="og:url"
              content="{{URL::to('')}}/WeKnow/{{Request::segment(2)}}/?device_id={{$device_id}}"/>
        <meta property="og:image" content="{{URL::to('')}}/knows/images/weknow-viewed-categories.png">
        @if(isset($most_viewed_categories) && is_array($most_viewed_categories) && count($most_viewed_categories) > 0)
            <meta property="og:description"
                  content="اوان OnAwaan@ تعرف ماذا شاهدت! فئتي المفضلة هي ال{{$most_viewed_categories[0]->title_ar}} في 2017">
        @endif
    @else
        <meta property="og:url"
              content="{{URL::to('')}}/WeKnow/{{Request::segment(2)}}/?device_id={{$device_id}}"/>
        <meta property="og:image" content="{{URL::to('')}}/knows/images/weknow.png">
    @endif
</head>
<body>

<script>window.twttr = (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
        if (d.getElementById(id))
            return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function (f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));</script>
@if(isset($most_viewed_categories) && is_array($most_viewed_categories) && count($most_viewed_categories) > 0 && isset($fav_channel) && count($fav_channel) > 0 && isset($videos_count) && isset($videos_count->data->count) && count($videos_count) > 0 && isset($most_viewed_shows) && is_array($most_viewed_shows) && count($most_viewed_shows) > 0)
    <section class="weknow" data-views="{{$videos_count->data->count}}" data-channel="{{$fav_channel->data->title_ar}}" data-show="{{$most_viewed_shows[0]->title_ar}}" data-category="{{$most_viewed_categories[0]->title_ar}}">
        @else
            <section class="weknow">
                @endif
                <div class="container-fluid">
                    {{--        <div class="row">
                                <div class="logo-wrapper">
                                    <img src="{{asset("/knows/images/logo.png")}}"/>
                                </div>
                            </div>--}}

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="weknow-carousel-wrapper">
                                <!-- Begin Carousel-->
                                <div class="owl-carousel owl-theme">
                                    <!-- -->
                                    <div class="item" data-hash="slide1">
                                        <div class="main-img">
                                            <img class="img-responsive" src="{{asset("/knows/images/weknow.png")}}"/>
                                        </div>
                                    </div>

                                    <!-- Videos views -->
                                    @if(isset($videos_count) && isset($videos_count->data->count) && count($videos_count) > 0)
                                        <div class="item" data-hash="slide2">
                                            <div class="main-img">
                                                <img class="img-responsive" src="{{asset("/knows/images/weknow-viewed-videos.png")}}"/>

                                                <p class="weknow-count-views">لقد شاهدت <span
                                                            class="count_bold">{{$videos_count->data->count}}</span> فيديو هذا
                                                    العام‎</p>
                                            </div>
                                        </div>

                                        <!-- Favorite Channel -->
                                        <div class="item" data-hash="slide3">
                                            <div class="main-img border-on col-xs-12 col-md-6 col-md-push-6">
                                                <img class="img-responsive" src="{{asset("/knows/images/weknow-fav-channel.png")}}"/>
                                            </div>
                                            <div class="show-main-result channel-main-result col-xs-12 col-md-6 col-md-pull-6">
                                                @if(isset($fav_channel) && count($fav_channel) > 0)
                                                    <?php $ext = strtolower(pathinfo($fav_channel->data->thumbnail, PATHINFO_EXTENSION)); ?>
                                                    @if($ext != "")
                                                        <div class="channel-img-wrapper"><img class="img-responsive"
                                                                                              src="{{$cdn . $fav_channel->data->thumbnail}}"/>
                                                        </div>
                                                    @endif
                                                    <div class="show-name-wrapper"><h3>{{$fav_channel->data->title_ar}}</h3>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Categories -->
                                        <div class="item" data-hash="slide4">
                                            <div class="main-img border-on col-xs-12 col-md-6  col-md-push-6">
                                                <img class="img-responsive"
                                                     src="{{asset("/knows/images/weknow-viewed-categories.png")}}"/>
                                            </div>
                                            <div class="cat-wrapper col-xs-12 col-md-6 col-md-pull-6">
                                                <div class="cat-main-result">
                                                    @if(isset($most_viewed_categories) && is_array($most_viewed_categories) && count($most_viewed_categories) > 0)
                                                        <h2>{{$most_viewed_categories[0]->title_ar}}</h2>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Shows -->
                                        <div class="item" data-hash="slide0">
                                            <div class="main-img border-on col-xs-12 col-md-6 col-md-push-6">
                                                <img class="img-responsive" src="{{asset("/knows/images/weknow-viewed-shows.png")}}"/>
                                            </div>
                                            <div class="show-main-result col-xs-12 col-md-6 col-md-pull-6">
                                                @if(isset($most_viewed_shows) && is_array($most_viewed_shows) && count($most_viewed_shows) > 0)
                                                    <?php $ext = strtolower(pathinfo($most_viewed_shows[0]->thumbnail, PATHINFO_EXTENSION)); ?>
                                                    @if($ext != "")
                                                        <div class="show-img-wrapper"><img class="img-responsive"
                                                                                           src="{{$cdn . $most_viewed_shows[0]->thumbnail}}"/>
                                                        </div>
                                                    @endif
                                                    <div class="show-name-wrapper"><h3>{{$most_viewed_shows[0]->title_ar}}</h3>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                                <!--End Carousel -->
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    @elseif (empty($videos_count->data) && $device_id != "")
                </div>
                </div>
                <div class="error-message-weknow"><h2>عذراً، ليس لدينا معلومات كافية عنك</h2></div>
                </div>
                </div>
                @elseif ($device_id == "")

                </div>
                </div>
                <div class="error-message-weknow row"><h2>الرجاء تحميل تطبيق أوان الجديد لإستخدام هذه الخدمة</h2>
                    <ul>
                        <li class="col-xs-12"><a href="https://play.google.com/store/apps/details?id=com.dotcomlb.dcn&hl=en"><img class="img-responsive" width="200" src="{{asset("/knows/images/googleplay.png")}}"/></a></li>
                        <li class="col-xs-12"><a href="https://itunes.apple.com/us/app/awaan/id641607453?mt=8#"><img class="img-responsive" width="200" src="{{asset("/knows/images/appstore.png")}}"/></a></li>
                    </ul>
                </div>
                </div>
                </div>
                @endif

                @if(isset($videos_count) && isset($videos_count->data->count) && count($videos_count) > 0)
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="weknow-social-wrapper">
                                <h5>شارك</h5>
                                <ul>
                                    <li>
                                        <a id="fb-anchor"
                                           href="https://www.facebook.com/sharer/sharer.php?u={{URL::to("")}}/WeKnow/1/?device_id={{$device_id}}&redirect_uri={{URL::to("")}}/WeKnow/1/?device_id={{$device_id}}"
                                           target="_blank"  rel="noopener noreferrer" data-action="share/facebook/share">
                                            <img src="{{asset("/knows/images/weknow-fb.png")}}"/>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-shorten="" id="twitter-link" href="https://twitter.com/intent/tweet?text={{URL::to("")}}/WeKnow/?device_id={{$device_id}} نعرف ماذا شاهدت في 2017 اوان OnAwaan@ " data-action="share/twitter/share">
                                            <img src="{{asset("/knows/images/weknow-twitter.png")}}"/>
                                        </a>
                                    </li>
                                    <li>
                                        <a id="whtsp-link" href="whatsapp://send?text={{URL::to("")}}/WeKnow/1/?device_id={{$device_id}}" data-action="share/whatsapp/share">
                                            <img style="border-radius: 6px;" src="{{asset("/knows/images/whatsapp.png")}}"/>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    </div>
            </section>

            <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
            <script type="text/javascript" src="{{asset("/js/owl.carousel.min.js")}}"></script>

            <script>
                $(document).ready(function () {

                    bit_url(function(val){

                        var shorten = val.data.url;
                        $("a#twitter-link").data("shorten", val.data.url);
                        $("a#twitter-link").attr("href", "https://twitter.com/intent/tweet?text=" + shorten + "نعرف ماذا شاهدت في 2017 اوان OnAwaan@");
                        $("a#whtsp-link").attr("href", "whatsapp://send?text=" + shorten );
                    });




                    $('.owl-carousel').owlCarousel({
                        loop: true,
                        loop: true,
                        dots: true,
                        margin: 10,
                        nav: true,
                        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                        items: 1,
                        center: true
                    });

                    device_id = GetURLParameter('device_id');

                    $('.owl-carousel').on('changed.owl.carousel', function (event) {

                        var pos = event.relatedTarget.normalize(event.item.index, true) - 2;
                        if (pos < 0) {
                            var imgCount = 5;
                            pos = imgCount + pos;
                        }
                        var fb = "https://www.facebook.com/sharer/sharer.php?u="
                        var wts = "whatsapp://send?text="
                        var twt = "https://twitter.com/intent/tweet?text="
                        var url = "{{URL::to('')}}/WeKnow";
                        var a = url.indexOf("?");
                        var b = url.substring(a);
                        var c = url.replace(b, "/" + pos + "/" + "?device_id=" + device_id);
                        url = c;

                        var twt_share = '';

                        switch (pos) {
                            case 1:
                                twt_share =   $("a#twitter-link").data("shorten") + " نعرف ماذا شاهدت في 2017 اوان OnAwaan@ ";
                                console.log(twt_share)
                                break;
                            case 2:
                                twt_share =  $("a#twitter-link").data("shorten") + "اوان @OnAwaan تعرف ماذا شاهدت! لقد شاهدت " +  $(".weknow").data("views") + " فيديو في 2017 ";
                                break;
                            case 3:
                                twt_share = $("a#twitter-link").data("shorten") + "اوان OnAwaan@ تعرف ماذا شاهدت! قناتي المفضلة هي " + $(".weknow").data("channel") + " في 2017 ";
                                break;
                            case 4:
                                twt_share =$("a#twitter-link").data("shorten") + "اوان OnAwaan@ تعرف ماذا شاهدت! فئتي المفضلة هي ال" + $(".weknow").data("category") + " في 2017 ";
                                break;
                            case 0:
                                twt_share = $("a#twitter-link").data("shorten") + " اوان @OnAwaan تعرف ماذا شاهدت! برنامجي المفضل هو " + $(".weknow").data("show") + " في 2017 ";
                                break;
                            default:
                                break;
                        }

                        $("a#fb-anchor").attr("href", fb + b + url);
                        /*$("a#whtsp-link").attr("href", wts + b + url);*/
                        $("a#twitter-link").attr("href", twt + twt_share);

                    });

                    function GetURLParameter(sParam) {

                        var sPageURL = window.location.search.substring(1);
                        var sURLVariables = sPageURL.split('&');
                        for (var i = 0; i < sURLVariables.length; i++) {
                            var sParameterName = sURLVariables[i].split('=');
                            if (sParameterName[0] == sParam) {
                                return sParameterName[1];
                            }
                        }
                    }

                    function bit_url(callback) {

                        var login = "o_2vd84rv1ci";
                        var api_key = "R_e4fa8ba8db3b4758ac9df8db6f1b886a";
                        var long_url = "{{URL::to('')}}/WeKnow/?device_id={{$device_id}}";
                        var result = "";

                        $.getJSON("/shortenURL", {longUrl: long_url, apiKey: api_key, login: login}, callback);

                    }

                });
            </script>
</body>
</html>
