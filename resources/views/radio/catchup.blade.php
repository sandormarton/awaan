<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/18/2017
 * Time: 2:43 PM
 */
?>
@extends('layouts.master')
@section('title', ((Session::get('lang') == 'ar')?$current_channel->title_ar:$current_channel->title_en)." - Catch Up")
@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title'=>((Session::get('lang') == 'ar')?$current_channel->title_ar:$current_channel->title_en)." - Catch Up",
        'current_description'=>"Audio on Demand - AWAAN",
    ])
@endsection

@section('main-content')
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
    <!-- 	 RADIO LIST OF SHOWS WRAPPER [START]		-->
    <div class="radio-home-listof-shows" style=" min-height: 800px;">
        <div class="container">

            <div class="radio-menu-header-wrapper">
                <div class="row">
                    <div class="col-lg-1 col-md-2">
                        <div class="logo-div">
                            <img src="{{config('mangoapi.mangodcn').$current_channel->thumbnail}}" class="img-responsive" alt="Channel thumbnail" />
                        </div>
                    </div>
                    <div class="col-lg-11 col-md-10">
                        <div class="menu-div">
                            @include("radio.nav")
                        </div>
                    </div>
                </div>
            </div>

            <div class="radio-catchupshows-wrapper">
                <div class="radio-programs-section">
                    <div class="title-section clearfix">
                        <label for="dates-dropdown" style="display: none">dates dropdown</label>
                        <select id="dates-dropdown" class="btn-awaanbluebtn select-box">
                            <option value="<?=date("Y-m-d")?>">{{ trans('content.whole.today') }}</option>
                            <option value="{{date("Y-m-d",strtotime("-1 days"))}}">{{date("m-d",strtotime("-1 days"))}}</option>
                            <option value="{{date("Y-m-d",strtotime("-2 days"))}}">{{date("m-d",strtotime("-2 days"))}}</option>
                            <option value="{{date("Y-m-d",strtotime("-3 days"))}}">{{date("m-d",strtotime("-3 days"))}}</option>
                        </select>
                    </div>
                    <div class="content-section">
                        <div id="catchup-data-section" class="row">
                            @include("radio.list_catchup")
                        </div>
                        <div class="loadmore-div text-center">
                            <button class="btn btn-awaanbluebtn btn-viewall" {{($load_more)?'':"style=display:none;"}}>عرض المزيد</button>
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
        jQuery(document).ready( function() {
            jQuery('#channel-carousel').owlCarousel({
                navText   : ['',''],
                rtl       : true,
                loop      : false,
                margin    : 25,
                nav       : true,
                responsive: {
                    0:{
                        items:2
                    },
                    400:{
                        items:5
                    },
                    767:{
                        items:7
                    },
                    991:{
                        items:8
                    },
                    1200:{
                        items:9
                    }
                }
            });

        });
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

//            $('#catchup-data-section > div:first-child').find(".audio_media > span > i").removeClass('fa-play-circle').addClass('fa-pause');

        }

        player_loader();

        playerInit();

        playerCatchup();
        var page = 1;
        var date = "{{date("Y-m-d")}}";

        var update_data = function (append) {
            if(!append)
                $("#catchup-data-section").html('<img src="{{asset("images/loading_icon.gif")}}" style="margin-right: 40%;" alt="Loding">');

            $.get( "{{Request::url()}}", {page:page,date: date},function( data,textStatus, request ) {
                if(request.getResponseHeader('x-load-more') == ''){
                    $(".btn-viewall").css('display','none');
                }

                if(append)
                    $("#catchup-data-section").append( data );
                else
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
            page = 1;
            date = $( "#dates-dropdown" ).val();
            update_data(false);
        });

        $(".btn-viewall").click(function() {
            page += 1;
            update_data(true);
        });



    </script>
@endsection

