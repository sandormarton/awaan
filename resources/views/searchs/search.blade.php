@extends('layouts.master')
@section('title', 'نتائج البحث')
<!--This defines a home  section which gets displayed via "yield" -->
<?php $is_empty = true; ?>
@section('main-content')
<!-- MAIN CONTAINER [START] -->


<div class="search-page">

    <div class="container">
        <div class="taps-container">
            <div id="shows-tap" class="active-tap ">{{ trans('content.search.shows') }} ({{count($shows)}})</div>
            <div id="videos-tap">{{ trans('content.search.videos') }} ({{count($videos)}})</div>
            <div id="aflam-tap">{{ trans('content.search.aflam') }} ({{count($films)}})</div>
            <div id="radio-tap">{{ trans('content.search.radio') }} ({{count($audios)}})</div>
        </div>
        @if(sizeof($shows)>0)
            <?php $is_empty = false; ?>
            @include('searchs.showsearch')
        @endif

        <div class="clearfix"></div>

        <div class="search-page-wrapper">

            @if(sizeof($videos)>0)
                <?php $is_empty = false; ?>
                @include('searchs.videosearch')
            @endif

            @if(sizeof($films)>0)
                @include('searchs.aflamsearch')
            @endif

            @if(sizeof($audios)>0)
                @include('searchs.audiosearch')
            @endif

            @if($is_empty)

            <div class="alert alert-danger">
                {{ trans('content.search.noresult') }}
            </div>

            @endif

        </div>


        <script type="text/javascript">

        </script>

    </div>
</div>
@endsection
<!-- MAIN CONTAINER [END] -->
@section("additional_scripts")
    <script  type="text/javascript">
        jQuery(document).ready( function() {
            @if(sizeof($shows) == 0)
                jQuery('#videos-search').css('display','inherit');
                jQuery('#videos-tap').addClass('active-tap');
                jQuery('#shows-tap').removeClass('active-tap');
            @endif

//        .taps-container div
            jQuery('body').on('click','#videos-tap', function(e) {
                jQuery('#shows-tap').removeClass('active-tap');
                jQuery('#aflam-tap').removeClass('active-tap');
                jQuery('#videos-tap').addClass('active-tap');
                jQuery('#radio-tap').removeClass('active-tap');
                jQuery('#videos-search').css('display','inherit');
                jQuery('#shows-search').css('display','none');
                jQuery('#aflam-search').css('display','none');
                jQuery('#radio-search').css('display','none');
            });
            jQuery('body').on('click','#shows-tap', function(e) {
                jQuery('#shows-tap').addClass('active-tap');
                jQuery('#aflam-tap').removeClass('active-tap');
                jQuery('#videos-tap').removeClass('active-tap');
                jQuery('#radio-tap').removeClass('active-tap');
                jQuery('#videos-search').css('display','none');
                jQuery('#aflam-search').css('display','none');
                jQuery('#shows-search').css('display','inherit');
                jQuery('#radio-search').css('display','none');
            });

            jQuery('body').on('click','#aflam-tap', function(e) {
                jQuery('#aflam-tap').addClass('active-tap');
                jQuery('#videos-tap').removeClass('active-tap');
                jQuery('#shows-tap').removeClass('active-tap');
                jQuery('#radio-tap').removeClass('active-tap');
                jQuery('#videos-search').css('display','none');
                jQuery('#shows-search').css('display','none');
                jQuery('#aflam-search').css('display','inherit');
                jQuery('#radio-search').css('display','none');
            });

            jQuery('body').on('click','#radio-tap', function(e) {
                jQuery('#aflam-tap').removeClass('active-tap');
                jQuery('#videos-tap').removeClass('active-tap');
                jQuery('#shows-tap').removeClass('active-tap');
                jQuery('#radio-tap').addClass('active-tap');
                jQuery('#videos-search').css('display','none');
                jQuery('#shows-search').css('display','none');
                jQuery('#aflam-search').css('display','none');
                jQuery('#radio-search').css('display','inherit');
            });
        });

    </script>
@endsection