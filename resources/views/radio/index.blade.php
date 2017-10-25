<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/18/2017
 * Time: 10:21 AM
 */
?>
@extends('layouts.master')
@section('title', ((Session::get('lang') == 'ar')?$current_channel->title_ar:$current_channel->title_en)." - ".trans('content.allshows.livestream'))
@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title'=>((Session::get('lang') == 'ar')?$current_channel->title_ar:$current_channel->title_en)." - ".trans('content.allshows.livestream'),
        'current_description'=>"Audio on Demand - AWAAN",
    ])
@endsection




@section('main-content')
    <h1 style="display: none;">Awaan</h1>
    <h2 style="display: none;">Awaan</h2>
<!-- 	 RADIO LIST OF SHOWS WRAPPER [START]		-->
    {{--<style>--}}
        {{--.select2-container--default .select2-results__option--highlighted[aria-selected]{--}}
            {{--background-color: #f05e22 !important;--}}
        {{--}--}}
        {{--.select2-dropdown{--}}
            {{--border-left-color: #f05e22 !important;--}}
            {{--border-right-color: #f05e22 !important;--}}
        {{--}--}}
        {{--.select2-container--default.select2-container--focus .select2-selection--multiple--}}
        {{--{border:solid black 1px;outline:0}--}}
        {{--.select2-container--classic .select2-selection--single:focus{border:1px solid #f05e22 !important;}--}}
        {{--.select2-container--classic.select2-container--open .select2-selection--single{border:1px solid #f05e22 !important;}--}}
        {{--.select2-container--classic .select2-selection--multiple:focus{border:1px solid #f05e22 !important;}--}}
        {{--.select2-container--classic.select2-container--open .select2-selection--multiple{border:1px solid #f05e22 !important;}--}}
        {{--.select2-container--classic.select2-container--open .select2-dropdown{border-color:#f05e22 !important;}--}}
        {{----}}
        {{--.nicescroll-rails .nicescroll-cursors { background-color: #f05e22 !important; border-color:#f05e22 !important;}--}}
        {{----}}
    {{--</style>--}}
<div class="radio-home-listof-shows" style=" min-height: 800px;">
    <div class="container">
        <div class="radio-menu-header-wrapper">
            <div class="row">
                {{--<div class="col-lg-1 col-md-2 col-sm-2 col-xs-3">--}}
                    {{--<div class="logo-div">--}}
                        {{--<img src="{{config('mangoapi.mangodcn').$current_channel->thumbnail}}" class="img-responsive" />--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="menu-div">
                        @include("radio.nav")
                    </div>
                </div>
            </div>
        </div>

        <div class="radio-player-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="player-div">
                        <div class="inline-block" style="/*background-color: #f15f23 ;*/ background-color: black ;height: 155px">
                            <div style="height: 85px">
                                <div class="logo-div row scaleZoomImg2" style="height:80px">
                                    <div class="col-md-2">
                                        <img style="vertical-align: baseline; margin-top: 10px; padding-right:10px; padding-left: 10px; height: 55px;" src="{{config('mangoapi.mangodcn').$current_channel->thumbnail}}" class="img-responsive" alt="{{$current_channel->title_ar}}"/>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>{{$current_channel->title_ar}}</h3>
                                    </div>
                                </div>
                                <div class="audio_live_area">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="radio-current-programs-div">
                        <div class="row">
                            @if(isset($live_radio->now) && isset($live_radio->now[0]))
                                <?php
                                    $img = "";
                                    if(isset($live_radio->now[0]->img)){
                                        $img= $live_radio->now[0]->img;
                                        if($current_channel->id == "84" && !\App\Helpers\Functions::isValidURL($img)) $img = "http://www.dmi.ae/noordubai/".$img;
                                        $img = (\App\Helpers\Functions::isImageFile($img) and \App\Helpers\Functions::isValidURL($img))
                                            ? $img : asset("images/image-not-available.jpg");
                                    }

                                ?>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="program-div on-air-div scaleZoomImg">
                                        <div class="embed-responsive-item img-div top-section" style="background-image: url('{{$img}}');">
                                            <div class="highlight"><p class="kh-ellipsis"><span>{{trans("content.radio.airing_now")}}</span>{{$live_radio->now[0]->title_en}}</p></div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(isset($live_radio->next) && isset($live_radio->next[0]))
                                <?php
                                if(isset($live_radio->next[0]->img)){
                                    $img=$live_radio->next[0]->img;
                                    if($current_channel->id == "84" && !\App\Helpers\Functions::isValidURL($img)) $img = "http://www.dmi.ae/noordubai/".$img;
                                    $img = (\App\Helpers\Functions::isImageFile($img) and \App\Helpers\Functions::isValidURL($img))
                                            ? $img : asset("images/image-not-available.jpg");
                                }
                                ?>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="program-div on-air-div scaleZoomImg">
                                        <div class="embed-responsive-item img-div top-section" style="background-image: url('{{$img}}');">
                                            <div class="highlight"><p class="kh-ellipsis"><span>{{trans("content.radio.next")}}</span>{{$live_radio->next[0]->title_en}}</p></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="radio-programs-section radio-catchup-section clearfix">
            <div class="title-section">
                <h3>Catch Up</h3>
                <label for="dates-dropdown" style="display: none">dates dropdown</label>
                <select id="dates-dropdown" class="btn-awaanbluebtn select-box">
                    <option value="<?=date("Y-m-d")?>">{{ trans('content.whole.today') }}</option>
                    <option value="{{date("Y-m-d",strtotime("-1 days"))}}">{{date("m-d",strtotime("-1 days"))}}</option>
                    <option value="{{date("Y-m-d",strtotime("-2 days"))}}">{{date("m-d",strtotime("-2 days"))}}</option>
                    <option value="{{date("Y-m-d",strtotime("-3 days"))}}">{{date("m-d",strtotime("-3 days"))}}</option>
                </select>
            </div>
            <div class="content-section">
                <div id="catchup-data-section" class="">
                    @include("radio.list_catchup")
                </div>
            </div>
        </div>

        <div class="radio-programs-section radio-ourprograms-section">
            <div class="title-section">
                <h3>{{ trans('content.allshows.our_shows') }}</h3>
            </div>
            <div class="content-section">
                <div class="row">
                    @if(isset($featured_shows) && isset($featured_shows->results) && is_array($featured_shows->results))
                        <?php
                        $count = 0;
                        ?>
                        @foreach($featured_shows->results as $item)
                            <?php $count++;?>
                            {{--*/ $img = (!empty($item->thumbnail))?config('mangoapi.mangodcn').$item->thumbnail:asset("images/image-not-available.jpg");/*--}}
                            <div class="col-md-3 col-sm-6 col-xs-6 @if($count > 4) hidden-load-more @endif">
                                <div class="program-div scaleZoomImg">
                                    <a href="{{URL::to("radio/show/{$current_channel->id}/{$item->id}/".\App\Helpers\Functions::cleanurl((Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en))}}?">
{{--                                        <img src="{{$img}}" class="img-responsive" alt="{{$item -> title_en}}"/>--}}
                                        <p style="display: none;">{{$item -> title_en}}</p>
                                        <div class="embed-responsive-item image-div lazy-image-handler"  data-src="{{$img}}"  style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                    </a>
                                    <div class="content-div radio">
                                        <a href="{{URL::to("radio/show/{$current_channel->id}/{$item->id}/".\App\Helpers\Functions::cleanurl((Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en))}}" class="program-title">{{(Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en}}</a>
                                        @if(isset($item->show_times) && is_array($item->show_times) && count($item->show_times) > 0)
                                            @foreach($item->show_times as $time)
                                                <span class="timing-span">UAE - {{\App\Helpers\Functions::convertFormat($time->show_time)}}</span>
                                                <span class="timing-span border">GMT - {{\App\Helpers\Functions::convertToGMTime($time->show_time)}}</span>
                                                <p class="fequency">{{trans('content.radio.view')}} - {{trans('content.radio.'.$time->day)}}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="loadmore-div text-center">
                <button class="btn btn-awaanbluebtn btn-viewall" id="show-more">{{ trans('content.whole.show_more') }}</button>
            </div>
        </div>

    </div>
</div>
<!-- 	 RADIO LIST OF SHOWS WRAPPER [START]		-->
@endsection

@section("additional_scripts")
    <script>
        jQuery(document).ready( function() {
//            jQuery('#channel-carousel').owlCarousel({
//                navText   : ['',''],
//                rtl       : true,
//                loop      : false,
//                margin    : 25,
//                nav       : true,
//                responsive: {
//                    0:{
//                        items:2
//                    },
//                    400:{
//                        items:5
//                    },
//                    767:{
//                        items:7
//                    },
//                    991:{
//                        items:8
//                    },
//                    1200:{
//                        items:9
//                    }
//                }
//            });

//            jssor_1_slider_init = function() {
//
//                var jssor_1_SlideshowTransitions = [
//                    {$Duration:800,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//                    {$Duration:800,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
//                ];
//
//                var jssor_1_options = {
//                    $AutoPlay: 1,
//                    $Align: 0,
//                    $SlideshowOptions: {
//                        $Class: $JssorSlideshowRunner$,
//                        $Transitions: jssor_1_SlideshowTransitions,
//                        $TransitionsOrder: 1
//                    },
//                    $ArrowNavigatorOptions: {
//                        $Class: $JssorArrowNavigator$
//                    },
//                    $ThumbnailNavigatorOptions: {
//                        $Class: $JssorThumbnailNavigator$,
//                        $Cols: 5,
//                        $SpacingX: 5,
//                        $SpacingY: 5,
//                        $Align: 390
//                    }
//                };
//
//                var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
//
//                /*#region responsive code begin*/
//
//                var MAX_WIDTH = 980;
//
//                function ScaleSlider() {
//                    var containerElement = jssor_1_slider.$Elmt.parentNode;
//                    var containerWidth = containerElement.clientWidth;
//
//                    if (containerWidth) {
//
//                        var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
//
//                        jssor_1_slider.$ScaleWidth(expectedWidth);
//                    }
//                    else {
//                        window.setTimeout(ScaleSlider, 30);
//                    }
//                }
//
//                ScaleSlider();
//
//                $Jssor$.$AddEvent(window, "load", ScaleSlider);
//                $Jssor$.$AddEvent(window, "resize", ScaleSlider);
//                $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
//                /*#endregion responsive code end*/
//            };
//
//        jssor_1_slider_init();


            jQuery('#show-more').click(function (e) {
                jQuery(this).css('display','none');
                jQuery('.hidden-load-more').each(function(i, obj) {
                    jQuery(this).removeClass('hidden-load-more');
                });
                setTimeout(function() {
                    $("body").getNiceScroll().resize();
                }, 100);
            });
        });
            var media_id,media_signature,embed_attributes,live_attributes,video_player,video_paused,live_player,live_paused;
//            var live_player = new playerjs.Player($("#live_embedd")[0]);
//            var video_player = new playerjs.Player($("#video_embedd")[0]);

            function player_loader() {
                $('#video_embed_player').html('<div class="row video_loader text-center" style="color: #FFF"><i class="fa fa-refresh"></i> <span>جاري التحميل..</span></div>');
            }

            function playerCatchup() {
                $(document).find(".audio_media").on('click',function(e){

                    e.preventDefault();

                    var playbtn = $(this).find("span > i");
//
                    if(playbtn.hasClass('fa-pause')) {
                        $(this).find('i').removeClass('fa-pause').addClass('fa-play-circle');
                        $('#video_embedd').attr('src', '');
                        $('#video_embedd').hide();
                        return false;
                    }

                    $('#catchup-data-section').find(".audio_media > span > i").removeClass('fa-pause').addClass('fa-play-circle');
                    $('#catchup-data-section').find(".audio_media").closest('.content-div').removeClass('program-active');


                    playbtn.removeClass('fa-play-circle').addClass('fa-pause');
                    playbtn.closest('.content-div').addClass('program-active');

                    media_id = $(this).data('id');
                    media_signature = $(this).data('signature');

                    if(!playbtn.hasClass('fa-pause')) {
                        $('#video_embedd').attr('src', '');
                        $('#video_embedd').hide();
                    }else{
                        $('#video_embedd').attr('src', 'http://player.mangomolo.com/dev/audio?id='+media_id+'&user_id=71&countries=Q0M=&zone=&filter=DENY&autoplay=false&signature='+media_signature);
                        $('#video_embedd').show();
                        $('#video_embedd').ready(function(){
                            $('#video_embed_player').find('.video_loader').remove();
                            video_player = new playerjs.Player($("#video_embedd")[0]);
                            video_player.on('ready', function(){
                                live_player.getPaused(function(value){
                                    if(!value){
                                        live_player.pause();
                                    }
                                });
                            });
//                            $('#live_embedd').attr('src', $('#live_embedd').attr('src')+'&autoplay=false');
                        });
                    }

                });
            }

            function playerInit() {

                {{--@if(isset($catchup[0]->id))--}}
                {{--embed_attributes = {--}}
                    {{--src: 'http://player.mangomolo.com/dev/audio?id={{$catchup[0]->id}}&user_id=71&countries=Q0M=&zone=&filter=DENY&autoplay=false&signature={{$catchup[0]->signature}}',--}}
                    {{--id: 'video_embedd', frameborder: 0,--}}
                    {{--style: 'border: 0; overflow: hidden; width: 100%'--}}
                {{--};--}}


                {{--live_attributes = {--}}
                    {{--src: 'http://player.mangomolo.com/dev/audio?id={{$catchup[0]->id}}&user_id=71&countries=Q0M=&zone=&filter=DENY&autoplay=false&signature={{$catchup[0]->signature}}',--}}
                    {{--id: 'video_embedd', frameborder: 0,--}}
                    {{--style: 'border: 0; overflow: hidden; height: 70px; width: 100%'--}}
                {{--};--}}
                {{--@else--}}

                embed_attributes = {
                        src: '',
                        id: 'video_embedd', frameborder: 0,
                        style: 'border: 0; overflow: hidden; width: 100%'
                    };
                {{--@endif--}}

                setTimeout(function(){
                    $('#video_embed_player').html( $('<iframe />').attr(embed_attributes) );
                    $('#video_embedd').ready(function(){
                        video_player = new playerjs.Player($("#video_embedd")[0]);
                        video_player.on('ready', function(){
                            video_player.getPaused(function(value){
                                video_paused = value;
                            });
                        });
                    });
//                    $('.audio_live_area').append( $('<iframe />').attr(live_attributes) );

                },500);

//                $('#catchup-data-section > div:first-child').find(".audio_media > span > i").removeClass('fa-play-circle').addClass('fa-pause');

            }

            function livePlayerInit() {

                @if(isset($current_channel->id))
                @php
                    $channel_id = base64_encode($current_channel->id);
                    $user_id = base64_encode($current_channel->user_id);
                @endphp
                live_attributes = {
                    src: 'http://player.mangomolo.com/dev/audiolive?id={{$user_id}}&channelid={{$channel_id}}&countries=QUQ=&w=100%25&h=100%25&filter=DENY&signature={{$current_channel->signature}}&autoplay=true',
                    id: 'live_embedd', frameborder: 0,
                    style: 'border: 0; overflow: hidden; height: 70px; width: 100%'
                };

                setTimeout(function(){
                    $('.audio_live_area').append( $('<iframe />').attr(live_attributes) );
                    $('#live_embedd').ready(function(){
                        live_player = new playerjs.Player($("#live_embedd")[0]);
                        live_player.on('ready', function(){

                        });
                        live_player.on('play', function(){
                            video_player.pause();
                        }, this);
                    });
                },500);

                @endif
            }

            player_loader();

            playerInit();

            playerCatchup();

            livePlayerInit();

        var date = "{{date("Y-m-d")}}";
        var update_data = function () {
            $("#catchup-data-section").html('<img src="{{asset("images/loading_icon.gif")}}" style="margin-right: 40%;" alt="Loding">');

            $.get( "{{Request::url()}}", {date: date},function( data ) {
                $("#catchup-data-section").html( data );
                jQuery(".lazy-image-handler").Lazy({
                    onFinishedAll: function() {
                        jQuery(this).removeData("src");
                        jQuery(this).addClass("loaded");
                    }
                });
                setTimeout(function() {
                    $("body").getNiceScroll().resize();
                }, 1000);
                playerCatchup();
            });
        };
        $( "#dates-dropdown" ).change(function() {
            date = $( "#dates-dropdown" ).val();
            update_data();
        });

    </script>
@endsection
