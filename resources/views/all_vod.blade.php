@extends('layouts.master_inner')
@section('title', $other_content['page_title_ar'])
        <!--This defines a home  section which gets displayed via "yield" -->

@section('allvod')
        <!-- MAIN CONTAINER [START] -->
@include('show_innerright',['categories'=>$categories])


<div class="innerpage-leftbar">

    @include('include.dfp_leaderboard')

    <div class="mobile-menu visible-xs">
    	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" title="AWAAN" alt="AWAAN" /></a>
        <button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
    </div>
    <?php

    $class = '';
    if (!empty($other_content['class'])) {
        $class = $other_content['class'];
    }

    ?>


    <div class="all-vod-list-wrapperd drama-list-wrapper {{$class}}">
        <div class="row">

            @foreach($content  as $item)

                @if(!empty($item->title_ar))

                    <?php

                    if (isset($item->thumbnail)) {
                        $img = config('mangoapi.mangodcn') . $item->thumbnail;
                    } elseif (isset($item->img)) {
                        $img = config('mangoapi.mangodcn') . $item->img;
                    }
                    ?>

                    <?php
                    if ($other_content['route'] == 'video') {
                    $video_hover_title = $item->title_ar;
                    isset($item->cat_description_ar) ? $video_hoverdesc = $item->cat_description_ar : $video_hoverdesc = $item->description_ar;
                    if(isset($item->show_parent[0]->title_ar)){
                        $category = $item->show_parent[0]->title_ar;
                    } else{
                        $category = (isset($item->show_title)) ? $item->show_title: false;
                    }
                    //$video_hover['category']=$currentseasons->shows_parent[0]->title_ar;

                    ?>
                    @if(Session::get('lang') == 'en')
                        <?php
                        $video_hover_title = $item->title_en;
                        isset($item->cat_description_en) ? $video_hoverdesc = $item->cat_description_en : $video_hoverdesc = $item->description_en;
                        //   $category = $item->show_parent[0]->title_en;
                        isset($item->show_parent[0]->title_en) ? $category = $item->show_parent[0]->title_en : $category = $item->show_title

                        //$video_hover['category']=$currentseasons->shows_parent[0]->title_en;
                        ?>
                    @endif
                    <?php }?>


                    <div class="col-lg-15 col-md-6 col-sm-6 col-xs-6">
                        <div class="drama-box">
                            <div class="image-box">
                                <?php $vid_url = URL::to("{$other_content['route']}/{$item->id}")."/".rawurlencode(App\Helpers\Functions::cleanurl($item->title_ar)); ?>
                            	<div class="social-sharing-thumb-div">
	                        		<a href="https://www.facebook.com/sharer/sharer.php?u={{$vid_url}}" data-share-url="{{($vid_url)}}" data-share-type="facebook" target="_blank"  rel="noopener noreferrer">
	                        			<img src="{{asset("images/icon-facebook.png")}}" title="facebook" alt="facebook" />
	                        		</a>
	                        		<a href="https://twitter.com/intent/tweet?url={{$vid_url}}&via=OnAwaan" data-share-url="{{($vid_url)}}" data-share-type="twitter" target="_blank"  rel="noopener noreferrer">
	                        			<img src="{{asset("images/icon-twitter.png")}}" title="twitter" alt="twitter" />
	                        		</a>
	                        	</div>
                            
                                @if($other_content['route'] == 'video')
                                    <a href="{{URL::to("{$other_content['route']}/{$item->id}")}}/{{App\Helpers\Functions::cleanurl($item->title_ar)}}"
                                       data-html="true"
                                       data-content="<p class='video_category'>{{ isset($category) ? $category : '' }} </p><p class='video_date'>{{ isset($item->recorder_dat) ? $item->recorder_dat : '' }} </p><p class='video_desc'>{{ isset($video_hoverdesc) ? $video_hoverdesc : '' }}</p>"
                                       title="{{$item->title_ar}}" data-toggle="popover" data-placement="right"
                                       data-trigger="hover" data-container="body"><img data-src="{{$img}}"

                                                                                       class="load-onscroll img-responsive center-block " alt="{{$item->title_ar}}" title="{{$item->title_ar}}"/></a>

                                @else
                                    <a href="{{URL::to("{$other_content['route']}/{$item->id}")}}/{{App\Helpers\Functions::cleanurl($item->title_ar)}}"><img
                                                data-src="{{$img}}" class="load-onscroll img-responsive center-block " alt="{{$item->title_ar}}" title="{{$item->title_ar}}"/></a>
                                @endif
                            </div>
                            <div class="drama-content">

                                <a class="giveMeEllipsis"
                                   href="{{URL::to("{$other_content['route']}/{$item->id}")}}/{{App\Helpers\Functions::cleanurl($item->title_ar)}}"
                                   class="drama-title giveMeEllipsis"> {{$item->title_ar}}</a>
                            </div>
                        </div>

                    </div>

                @endif
            @endforeach


        </div>
    </div>


    @include('include.inner_footer')
</div>
@endsection
        <!-- MAIN CONTAINER [END] -->
