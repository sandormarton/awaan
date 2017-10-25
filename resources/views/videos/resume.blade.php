@extends('layouts.master_inner')
@section('title', 'تابع المشاهدة')
<!--This defines a home  section which gets displayed via "yield" -->

@section('favoritevideos')
<!-- MAIN CONTAINER [START] -->
@include('show_innerright',['categories'=>$categories])


<div class="innerpage-leftbar">

    <div class="mobile-menu visible-xs">
    	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" title="AWAAN" alt="AWAAN" /></a>
        <button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
    </div>

    @if(!empty($resume))
	<div class="drama-list-wrapper dcnawaansearch-wrapper">
    	<h3 class="module-title">{{ trans('content.showinnerright.resume') }}</h3>
    	<div class="row">
		    <!--    Here we call the favoritesshorows templates that has been returned from the controller to render-->

            @foreach($resume as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="drama-box">
                    <?php
                    $img = config('mangoapi.mangodcn'). $item->img;
                    $url = route('video', [$item->id, ($item->title_ar)]);
                    ?>
                    <a href="{{$url}}"><img data-src="{{$img}}" class="load-onscroll img-responsive center-block" /></a>
                    <div class="drama-content">
                        <a href="{{$url}}" class="drama-title"> {{str_limit($item->title_ar,25)}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
	</div>
    @else
    <h3 style="color: #000;">{{ trans('content.videos_favorites.noresult') }}</h3>

    @endif
    @include('include.inner_footer')

</div>
@endsection
<!-- MAIN CONTAINER [END] -->
