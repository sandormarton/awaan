@extends('layouts.master')
@section('title', trans('content.pagetitle.catchup')." - ".((Session::get('lang') == 'en')?((!is_null($video) && isset($video->id) && $video->id)?$video->title_en:$channel->title_en):((!is_null($video) && isset($video->id) && $video->id)?$video->title_ar:$channel->title_ar)))
<!--This defines a home  section which gets displayed via "yield" -->

@section('main-content')
<h1 style="display: none;">{{trans('content.pagetitle.catchup')." - ".((Session::get('lang') == 'en')?$channel->title_en:$channel->title_ar)}}</h1>
<h2 style="display: none;">{{trans('content.pagetitle.catchup')." - ".((Session::get('lang') == 'en')?$channel->title_en:$channel->title_ar)}}</h2>
<!-- MAIN CONTAINER [START] -->
<style>
    .radio-programs-section .content-section .program-div:hover .content-div,
    .radio-programs-section .content-section .program-div .content-div.active-content-div
    {
        background: #29799e;
        border-color: #6ca4bd;
    }
</style>
<div class=" catchupnew-page-wrapper">

    <div class="catchupchannels-list-wrapper">
        <div class="container">

            <div class="col-lg-8 col-md-9 center-col catchupchannels-col">
                <div id="catchupchannel-carousel" class="owl-carousel catchupchannel-carousel">
                    <?php $channel_name=''; ?>
                    @foreach($channels as $index => $info)
                        {{--*/ $info->title_slug = \App\Helpers\Functions::cleanurl($info->title_en) /*--}}
                        @if($info->premuim != 1 && $info->catchup == 1)
                            <div class="item @if($info->id == Request::segment(2)) current-channel @endif">
                                <a href="{{URL::to("catchup/{$info->id}/{$info->title_en}")}}?">
                                    <div class="channel-div channel-sama-div">
                                        <img src="http://admin.mangomolo.com/analytics/{{$info->icon}}" alt="{{$info->title_en}}"/>
                                        <span class="overlay"></span>
                                    </div>
                                </a>
                            </div>
                        @endif
                        <?php
                        if($info->id == Request::segment(2)){
                            if(Session::get('lang') == 'ar'){
                                $channel_name = $info->title_ar;
                            }else{
                                $channel_name = $info->title_en;
                            }
                        }
                        ?>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <div class="catchupvideo-wrapper">
        <div class="container">

            <div class="col-lg-9 col-md-9 center-col catchupvideo-col">
                <div class="catchupvideo-div">
                    <div class="embed-responsive embed-responsive-16by9">
                        @if(!is_null($video) && isset($video->id) && $video->id)
                            <iframe title="{{$video->title_ar}}" class="embed-responsive-item" id="video_player" src="http://player.mangomolo.com/v1/video?id={{$video->id}}&user_id={{$video->user_id}}&countries=Q0M=&w=100%25&h=100%25&filter=DENY&signature={{$video->signature}}" allowfullscreen></iframe>
                        @else
                            <iframe title="{{$channel->title_ar}}" class="embed-responsive-item" src="http://player.mangomolo.com/v1/live?id={{base64_encode($channel->user_id)}}&channelid={{base64_encode($channel->id)}}&countries=Q0M=&w=100%25&h=100%25&filter=DENY&signature={{$channel->signature}}" allowfullscreen></iframe>
                        @endif
                    </div>
                </div>
            </div>

            <div class="title-section clearfix">
                <h3 class="title">{{$channel_name}}</h3>
                <div class="select-box">
                    <label for="dat-selecter" style="display: none">date selecter</label>
                    <select class="btn-awaanbluebtn" id="dat-selecter">
                        <option value="1">{{trans('content.whole.today')}}</option>
                        <option value="2">{{date('d/m',strtotime("-1 days"))}}</option>
                        <option value="3">{{date('d/m',strtotime("-2 days"))}}</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

    <div class="container">

        <div class="radio-catchupshows-wrapper catchup-page-wrapper2">
            <div class="radio-programs-section">
                <div class="content-section">
                    <div class="row">
                        <div id="today-catchup">
                            <?php $i = 1;?>
                            @foreach($catchup->today_catch as $item)
                                @if($i > 8)
                                    <div class="today-catchup-more" style="display: none;">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="program-div scaleZoomImg">
                                                <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}?">
                                                    <p style="display: none">{{$channel->title_en}}</p>
                                                    {{--<img src="images/catchup-program-1.png" class="img-responsive" />--}}
                                                    <div class="embed-responsive-item img-div lazy-image-handler" data-src="{{$item->catchup_img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                                </a>
                                                <div class="content-div @if($item->id == Request::segment(4)) active-content-div @endif">
                                                    <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}" class="program-title">{{$item->title_ar}}</a>
                                                    <span class="timing-span">{{date("H:i", strtotime($item->start_time))}}</span>
                                                    {{--<span class="timing-span border">GMT - 00:00</span>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-3 col-sm-6">
                                        <div class="program-div scaleZoomImg">
                                            <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}?">
                                                <p style="display: none">{{$channel->title_en}}</p>
                                                {{--<img src="images/catchup-program-1.png" class="img-responsive" />--}}
                                                <div class="embed-responsive-item img-div lazy-image-handler" data-src="{{$item->catchup_img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                            </a>
                                            <div class="content-div @if($item->id == Request::segment(4)) active-content-div @endif">
                                                <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}" class="program-title">{{$item->title_ar}}</a>
                                                <span class="timing-span">{{date("H:i", strtotime($item->start_time))}}</span>
                                                {{--<span class="timing-span border">GMT - 00:00</span>--}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                               <?php $i++;?>
                            @endforeach
                        </div>

                        <div id="yesterday-catchup" style="display: none">
                            <?php $i = 1;?>
                            @foreach($catchup->yesterday as $item)
                                @if($i > 8)
                                    <div class="yesterday-catchup-more" style="display: none;">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="program-div scaleZoomImg">
                                                <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}?">
                                                    <p style="display: none">{{$channel->title_en}}</p>
                                                    {{--<img src="images/catchup-program-1.png" class="img-responsive" />--}}
                                                    <div class="embed-responsive-item img-div lazy-image-handler" data-src="{{$item->catchup_img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                                </a>
                                                <div class="content-div @if($item->id == Request::segment(4)) active-content-div @endif">
                                                    <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}" class="program-title">{{$item->title_ar}}</a>
                                                    <span class="timing-span">{{date("H:i", strtotime($item->start_time))}}</span>
                                                    {{--<span class="timing-span border">GMT - 00:00</span>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                <div class="col-md-3 col-sm-6">
                                    <div class="program-div scaleZoomImg">
                                        <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}?">
                                            <p style="display: none">{{$channel->title_en}}</p>
                                            {{--<img src="images/catchup-program-1.png" class="img-responsive" />--}}
                                            <div class="embed-responsive-item img-div lazy-image-handler" data-src="{{$item->catchup_img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                        </a>
                                        <div class="content-div @if($item->id == Request::segment(4)) active-content-div @endif">
                                            <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}" class="program-title">{{$item->title_ar}}</a>
                                            <span class="timing-span">{{date("H:i", strtotime($item->start_time))}}</span>
                                            {{--<span class="timing-span border">GMT - 00:00</span>--}}
                                        </div>
                                    </div>
                                </div>
                                @endif
                                    <?php $i++;?>
                            @endforeach
                        </div>

                        <div id="before-yesterday-catchup" style="display: none">
                            <?php $i = 1;?>
                            @foreach($catchup->b4yesterday as $item)
                                @if($i > 8)
                                    <div class="before-yesterday-catchup-more" style="display: none;">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="program-div scaleZoomImg">
                                                <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}?">
                                                    <p style="display: none">{{$channel->title_en}}</p>
                                                    {{--<img src="images/catchup-program-1.png" class="img-responsive" />--}}
                                                    <div class="embed-responsive-item img-div" style="background-image: url('{{$item->catchup_img}}');"></div>
                                                </a>
                                                <div class="content-div @if($item->id == Request::segment(4)) active-content-div @endif">
                                                    <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}" class="program-title">{{$item->title_ar}}</a>
                                                    <span class="timing-span">{{date("H:i", strtotime($item->start_time))}}</span>
                                                    {{--<span class="timing-span border">GMT - 00:00</span>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                <div class="col-md-3 col-sm-6">
                                    <div class="program-div scaleZoomImg">
                                        <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}?">
                                            <p style="display: none">{{$channel->title_en}}</p>
                                            {{--<img src="images/catchup-program-1.png" class="img-responsive" />--}}
                                            <div class="embed-responsive-item img-div lazy-image-handler" data-src="{{$item->catchup_img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                        </a>
                                        <div class="content-div @if($item->id == Request::segment(4)) active-content-div @endif">
                                            <a href="{{URL::to("catchup/$channel->id/$channel->title_en/$item->id")}}" class="program-title">{{$item->title_ar}}</a>
                                            <span class="timing-span">{{date("H:i", strtotime($item->start_time))}}</span>
                                            {{--<span class="timing-span border">GMT - 00:00</span>--}}
                                        </div>
                                    </div>
                                </div>
                                @endif
                                    <?php $i++;?>
                            @endforeach
                        </div>

                    </div>
                </div>



                {{--<div class="load-more-div">--}}
	                {{--<a href="#" class="btn btn-awaanbluebtn btn-viewall">عرض المزيد</a>--}}
                {{--</div>--}}
                <div class="load-more-div" id="today-catchup-more-btn">
                    <a href="#" class="btn btn-awaanbluebtn btn-viewall">عرض المزيد</a>
                </div>

                <div class="load-more-div" id="yesterday-catchup-more-btn" style="display: none">
                    <a href="#" class="btn btn-awaanbluebtn btn-viewall">عرض المزيد</a>
                </div>

                <div class="load-more-div" id="before-yesterday-catchup-more-btn" style="display: none">
                    <a href="#" class="btn btn-awaanbluebtn btn-viewall">عرض المزيد</a>
                </div>
        </div>
        </div>

    </div>
</div>
@endsection
<!-- MAIN CONTAINER [END] -->
@section("additional_scripts")
    <script type="text/javascript">

        jQuery(document).ready( function() {
            var t1=1;
            var t2=1;
            var t3=1;
            jQuery( "#dat-selecter" ).change(function() {
                jQuery('#today-catchup').css('display','none');
                jQuery('#yesterday-catchup').css('display','none');
                jQuery('#before-yesterday-catchup').css('display','none');
                if(jQuery(this).val() == 1){
                    if(t1 == 1){
                        jQuery('#today-catchup-more-btn').css('display','inherit');
                    }
                    jQuery('#yesterday-catchup-more-btn').css('display','none');
                    jQuery('#before-yesterday-catchup-more-btn').css('display','none');
                    jQuery('#today-catchup').css('display','inherit');
                }

                if(jQuery(this).val() == 2){
                    if(t2 == 1){
                        jQuery('#yesterday-catchup-more-btn').css('display','inherit');
                    }
                    jQuery('#before-yesterday-catchup-more-btn').css('display','none');
                    jQuery('#today-catchup-more-btn').css('display','none');
                    jQuery('#yesterday-catchup').css('display','inherit');
                }

                if(jQuery(this).val() == 3){
                    if(t3 == 1){
                        jQuery('#before-yesterday-catchup-more-btn').css('display','inherit');
                    }
                    jQuery('#yesterday-catchup-more-btn').css('display','none');
                    jQuery('#today-catchup-more-btn').css('display','none');
                    jQuery('#before-yesterday-catchup').css('display','inherit');
                }
                setTimeout(function() {
                    $("body").getNiceScroll().resize();
                }, 500);
            });
            jQuery('#today-catchup-more-btn').click(function (e) {
//                jQuery('#today-catchup-more').css('display','inherit');
                t1 = 2;
                $('.today-catchup-more').each(function(i, obj) {
                    jQuery(obj).css('display','inherit');
                    console.log('b')
                });
                jQuery(this).css('display','none');
                setTimeout(function() {
                    $("body").getNiceScroll().resize();
                }, 500);
                return false;
            });
            jQuery('#yesterday-catchup-more-btn').click(function (e) {
                t2 = 2;
//                jQuery('#yesterday-catchup-more').css('display','inherit');
                $('.yesterday-catchup-more').each(function(i, obj) {
                    jQuery(obj).css('display','inherit');
                    console.log('k')
                });
                jQuery(this).css('display','none');
                setTimeout(function() {
                    $("body").getNiceScroll().resize();
                }, 500);
                return false;
            });

            jQuery('#before-yesterday-catchup-more-btn').click(function (e) {
                t3 = 2;
//                jQuery('#before-yesterday-catchup-more').css('display','inherit');
                $('.before-yesterday-catchup-more').each(function(i, obj) {
                    jQuery(obj).css('display','inherit');
                    console.log('c')
                });
                jQuery(this).css('display','none');
                setTimeout(function() {
                    $("body").getNiceScroll().resize();
                }, 500);
                return false;
            });

        });jQuery(document).ready( function() {

            jQuery('#catchupchannel-carousel').owlCarousel({
                navText   : ['',''],
                <?php if(Session::get('lang') == 'ar'){ ?>
                	rtl : true,
                <?php } ?>
                loop      : true,
                margin    : 0,
                nav       : true,
                responsive: {
                    0:{
                        items:2
                    },
                    400:{
                        items:5
                    },
                    767:{
                        items:5
                    },
                    991:{
                        items:5
                    },
                    1200:{
                        items:5
                    }
                }
            });

        });

    </script>
@endsection
