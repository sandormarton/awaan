@extends('layouts.master')
@section('title', 'Video on Demand - AWAAN')
@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title'=>"Video on Demand - AWAAN",
        'current_description'=>"Video on Demand - AWAAN",
    ])
@endsection
@section('home')
<h1 style="display: none;">Awaan</h1>
<h2 style="display: none;">Awaan</h2>
<!-- MAIN CONTAINER [START] -->

    <!--  HOME BANNER WRAPPER [START]	-->
    <div class="homebanner-wrapper">
        <div class="container">

            <div id="homebanner-carousel" class="owl-carousel homebanner-carousel">
                @if(isset($home_data->banners) && is_array($home_data->banners) && count($home_data->banners) > 0)
                    @foreach($home_data->banners as $item)
                        <?php
                        if(Session::get('lang') == 'ar'){
                            $title = $item -> title_ar;
                        }else{
                            $title = $item -> title_en;
                        }
                        ?>
                        {{--*/ $img = config('mangoapi.mangodcn').$item->img;/*--}}

                            <div class="item">
                                <a class="silder-href" href="{{URL::to("video/{$item->id}/".\App\Helpers\Functions::cleanurl($title))}}">
                                    <p style="display: none">{{$title}}</p>
                                    <div class="program-div scaleZoomImg">
                                        <div class="embed-responsive-item img-div " style="background-image: url('{{$img}}');"></div>
                                        <img src="{{asset("images/ajax-loader.gif")}}" style="display: none" alt="{{$title}}" />
                                        <div class="program-overlay"></div>
                                        <div class="program-text">
                                            <h3 class="title">{{$title}}</h3>
                                            {{--<h4 class="sub-title">{{ trans('content.whole.new_episode') }}</h4>--}}
                                            <div class="info-blocks">
                                                <div>
                                                    <img src="{{asset("images/icon-play.png")}}" alt="play icon" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                    @endforeach
                @endif
            </div>

            <div class="channel-list-wrapper">
                <div class="row">
                    <div class="col-lg-2">
                        <p class="channel-module-title">{{ trans('content.whole.live') }}</p>
                    </div>
                    <div class="col-lg-10">
                        <div id="channel-carousel" class="owl-carousel channel-carousel">
                            @if(isset($home_data->channels) && is_array($home_data->channels) && count($home_data->channels) > 0)
                                @foreach($home_data->channels as $item)
                                    <?php
                                    if(Session::get('lang') == 'ar'){
                                        $title = $item -> title_ar;
                                    }else{
                                        $title = $item -> title_en;
                                    }
                                    ?>
                                    {{--*/ $img = config('mangoapi.mangodcn').$item->live_icon;/*--}}
                                    <div class="item">

                                        <a href="{{URL::to("live/{$item->id}/".\App\Helpers\Functions::cleanurl($title))}}">
                                            <p style="display: none">{{$title}}</p>
                                            <div class="channel-div channel-sama-div channel-{{$item->id}}-div">
                                                <img src="{{$img}}" alt="{{$title}}" title="{{$title}}" />
                                                <div class="seperator" data-color="{{$item->id}}"></div>
                                                @if(isset($item->live) && is_array($item->live) && count($item->live) > 0)
                                                    <div class="program-time">{{\App\Helpers\Functions::convertFormat($item->live[0]->start)}} - {{\App\Helpers\Functions::convertFormat($item->live[0]->stop)}}</div>
                                                @endif
                                                <div class="program-title">{{(isset($item->live) && is_array($item->live) && count($item->live) > 0)?$item->live[0]->title:$title}}</div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                                @if(isset($radio_channels) && is_array($radio_channels) && count($radio_channels) > 0)
                                    @foreach($radio_channels as $item)
                                        <?php
                                        if(Session::get('lang') == 'ar'){
                                            $title = $item -> title_ar;
                                        }else{
                                            $title = $item -> title_en;
                                        }
                                        ?>
                                        <?php
                                        if(isset($item->thumbnail) && !empty($item->thumbnail)) {
                                            $img = config('mangoapi.mangodcn').$item->thumbnail;
                                        }else{
                                            $img = asset('images/image-not-available.jpg');
                                        }
                                        ?>
                                        <div class="item">

                                            <a href="{{URL::to("radio/{$item->id}/".\App\Helpers\Functions::cleanurl($title))}}">
                                                <p style="display: none">{{$title}}</p>
                                                <div class="channel-div channel-sama-div channel-{{$item->id}}-div">
                                                    <img src="{{$img}}" alt="{{$title}}" title="{{$title}}" style=" height: 107px;"/>
                                                    <div class="seperator" data-color="{{$item->id}}"></div>
                                                    @if(isset($item->live) && is_array($item->live) && count($item->live) > 0)
                                                        <div class="program-time">{{\App\Helpers\Functions::convertFormat($item->live[0]->start)}} - {{\App\Helpers\Functions::convertFormat($item->live[0]->stop)}}</div>
                                                    @endif
                                                    <div class="program-title">{{(isset($item->live) && is_array($item->live) && count($item->live) > 0)?$item->live[0]->title:$title}}</div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!--  HOME BANNER WRAPPER [END]		-->

<!--  RESUME LIST [START]	-->
@if(!empty($resume_list) && count($resume_list) > 0)

<div class="homeprogramssection-wrapper">
    <div class="container">
        <div class="homeprograms-section ast-additions-programs-section">
            <div class="title-section">
                <h3>{{ trans('content.whole.resume') }}</h3>
                <a href="{{URL::to('resumeList')}}" class="btn btn-awaanbluebtn btn-viewall">{{ trans('content.whole.show_more') }}</a>
            </div>
            <div class="data-section">
                <div id="resume-carousel" class="owl-carousel data-carousel series-carousel">
                    @foreach($resume_list as $item)
                        <?php
                        if(Session::get('lang') == 'ar'){
                            $title = $item -> title_ar;
                        }else{
                            $title = $item -> title_en;
                        }
                        $url = route('video', [$item->id, ($title)]);
                        $img = config('mangoapi.mangodcn').$item->img;
                        $progress = round(($item->position * 100) / $item->duration);
                        ?>
                        <div class="item scaleZoomImg">
                            <a href="{{$url}}">
                                <p style="display: none">{{$title}}</p>
                                <div class="embed-responsive-item img-div" style="background-image: url('{{$img}}');"></div>
                                {{--<img src="{{$img}}" title="{{$title}}" alt="{{$title}}" />--}}
                                <span class="title">
                                    <span class="name">{{$title}}</span>
                                    <span class="name2">{{$item->recorder_date}}</span>
                                </span>

                                <div class="progress progress-bar-div">
                                    <div class="progress-bar progress-bar-warning" role="progressbar"
                                         aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100"
                                         style="width: {{$progress}}%"></div>
                                    <div class="progress-bar progress-bar-dot"></div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endif
<!--  RESUME LIST [END]	-->



    <!--  HOME PROGRAMS SECTION WRAPPER [START]		-->
    @if(isset($recommendedShows) && is_array($recommendedShows) && count($recommendedShows) > 0)
    <div class="homeprogramssection-wrapper">
        <div class="container">

            <div class="homeprograms-section series-programs-section">
                <div class="title-section">
                    <h3>{{ trans('content.whole.recommended') }}</h3>
                    <a href="{{URL::to('youMaybeLike')}}" class="btn btn-awaanbluebtn btn-viewall">{{ trans('content.whole.show_more') }}</a>
                </div>
                <div class="data-section">


                    <div id="recommended-carousel" class="owl-carousel data-carousel series-carousel">
                            @foreach($recommendedShows as $item)
                                <?php
                                if(Session::get('lang') == 'ar'){
                                    $title = $item -> title_ar;
                                }else{
                                    $title = $item -> title_en;
                                }
                                $img = config('mangoapi.mangodcn').$item->thumbnail;
                                $titlefiy = \App\Helpers\Functions::cleanurl($title);
                                $url= URL::to("show/{$item->id}/{$titlefiy}");
                                ?>
                                <div class="item scaleZoomImg">
                                    <a href="{{$url}}">
                                        <p style="display: none">{{$title}}</p>
                                        <div class="embed-responsive-item img-div" style="background-image: url('{{$img}}');"></div>
                                        <span class="title">{{$title}}</span>
                                    </a>
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


    <div class="homeprogramssection-wrapper">
        <div class="container">

            <div class="homeprograms-section series-programs-section">
                <div class="title-section">
                    <h3>{{ trans('content.whole.series') }}</h3>
                    <a href="{{URL::to('show/allprograms/30348/'. trans('content.whole.series') )}}" class="btn btn-awaanbluebtn btn-viewall">{{ trans('content.whole.show_more') }}</a>
                </div>
                <div class="data-section">
                    <div id="series-carousel" class="owl-carousel data-carousel series-carousel">
                        @if(isset($series->shows) && is_array($series->shows) && count($series->shows) > 0)
                            @foreach($series->shows as $item)
                                <?php
                                    if(Session::get('lang') == 'ar'){
                                        $title = $item -> title_ar;
                                    }else{
                                        $title = $item -> title_en;
                                    }
                                        $img = config('mangoapi.mangodcn').$item->thumbnail;
                                        $url = URL::to("show/{$item->id}/".\App\Helpers\Functions::cleanurl($title));
                                ?>
                                <div class="item scaleZoomImg">
                                    <a href="{{$url}}">
                                        <p style="display: none">{{$title}}</p>
                                    	<div class="embed-responsive-item img-div" style="background-image: url('{{$img}}');"></div>
                                        {{--<img src="{{$img}}" />--}}
                                        <span class="title">{{$title}}</span>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="homeprogramssection-wrapper">
        <div class="container">

            <div class="homeprograms-section last-additions-programs-section">
                <div class="title-section">
                    <h3>{{ trans('content.whole.recent_added') }}‎</h3>
                    <a href="{{URL::to('latestAdded/')}}" class="btn btn-awaanbluebtn btn-viewall">{{ trans('content.whole.show_more') }}</a>
                </div>
                <div class="data-section">
                    <div id="last-additions-carousel" class="owl-carousel data-carousel last-additions-carousel">
                        @if(isset($home_data->ramadan_shows) && is_array($home_data->ramadan_shows) && count($home_data->ramadan_shows) > 0)
                            @foreach($home_data->ramadan_shows as $item)
                                {{--*/ $img = config('mangoapi.mangodcn').$item->img;/*--}}
                            <?php
                                if(Session::get('lang') == 'ar'){
                                    $title = $item -> title_ar;
                                }else{
                                    $title = $item -> title_en;
                                }
                                $url = route('video', [$item->id, ($title)]);
                             ?>
                                <div class="item scaleZoomImg">
                                    <a href="{{$url}}">
                                        <p style="display: none">{{$title}}</p>
                                    	<div class="embed-responsive-item img-div" style="background-image: url('{{$img}}');"></div>
                                        {{--<img src="{{$img}}" title="{{$title}}" alt="{{$title}}" />--}}
                                        <div class="ribbin-div ribbin-new-episode"></div>
                                        <span class="title">
                                            <span class="name">{{$title}}</span>
                                            <span class="name2">{{$item->recorder_date}}</span>
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="homeprogramssection-wrapper">
        <div class="container">

            <div class="homeprograms-section catchup-programs-section">
                <div class="title-section">
                    <h3>Catch Up‎</h3>
                    {{--<div class="clearfix-mobo"></div>--}}
                    <label for="channels-dropdown" style="display: none">Channel dropdown</label>
                    <select id="channels-dropdown" class="form-control viewall-dropdown">
                        <option value="">{{ trans('content.whole.view_all') }}</option>
                        @if(isset($channels))
                            @foreach($channels as $item)
                                @if($item->premuim != 1 && $item->catchup == 1)
                                    <?php
                                    if(Session::get('lang') == 'ar'){
                                        $title = $item -> title_ar;
                                    }else{
                                        $title = $item -> title_en;
                                    }
                                    ?>
                                    <option value="{{$item->id}}">{{$title}}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    <label for="dates-dropdown"  style="display: none"> Dates dropdown</label>
                    <select id="dates-dropdown" class="form-control viewall-dropdown day-dropdown">
                        <option value="{{date("Y-m-d")}}">{{ trans('content.whole.today') }}</option>
                        <option value="{{date("Y-m-d",strtotime("-1 days"))}}">{{date("m-d",strtotime("-1 days"))}}</option>
                        <option value="{{date("Y-m-d",strtotime("-2 days"))}}">{{date("m-d",strtotime("-2 days"))}}</option>
                    </select>
                    {{--<div class="clearfix hidden-lg hidden-md"></div>--}}
                </div>
                <div class="clearfix hidden-lg hidden-md"></div>
                <div id="catchup-data-section" class="data-section">
                    @include("home.home_catchup")
                </div>
            </div>




        </div>
        @if(isset($movies->videos) && is_array($movies->videos) && count($movies->videos) > 0)
        <div class="homeprogramssection-wrapper">
            <div class="container">

                <div class="homeprograms-section films-programs-section">
                    <div class="title-section">
                        <h3>{{ trans('content.whole.movies') }}</h3>
                        <a href="{{URL::to('show/allprograms/208109/'. trans('content.whole.movies') )}}" class="btn btn-awaanbluebtn btn-viewall">{{ trans('content.whole.show_more') }}</a>
                    </div>
                    <div class="clearfix hidden-lg hidden-md"></div>
                    <div class="data-section">
                        <div id="films-carousel" class="owl-carousel data-carousel films-carousel">
                            @foreach($movies->videos as $item)
                                {{--*/ $img = config('mangoapi.mangodcn').$item->img;/*--}}
                                <?php
                                    $title = (Session::get('lang') == 'ar')?$item->title_ar:$item->title_ar;
                                ?>
                            <div class="item">
                                    <a href="{{URL::to("movie/{$item->id}/".\App\Helpers\Functions::cleanurl($title))}}">
                                    <p style="display: none">hidden</p>
                                        <div class="embed-responsive-item img-div" style="background-image: url('{{$img}}');"></div>
                                </a>
                                <div class="content">
                                        <h4 class="name"><a href="{{URL::to("movie/{$item->id}/".\App\Helpers\Functions::cleanurl($title))}}?">{{$title}}</a></h4>
                                        <p class="category">{{$item->tags}}</p>
                                        <span class="time">{{date('h\h i\m ',$item->duration)}}</span>
                                </div>
                            </div>
                            @endforeach
                                </div>
                            </div>
                                </div>
                            </div>
                                </div>
        @endif
    </div>
    <!--  HOME PROGRAMS SECTION WRAPPER [END]		-->
    <!--  DISTINCTIVE PROGRAMS SECTION WRAPPER [START]		-->
    <div class="distinctiveprogramssection-wrapper">
        <div class="container">

            <div class="homeprograms-section distinctive-programs-section">
                <div class="title-section">
                    <h3>{{ trans('content.whole.special_programs') }}</h3>
                </div>
                <div class="data-section">
                    <div id="distinctive-carousel" class="owl-carousel data-carousel distinctive-carousel">
                        @if(isset($home_data->featured_shows) && is_array($home_data->featured_shows))
                            <?php $first = true; ?>

                            @foreach($home_data->featured_shows as $item)
                                    <?php
                                    if(Session::get('lang') == 'ar'){
                                        $channel_title = $item->channel_title;
                                    }else{
//                                        $channel_title = $item->channel_title;
                                        $channel_title = $item->channel_title_en;
                                    }
                                    ?>
                                {{--*/ $img = config('mangoapi.mangodcn').$item->thumbnail;/*--}}
                                <div class="item">
                                    <a href="javascript:void(0)#{{$item -> id}}" class="{{$first?"selected":""}}" data-id="program-{{$item -> id}}">
                                        <p style="display: none">{{$channel_title}}</p>
                                    	<div class="embed-responsive-item img-div" style="background-image: url('{{$img}}');"></div>
                                        {{--<img src="{{$img}}" />--}}
                                        {{--<span class="badge badge-noordubaifm badge-{{$item->channel_id}}" data-color="{{$item->channel_id}}">{{$channel_title}}</span>--}}
                                    </a>
                                </div>
                                <?php $first = false; ?>
                            @endforeach
                        @endif
                    </div>

                    <div class="content-text-wrapper">
                        @if(isset($home_data->featured_shows) && is_array($home_data->featured_shows))
                            @foreach($home_data->featured_shows as $item)
                                <?php
                                if(Session::get('lang') == 'ar'){
                                    $title = $item->title_ar;
                                    $cat_title = $item->cat_title;
                                    $desc = $item->desc_ar;
                                    $back_over = asset('images/bg-showpage-banner.png');
                                }else{
                                    $title = $item->title_en;
                                    $cat_title = $item->cat_title_en;
                                    $desc = $item->desc_en;
                                    $back_over = asset('images/bg-showpage-banner-en.png');
                                }
                                ?>
                                {{--*/ $cover = config('mangoapi.mangodcn').$item->cover;/*--}}
                                <div id="program-{{$item->id}}" style="background-image: url({{$back_over}}),url({{$cover}}), url(../images/overlay-programs-details.png);" class="distinctive-programs-details">
                                    <div class="program-title">
                                        <span class="program-title-span">{{$title}}</span>
                                        {{--<i class="fa fa-star active"></i>--}}
                                        {{--<i class="fa fa-star active"></i>--}}
                                        {{--<i class="fa fa-star active"></i>--}}
                                        {{--<i class="fa fa-star active"></i>--}}
                                        {{--<i class="fa fa-star"></i>--}}
                                    </div>
                                    <div class="program-details col-md-6">
                                        <p>{{$desc}}</p>
                                        <div class="link-section">
                                            <?php
                                            $uid = Session::get('user_info');
                                            ?>
                                            <a href="{{URL::to("show/{$item->id}/".\App\Helpers\Functions::cleanurl($title))}}" class="watch-now-link">{{ trans('content.whole.watch_now') }}</a>
                                            <a href="{{URL::to("show/allprograms/{$item->cat_id}/".\App\Helpers\Functions::cleanurl($cat_title))}}" class="more-programs-link">{{ trans('content.whole.more_programs') }}</a>
                                            @if(Session::has('user_info'))
                                                @if(isset($item->faved_id) and !empty($item->faved_id))
                                                    <a href="#" class="add-to-my-link favadd favorited" data-channeluserid="<?=$uid->id?>"    data-lang="{{Session::get('lang')}}" data-id="{{$item->id}}">{{ trans('content.whole.delete_from_list') }}</a>
                                                @else
                                                    <a href="#" class="add-to-my-link favadd" data-channeluserid="<?=$uid->id?>"    data-lang="{{Session::get('lang')}}" data-id="{{$item->id}}">{{ trans('content.whole.add_to_list') }}</a>
                                                @endif
                                                <div id="rateYo-{{$item->id}}" data-lang="{{Session::get('lang')}}" data-id="{{$item->id}}" data-channeluserid="<?=$uid->id?>"></div>
                                                    <script>
                                                        $(function () {
                                                            $("#rateYo-{{$item->id}}").rateYo({
                                                                rating: {{(isset($item->rate_value) and !empty($item->rate_value))?$item->rate_value:"0"}},
                                                                numStars: 5,
                                                                precision: 0,

                                                                starWidth: "20px",
                                                                spacing: "0px",
                                                                multiColor: {

                                                                    startColor: "#318ecd",
                                                                    endColor  : "#318ecd"
                                                                },
                                                                onSet: function (rating, rateYoInstance) {
                                                                    console.log(rateYoInstance);
                                                                    var id = $(rateYoInstance.node).data("id");
                                                                    var channeluserid = $(rateYoInstance.node).data("channeluserid");

                                                                    jQuery.post("http://admin.mangomolo.com/analytics/index.php/plus/rateit", {
                                                                        rated_id: id,
                                                                        rate_value: rating,
                                                                        channel_userid: channeluserid,
                                                                        user_id: 71,
                                                                        key:'e2c420d928d4bf8ce0ff2ec1',
                                                                    }).done(function (data) {

                                                                    });
                                                                }
                                                            });
                                                        });
                                                    </script>
                                            @else
                                                    <a href="<?=URL::to('auth/login')?>#{{$item->id}}" class="add-to-my-link">{{ trans('content.whole.add_to_list') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- 	 DISTINCTIVE PROGRAMS SECTION WRAPPER [END]		-->

@endsection

@section("additional_scripts")
    <script type="text/javascript">

        jQuery(document).ready( function() {

            jQuery('#homebanner-carousel').owlCarousel({
                navText   : ['',''],
                rtl       : true,
                loop      : true,
                margin    : 5,
                nav       : true,
                responsive: {
                    0:{
                        items:1
                    },
                    400:{
                        items:2
                    },
                    767:{
                        items:2
                    },
                    991:{
                        items:3
                    },
                    1200:{
                        items:3
                    }
                }
            });

            jQuery('#channel-carousel').owlCarousel({
                navText   : ['',''],
                rtl       : true,
                loop      : true,
                margin    : 25,
                nav       : true,
                responsive: {
                    0:{
                        items:1
                    },
                    400:{
                        items:4
                    },
                    767:{
                        items:5
                    },
                    991:{
                        items:6
                    },
                    1200:{
                        items:7
                    }
                }
            });

            jQuery('#series-carousel').owlCarousel({
                /*autoplay  : true,
                 autoplayTimeout: 3000,
                 autoplayHoverPause: true,
                 autoplaySpeed: false,*/
                dots: false,
                nav: false,
                navText   : ['',''],
                rtl       : true,
                loop      : true,
                margin    : 15,
                responsive: {
                    0:{
                        items:2
                    },
                    400:{
                        items:3
                    },
                    767:{
                        items:4
                    },
                    991:{
                        items:4
                    },
                    1200:{
                        items:4
                    }
                }
            });
            jQuery('#recommended-carousel').owlCarousel({
                /*autoplay  : true,
                 autoplayTimeout: 3000,
                 autoplayHoverPause: true,
                 autoplaySpeed: false,*/
//                dots: false,
                dots: false,
                nav: false,
                navText   : ['',''],
                rtl       : true,
                loop      : true,
                margin    : 15,
                responsive: {
                    0:{
                        items:2
                    },
                    400:{
                        items:3
                    },
                    767:{
                        items:4
                    },
                    991:{
                        items:4
                    },
                    1200:{
                        items:4
                    }
                }
            });

            jQuery('#last-additions-carousel').owlCarousel({
                dots: false,
                nav: false,
                navText   : ['',''],
                rtl       : true,
                loop      : true,
                margin    : 15,
                responsive: {
                    0:{
                        items:2
                    },
                    400:{
                        items:3
                    },
                    767:{
                        items:4
                    },
                    991:{
                        items:4
                    },
                    1200:{
                        items:4
                    }
                }
            });


            jQuery('#resume-carousel').owlCarousel({
                dots: false,
                nav: false,
                navText   : ['',''],
                rtl       : true,
                loop      : true,
                margin    : 15,
                responsive: {
                    0:{
                        items:2
                    },
                    400:{
                        items:3
                    },
                    767:{
                        items:4
                    },
                    991:{
                        items:4
                    },
                    1200:{
                        items:4
                    }
                }
            });

            jQuery('#catchup-carousel').owlCarousel({
                /*autoplay  : true,
                 autoplayTimeout: 3000,
                 autoplayHoverPause: true,
                 autoplaySpeed: false,*/
                dots: false,
                nav: false,
                navText   : ['',''],
                rtl       : true,
                loop      : true,
                margin    : 15,
                responsive: {
                    0:{
                        items:2
                    },
                    400:{
                        items:2
                    },
                    767:{
                        items:3
                    },
                    991:{
                        items:4
                    },
                    1200:{
                        items:4
                    }
                }
            });

            jQuery('#films-carousel').owlCarousel({
                dots: false,
                nav: false,
                navText   : ['',''],
                rtl       : true,
                loop      : false,
                margin    : 15,
                responsive: {
                    0:{
                        items:2
                    },
                    400:{
                        items:3
                    },
                    767:{
                        items:4
                    },
                    991:{
                        items:4
                    },
                    1200:{
                        items:4
                    }
                }
            });

            jQuery('.distinctive-carousel').owlCarousel({
                nav: false,
                navText   : ['',''],
                rtl       : true,
                loop      : true,
                margin    : 15,
                responsive: {
                    0:{
                        items:2
                    },
                    400:{
                        items:3
                    },
                    767:{
                        items:4
                    },
                    991:{
                        items:4
                    },
                    1200:{
                        items:4
                    }
                }
            });

            @if(isset($home_data->featured_shows) && is_array($home_data->featured_shows) && count($home_data->featured_shows) > 0)
                jQuery('.distinctive-programs-section .content-text-wrapper #program-{{$home_data->featured_shows[0]->id}}').addClass('selected');
            @endif

            jQuery('#distinctive-carousel .owl-item .item a').click( function(){

                jQuery('#distinctive-carousel .owl-item .item a').removeClass('selected');
                jQuery(this).addClass('selected');

                var dataID = jQuery(this).attr('data-id');
                jQuery('.distinctive-programs-section .content-text-wrapper .distinctive-programs-details').removeClass('selected');
                jQuery('.distinctive-programs-section .content-text-wrapper #'+dataID).addClass('selected');

            });

            //here update catchup logic.
            var channel = "";
            var date = "{{date("Y-m-d")}}";
            var update_data = function () {
                $("#catchup-data-section").html('<img src="{{asset("images/loading_icon.gif")}}" style="margin-right: 40%;" alt="Loding">');

                $.get( "{{URL::to("get_catchup_items")}}", {date: date, channel_id: channel},function( data ) {
                    $("#catchup-data-section").html( data );

                    jQuery('#catchup-carousel').owlCarousel({
                        /*autoplay  : true,
                         autoplayTimeout: 3000,
                         autoplayHoverPause: true,
                         autoplaySpeed: false,*/
                        dots: false,
                        nav: false,
                        navText   : ['',''],
                        rtl       : true,
                        loop      : true,
                        margin    : 15,
                        responsive: {
                            0:{
                                items:2
                            },
                            400:{
                                items:2
                            },
                            767:{
                                items:3
                            },
                            991:{
                                items:4
                            },
                            1200:{
                                items:4
                            }
                        }
                    });
                });
            };

            $( "#channels-dropdown" ).change(function() {
                channel = $( "#channels-dropdown" ).val();
                update_data();
            });
            $( "#dates-dropdown" ).change(function() {
                date = $( "#dates-dropdown" ).val();
                update_data();
            });


            jQuery('.ratthisshow').click(function (e) {
                console.log('rated');
                var htmltext = '';
                if(jQuery(this).hasClass('ratedshow')) {
                    jQuery(this).html('');
                    jQuery(this).removeClass('ratedshow');
                    htmltext = 'Rate this show';
                    if(jQuery(this).data('lang') == 'ar') {
                        htmltext = 'تقييم هذا العرض';
                    }
                    jQuery(this).html(htmltext);
                } else {
                    jQuery(this).find('button').html('');
                    htmltext = 'Unrate';
                    if(jQuery(this).data('lang') == 'ar') {
                        htmltext = 'الغاء التقييم';
                    }
                    jQuery(this).html(htmltext);
                    jQuery(this).addClass('ratedshow');
                }
                jQuery.post("http://admin.mangomolo.com/analytics/index.php/plus/rateit", {
                    rated_id: jQuery(this).data('id'),
                    rate_value: 5,
                    channel_userid: jQuery(this).data('channeluserid'),
                    user_id: 71,
                    key:'e2c420d928d4bf8ce0ff2ec1',
                }).done(function (data) {

                });
                return false;
            });
            jQuery('.favadd').click(function (e) {
                console.log('add');
                var htmltext = '';
                if(jQuery(this).hasClass('favorited')) {
                    jQuery(this).html('');
                    jQuery(this).removeClass('favorited');
                    htmltext = 'Favorites';
                    if(jQuery(this).data('lang') == 'ar') {
                        htmltext = 'أضف إلى قائمتي';
                    }
                    jQuery(this).html(htmltext);
                } else {
                    jQuery(this).find('button').html('');
                    htmltext = 'Remove Favorites';
                    if(jQuery(this).data('lang') == 'ar') {
                        htmltext = 'حذف من قائمتي';
                    }
                    jQuery(this).html(htmltext);
                    jQuery(this).addClass('favorited');
                }
                jQuery.post("http://admin.mangomolo.com/analytics/index.php/plus/favor", {
                    faved_id: jQuery(this).data('id'),
                    channel_userid: jQuery(this).data('channeluserid'),
                    user_id: 71
                }).done(function (data) {

                });
                return false;
            });
        });

    </script>
@endsection
