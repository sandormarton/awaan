@extends('layouts.master')
@section('title', 'نتائج البحث')
<!--This defines a home  section which gets displayed via "yield" -->

@section('main-content')
<!-- MAIN CONTAINER [START] -->


<div class="search-page">

    <div class="container">
        <div class="taps-container">
            <div id="shows-tap" class="active-tap ">{{ trans('content.search.shows') }} ({{count($shows)}})</div>
            <div id="videos-tap">{{ trans('content.search.videos') }} ({{count($videos)}})</div>
        </div>
        @if(sizeof($shows)>0)
            @include('searchs.showsearch')
        @endif

        <div class="clearfix"></div>

        <div class="search-page-wrapper">

            @if(sizeof($videos)>0)
                @include('searchs.videosearch')
            @else

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
                jQuery('#videos-tap').addClass('active-tap');
                jQuery('#videos-search').css('display','inherit');
                jQuery('#shows-search').css('display','none');
            });
            jQuery('body').on('click','#shows-tap', function(e) {
                jQuery('#shows-tap').addClass('active-tap');
                jQuery('#videos-tap').removeClass('active-tap');
                jQuery('#videos-search').css('display','none');
                jQuery('#shows-search').css('display','inherit');
            });
        });
    </script>
@endsection