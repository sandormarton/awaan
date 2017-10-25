<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/18/2017
 * Time: 3:48 PM
 */
?>
@extends('layouts.master')
@section('title', ((Session::get('lang') == 'ar')?$current_channel->title_ar:$current_channel->title_en)." - ".trans('content.allshows.shows'))
@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title'=>((Session::get('lang') == 'ar')?$current_channel->title_ar:$current_channel->title_en)." - ".trans('content.allshows.shows'),
        'current_description'=>"Audio on Demand - AWAAN",
    ])
@endsection

@section('main-content')
    <h1 style="display: none">Awaan</h1>
    <h2 style="display: none">Awaan</h2>
    <h3 style="display: none">Awaan</h3>
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
    <div class="radio-home-listof-shows" style=" min-height: 800px;">
        <div class="container">
            <div class="radio-menu-header-wrapper">
                <div class="row">
                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-3">
                        <div class="logo-div ">
                            <img src="{{config('mangoapi.mangodcn').$current_channel->thumbnail}}" class="img-responsive" alt="channel thumbnail" />
                        </div>
                    </div>
                    <div class="col-lg-11 col-md-10 col-sm-10 col-xs-9">
                        <div class="menu-div">
                            @include("radio.nav")
                            <div class="programs-filters hidden-xs">
                                <label for="languages-dropdown" style="display: none">languages dropdown</label>
                                <select class="form-control languages-dropdown" id="languages-dropdown">
                                    <option value="">{{trans('content.whole.language')}}</option>
                                    @foreach($content->all_language as $lang)
                                        <option value="{{$lang}}">{{trans('content.languanges.'.$lang)}}</option>
                                    @endforeach
                                </select>
                                <label for="years-dropdown" style="display: none">years dropdown</label>
                                <select class="form-control years-dropdown" id="years-dropdown">
                                    <option value="">{{trans('content.whole.order_date')}}</option>
                                    @foreach($content->available_years as $year)
                                        <option value="{{$year}}">{{$year}}</option>
                                    @endforeach
                                </select>
                                <label for="categories-dropdown" style="display: none">categories dropdown</label>
                                <select class="form-control categories-dropdown" id="categories-dropdown">
                                    <option value="-1">{{trans('content.whole.programs')}}</option>
                                    @foreach($categories as $cat)
                                        <option {{($cat->id==$cat_id)?"selected":""}} value="{{$cat->id}}">{{$cat->title_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="programs-filters visible-xs">
                    <label for="languages-dropdown2" style="display: none">languages dropdown2</label>
                    <select class="form-control languages-dropdown" id="languages-dropdown2">
                        <option value="">{{trans('content.whole.language')}}</option>
                        @foreach($content->all_language as $lang)
                            <option value="{{$lang}}">{{trans('content.languanges.'.$lang)}}</option>
                        @endforeach
                    </select>
                    <label for="years-dropdown2" style="display: none">years-dropdown2</label>
                    <select class="form-control years-dropdown" id="years-dropdown2">
                        <option value="">{{trans('content.whole.order_date')}}</option>
                        @foreach($content->available_years as $year)
                            <option value="{{$year}}">{{$year}}</option>
                        @endforeach
                    </select>
                    <label for="categories-dropdown2" style="display: none">categories dropdown2</label>
                    <select class="form-control categories-dropdown" id="categories-dropdown2">
                        <option value="-1">{{trans('content.whole.programs')}}</option>
                        @foreach($categories as $cat)
                            <option {{($cat->id==$cat_id)?"selected":""}} value="{{$cat->id}}">{{$cat->title_ar}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="radio-programs-wrapper">
                <div class="radio-programs-section">
                    <div class="content-section">
                        <div id="shows-data-section" class="row">
                            @include("radio.list_show")
                        </div>
                        <div class="loadmore-div text-center">
                            <button class="btn btn-awaanbluebtn btn-viewall" {{($load_more)?'':"style=display:none;"}}>{{ trans('content.whole.show_more') }}</button>
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

        });
        var page = 1;
        var year = "";
        var language = "";
        var cat_id = "{{$cat_id}}";

        var update_data = function (append) {
            if(!append)
                $("#shows-data-section").html('<img src="{{asset("images/loading_icon.gif")}}" alt="Loading icon" style="margin-right: 40%;" alt="Loding">');

            $.get( "{{Request::url()}}", {page:page,year:year,language:language,cat_id:cat_id},function( data,textStatus, request ) {
                if(request.getResponseHeader('x-load-more') == ''){
                    $(".btn-viewall").css('display','none');
                }

                if(append)
                    $("#shows-data-section").append( data );
                else
                    $("#shows-data-section").html( data );

                jQuery(".lazy-image-handler").Lazy({
                    onFinishedAll: function() {
                        jQuery(this).removeData("src");
                        jQuery(this).addClass("loaded");
                    }
                });
                setTimeout(function() {
                    $("body").getNiceScroll().resize();
                }, 1000);
            });
        };

        $( ".years-dropdown" ).change(function() {
            page = 1;
            year = $( ".years-dropdown" ).val();
            update_data(false);
        });

        $( ".categories-dropdown" ).change(function() {
            page = 1;
            cat_id = $( ".categories-dropdown" ).val();
            update_data(false);
        });

        $( ".languages-dropdown" ).change(function() {
            page = 1;
            language = $( ".languages-dropdown" ).val();
            update_data(false);
        });

        $(".btn-viewall").click(function() {
            page += 1;
            update_data(true);
        });
    </script>
@endsection
