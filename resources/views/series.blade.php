@extends('layouts.master_inner')
@section('title', $content_pagetitle)
<!--This defines a home  section which gets displayed via "yield" -->
@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title' => $content_pagetitle,
        'current_description' => $content_pagetitle,
    ])
@endsection

@section('series')
    <h1 style="display: none;">{{$content_pagetitle}}</h1>
<!-- MAIN CONTAINER [START] -->
@include('show_innerright',['categories'=>$categories])



<div class="innerpage-leftbar">

    @include('include.dfp_leaderboard')

    <div class="mobile-menu visible-xs">
    	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" alt="AWAAN" /></a>
        <button id='trigger' class="btn btn-mobile-menu">
            <span style="display: none;">mobile</span>
            <i class="ion-navicon-round"></i>
        </button>
    </div>

    <div class="drama-list-wrapper relatedshows-list-wrapper">
        <div class="row">
            @if(isset($content) && is_array($content) && count($content) > 0)
            @foreach($content  as $item)
            <?php
            $img = config('mangoapi.mangodcn').$item->thumbnail;
            ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                <div class="drama-box">
                    @if(isset( $item->premium ) and $item->premium == 1)
                        <div class="ribbon" style="right: -5px !important;"><span>GOLD</span></div>
                    @endif
                    <?php
                    $url = route('show', [$item->id, \App\Helpers\Functions::cleanurl($item->title_ar)]);
                    ?>
                    <a href="{{$url}}"><img alt="{{$item->title_ar}}" data-src="{{$img}}" class="load-onscroll img-responsive center-block" /></a>
                    <div class="drama-content">
                        <p class="drama-title giveMeEllipsis"> {{$item->title_ar}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>


    @include('include.inner_footer')

</div>
@endsection
<!-- MAIN CONTAINER [END] -->
