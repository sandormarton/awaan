@extends('layouts.master_inner')
@section('title',  trans('content.pagetitle.channels'))
<!--This defines a home  section which gets displayed via "yield" -->
@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title'=> trans('content.pagetitle.channels'),
        'current_description'=> trans('content.pagetitle.channels'),
    ])
@endsection
@section('categories')
    <h1 style="display: none;">{{trans('content.pagetitle.channels')}}</h1>
<!-- MAIN CONTAINER [START] -->
@include('show_innerright',['categories'=>$categories])
<div class="innerpage-leftbar awaan-category-wrapper channel-home-wrapper">

    @include('include.dfp_leaderboard')

    <div class="mobile-menu visible-xs">
    	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" alt="AWAAN" /></a>
        <button id='trigger' class="btn btn-mobile-menu">
            <span style="display: none;">mobile</span>
            <i class="ion-navicon-round"></i>
        </button>
    </div>

    <div class="drama-list-wrapper">
        <div class="channel-home-channel-list">
            <ul class="channel-home-channel-list-ul">

                @foreach($content  as $item)

                @if(!empty($item->title_ar) and $item->premuim != 1 and $item->id != 25)

                <?php
                if(isset($item->icon)) {
                    $img = config('mangoapi.mangodcn').$item->icon;
                }
                ?>
                <li>
                    <div class="drama-box1">
                        <?php
                        //$url = route($route, [$item->id, ($item->title_ar)]);
                        ?>
                        <a href="{{URL::to("channels/view/{$item->id}/".\App\Helpers\Functions::cleanurl($item->title_ar))}}"><img src="{{$img}}" alt="{{$item->title_ar}}" class="img-responsive center-block" /></a>
                        <!--	                    <div class="drama-content">
                                                        <a href="{{URL::to("channels/view/{$item->id}/".\App\Helpers\Functions::cleanurl($item->title_ar))}}" class="drama-title"> {{str_limit($item->title_ar,18)}}</a>
                                                    </div>-->
                    </div>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
    @include('include.inner_footer')
</div>
@endsection
<!-- MAIN CONTAINER [END] -->
