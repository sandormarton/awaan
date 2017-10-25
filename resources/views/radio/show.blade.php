<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/26/2017
 * Time: 9:58 AM
 */
?>
@extends('layouts.master')
@section('title', ((Session::get('lang') == 'ar')?$content->cat->title_ar:$content->cat->title_en))
@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title'=>((Session::get('lang') == 'ar')?$content->cat->title_ar:$content->cat->title_en),
        'current_description'=>"Audio on Demand - AWAAN",
    ])
@endsection
@section('main-content')
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

        {{--.nicescroll-rails .nicescroll-cursors { background-color: #f05e22 !important; border-color:#f05e22 !important;}--}}
    {{--</style>--}}
    <h1 style="display: none">Awaan</h1>
    <h2 style="display: none">Awaan</h2>
    <div class="radio-home-listof-shows" style=" min-height: 800px;">
        <div class="container">

            <div class="radio-menu-header-wrapper">
                <div class="row">
                    <div class="col-lg-1 col-md-2 col-sm-3 col-xs-3">
                        <div class="logo-div">
                            <img src="{{config('mangoapi.mangodcn').$current_channel->thumbnail}}" class="img-responsive"  alt="Channel icon"/>
                        </div>
                    </div>
                    <div class="col-lg-11 col-md-10 col-sm-9 col-xs-9">
                        <div class="menu-div">
                            @include("radio.nav")
                        </div>
                    </div>
                </div>
            </div>

            <div class="radio-showdetails-wrapper">
                <?php
                $img = "";
                $img=((!empty($content->cat->cover))?config('mangoapi.mangodcn').$content->cat->cover:asset("images/cover-not-available.jpg"));
                ?>
                <div class="show-image-div scaleZoomImg2">
                    <img src="{{$img}}" class="img-responsive" alt="{{(Session::get('lang') == 'ar')?$content->cat->title_ar:$content->cat->title_en}}" />
                    <div class="overlay" style="background: url({{(Session::get('lang') == 'en')?asset('images/bg-showpage-banner-en.png'):asset('images/bg-showpage-banner.png')}}) repeat scroll 0 0 / cover;"></div>
                    <div class="show-content-div ">
                        <h3 class="title">{{(Session::get('lang') == 'ar')?$content->cat->title_ar:$content->cat->title_en}}</h3>
                        @if(isset($content->cat->show_times) && is_array($content->cat->show_times) && count($content->cat->show_times) > 0)
                            @foreach($content->cat->show_times as $time)
                                <div class="timing">
                                    <span>UAE - {{\App\Helpers\Functions::convertFormat($time->show_time)}}</span><span>GMT - {{\App\Helpers\Functions::convertToGMTime($time->show_time)}}</span>
                                </div>
                                <div class="frequency">{{trans('content.radio.view')}} - {{trans('content.radio.'.$time->day)}}</div>
                            @endforeach
                        @endif
                    </div>
                    @if(Session::has('user_info'))
                        <?php
                        $uid = Session::get('user_info');
                        ?>
                        <div class="audio-rate-like">
                            @if(isset($content->cat->faved_id) and !empty($content->cat->faved_id))
                                <a href="#" class="add-to-my-list favadd favorited" data-channeluserid="<?=$uid->id?>"    data-lang="{{Session::get('lang')}}" data-id="{{$content->cat->id}}">{{ trans('content.whole.delete_from_list') }}</a>
                            @else
                                <a href="#" class="add-to-my-list favadd" data-channeluserid="<?=$uid->id?>"    data-lang="{{Session::get('lang')}}" data-id="{{$content->cat->id}}">{{ trans('content.whole.add_to_list') }}</a>
                            @endif

                            <div id="rateYo" data-lang="{{Session::get('lang')}}" data-id="{{$content->cat->id}}" data-channeluserid="<?=$uid->id?>"></div>
                        </div>
                    @endif

                </div>

                <!-- PROGRAM-LIST-DIV [START] -->
                <div class="program-list-div">
                    @include("radio.list_audios")
                </div>
                <!-- PROGRAM-LIST-DIV [END] -->


                <div class="radio-programs-section radio-ourprograms-section">
                    <div class="title-section">
                        <h3>{{trans("content.radio.related_shows")}}‎</h3>
                        <button class="btn btn-awaanbluebtn btn-viewall" {{($load_more)?'':"style=display:none;"}}>المزيد</button>
                    </div>
                    <div class="content-section">
                        <div class="row">
                            @if(isset($content) && isset($content->also) && is_array($content->also))
                                @foreach($content->also as $item)
                                    {{--*/ $img = (!empty($item->thumbnail))?config('mangoapi.mangodcn').$item->thumbnail:asset("images/image-not-available.jpg");/*--}}
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <div class="program-div scaleZoomImg2">
                                            <a href="{{URL::to("radio/show/{$current_channel->id}/{$item->id}/".\App\Helpers\Functions::cleanurl((Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en))}}">
                                                <img src="{{$img}}" class="img-responsive " alt="{{(Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en}}"/>
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
                </div>
            </div>
        </div>
    </div>
    <!-- 	 RADIO LIST OF SHOWS WRAPPER [START]		-->
@endsection

@section("additional_scripts")
    <script>

        function player_loader() {
            $('#video_embed_player').append('<div class="row video_loader text-center" style="color: #FFF"><i class="fa fa-refresh"></i> <span>جاري التحميل..</span></div>');
        }

        $(document).ready( function() {

            @if(isset($content->audio[0]->id)){
                var player;

                var media_id,media_signature;

                player_loader();

                var attributes = {
                    src: 'http://player.mangomolo.com/dev/audio?id={{$content->audio[0]->id}}&user_id=71&countries=Q0M=&zone=&filter=DENY&autoplay=false&signature={{$content->audio[0]->signature}}',
                    id: 'video_embedd', frameborder: 0,
                    style: 'border: 0; overflow: hidden; width: 100%'
                };

                setTimeout(function(){
                    $('#video_embed_player').html( $('<iframe />').attr(attributes) );
                },500);

                $('.program-list:first-child').find(".audio_media").addClass('btn-pause');

                $(document).find(".audio_media").on('click',function(e){

//                e.preventDefault();

                    if($(this).hasClass('btn-pause')) {
                        $(this).toggleClass('btn-pause');
                        $('#video_embedd').attr('src', '');
                        $('#video_embedd').hide();
                        return false;
                    }
                    player_loader();

                    $('.program-list').find(".audio_media").removeClass('btn-pause');

                    $(this).toggleClass('btn-pause');

//                    player = new playerjs.Player($("#video_embedd")[0]);
                    media_id = $(this).data('id');
                    media_signature = $(this).data('signature');

                    if(!$(this).hasClass('btn-pause')) {
                        $('#video_embedd').attr('src', '');
                        $('#video_embedd').hide();
                    }else{
                        $('#video_embedd').attr('src', 'http://player.mangomolo.com/dev/audio?id='+media_id+'&user_id=71&countries=Q0M=&zone=&filter=DENY&autoplay=false&signature='+media_signature);
                        $('#video_embedd').show();
                        $('#video_embedd').ready(function(){
                            $('#video_embed_player').find('.video_loader').remove();
                        });
                    }

//                    player.on('ready', function(){
//                        console.log(media_id);
//
//                        if (player.supports('method', 'setMediaFile')){
//
//                            player.setMediaFile({video_id: media_id, signature: media_signature});
//                        }
//                    });


                });
            }
            @endif

        var page = 1;

        var update_data = function (append) {
            if(!append)
                $(".program-list-div").html('<img src="{{asset("images/loading_icon.gif")}}" style="margin-right: 40%;" alt="Loding">');

            $.get( "{{Request::url()}}", {page:page},function( data,textStatus, request ) {
                if(request.getResponseHeader('x-load-more') == ''){
                    $(".btn-viewall").css('display','none');
                }

                if(append)
                    $(".program-list-div").append( data );
                else
                    $(".program-list-div").html( data );
            });
        };

        $(".btn-viewall").click(function() {
            page += 1;
            update_data(true);
        });

            //Store frequently elements in variables
            var slider  = jQuery('#slider'),
                    tooltip = jQuery('.tooltip');

            //Hide the Tooltip at first
            tooltip.hide();

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
                    fav_type: 3,
                    user_id: 71
                }).done(function (data) {

                });
                return false;
            });

            @if(Session::has('user_info'))
            $("#rateYo").rateYo({
                rating: {{(isset($content->cat->rate_value) and !empty($content->cat->rate_value))?$content->cat->rate_value:"0"}},
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
                        rate_type: 3,
                        key:'e2c420d928d4bf8ce0ff2ec1',
                    }).done(function (data) {

                    });
                }
            });
            @endif

            //Call the Slider
//            slider.slider({
//                //Config
//                range: "min",
//                min: 1,
//                value: 35,
//
//                start: function(event,ui) {
//                    tooltip.fadeIn('fast');
//                },
//
//                //Slider Event
//                slide: function(event, ui) { //When the slider is sliding
//
//                    var value  = slider.slider('value'),
//                            volume = jQuery('.volume');
//
//                    tooltip.css('left', value).text(ui.value);  //Adjust the tooltip accordingly
//
//                    if(value <= 5) {
//                        volume.css('background-position', '0 0');
//                    }
//                    else if (value <= 25) {
//                        volume.css('background-position', '0 -25px');
//                    }
//                    else if (value <= 75) {
//                        volume.css('background-position', '0 -50px');
//                    }
//                    else {
//                        volume.css('background-position', '0 -75px');
//                    };
//                },
//
//                stop: function(event,ui) {
//                    tooltip.fadeOut('fast');
//                },
//            });
        });
    </script>
@endsection
