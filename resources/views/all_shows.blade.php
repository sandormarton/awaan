@extends('layouts.master_inner')
@section('title',  trans('content.pagetitle.vieondemand'))
        <!--This defines a home  section which gets displayed via "yield" -->

@section('allshows')
    <h1 class="hidden">{{trans('content.pagetitle.vieondemand')}}</h1>
    @include('show_innerright',['categories'=> $categories])
    <?php   $api = new \App\Providers\ApiRequest();?>
    <div class="innerpage-leftbar">

        @include('include.dfp_leaderboard')

        <div class="mobile-menu visible-xs">
        	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" alt="AWAAN Mobile" /></a>
            <button id='trigger' class="btn btn-mobile-menu"><span class="hidden">AWAAN-Mobile</span><i class="ion-navicon-round"></i></button>
        </div>

        <div class="shows-list-wrapper">

            <div class="shows-cover-image">
                <div id="ShowsBanners" class="ShowsBanners-slider flexslider">
                    <ul class="slides">
                        @foreach($slides as $item)
                            <?php
                            $img = config('mangoapi.mangodcn') . $item->slide_img;
                            $show_url = route('show', [$item->id, \App\Helpers\Functions::cleanurl($item->title_ar)]);
                            ?>
                            <li data-duration="4000">
                                <a href="{{$show_url}}"><img src="{{$img}}" class="img-responsive" alt="{{$item->title_ar}}"/></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="shows-items-wrapper shows-latest-episodes-list-wrapper">
                <div class="clearfix">
                    <h3 class="module-title"> {{ trans('content.allshows.featuredVideos') }}</h3>
                    <a href="{{URL::to('show/more/featured')}}" class="more-btn">
                        >{{ trans('content.allshows.viewmore') }}</a>

                    <div id="shows-picks-list" class="shows-page-video-list shows-latest-episodes-list">

                    	
                    	
                    	@foreach($featured_videos as $item)
                    		
		                    <?php
		                    $video_hover['videotitle'] = $item['title_ar'];
		                    $video_hover['desc'] = $item['cat_ar'];
		                    //$video_hover['category']=$currentseasons->shows_parent[0]->title_ar;
		
		                    ?>
		                    @if(Session::get('lang') == 'en')
		                        <?php
		                        $video_hover['videotitle'] = $item['title_en'];
		                        $video_hover['desc'] = $item['cat_en'];
		                        //$video_hover['category']=$currentseasons->shows_parent[0]->title_en;
		                        ?>
		                    @endif
                    	
                            <?php
                            $img = config('mangoapi.mangodcn') . $item['img'];
                            $url = route('video', [$item['id'], \App\Helpers\Functions::cleanurl($item['title_ar'])]);
                            ?>

                            <div class="item drama-related-list-div">
                                <a href="{{$url}}?">
                                    <img src="{{$img}}" class="img-responsive" alt="{{$item['title_ar']}}"/>
                                </a>

                                <div class="drama-content giveMeEllipsis">
                                    {{$item['title_ar']}}
                                </div>
                                <a href="{{$url}}" data-container="body" data-trigger="hover" data-placement="right"
			                           data-toggle="popover" title="{{$item['title_ar']}}"
			                           data-content="<p class='video_category'>{{$item['parent_title']}}</p><p class='video_date'>{{$item['recorder_date']}}</p><p class='video_desc'>{{str_limit($video_hover['desc'],50)}}</p>"
			                           data-html="true" class="drama-related-hover">
                                    <span class="hidden">{{$item['title_ar']}}</span>
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </a>
                            </div>

                        @endforeach
                    	
                    	

                    </div>

                </div>
            </div>


            <div class="shows-items-wrapper shows-latest-episodes-list-wrapper">
                <h3 class="module-title"> {{ trans('content.allshows.latestepisodes') }}</h3>
                <a href="{{URL::to('show/more/latest')}}" class="more-btn">
                    > {{ trans('content.allshows.viewmore') }} </a>

                <div id="shows-latest-episodes-list" class="shows-page-video-list shows-latest-episodes-list">

                    @foreach($show_content['LatestVideos'] as $item)
                            <!-- Get the parent categroy of the video -->
                    <?php

                    $video_showdetails = $api->get_category_info($item['cat_id']);

                    ?>

                    <?php
                    $video_hover['videotitle'] = $item['title_ar'];
                    $video_hover['desc'] = $item['cat_description_ar'];
                    //$video_hover['category']=$currentseasons->shows_parent[0]->title_ar;

                    ?>
                    @if(Session::get('lang') == 'en')
                        <?php
                        $video_hover['videotitle'] = $item['title_en'];
                        $video_hover['desc'] = $item['cat_description_en'];
                        //$video_hover['category']=$currentseasons->shows_parent[0]->title_en;
                        ?>
                    @endif
                    <?php
                    $img = config('mangoapi.mangodcn') . $item['img'];
                    $video_url = route('video', [$item['id'], (\App\Helpers\Functions::cleanurl($item['title_ar']))]);
                    ?>
                    <div class="item drama-related-list-div">
                        <a href="{{$video_url}}?">
                            <img src="{{$img}}" class="img-responsive" alt="{{$item['title_ar']}}"/>
                        </a>

                        <div class="drama-content giveMeEllipsis">
                            {{$item['title_ar']}}
                        </div>
                        <a href="{{$video_url}}" data-container="body" data-trigger="hover" data-placement="right"
                           data-toggle="popover" title="{{$item['title_ar']}}"
                           data-content="<p class='video_category'>{{$video_showdetails['parentTitle']}}</p><p class='video_date'>{{$item['recorder_date']}}</p><p class='video_desc'>{{str_limit($video_hover['desc'],50)}}</p>"
                           data-html="true" class="drama-related-hover">
                            <span class="hidden">{{$item['title_ar']}}</span>
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="shows-items-wrapper shows-most-watched-list-wrapper">

                <h3 class="module-title">{{ trans('content.allshows.mostviewed') }} </h3>
                <a href="{{URL::to('show/more/topwatched')}}" class="more-btn">
                    >{{ trans('content.allshows.viewmore') }}</a>

                <div id="shows-most-watched-list" class="shows-page-video-list shows-most-watched-list">
                                	
                	@foreach($show_content['Most_Shows'] as $item)
                	                	
                		<?php
	                    $video_hover['videotitle'] = $item['title_ar'];
	                    
	                    //$video_hover['category']=$currentseasons->shows_parent[0]->title_ar;
	
	                    ?>
	                    @if(Session::get('lang') == 'en')
	                        <?php
	                        $video_hover['videotitle'] = $item['title_en'];
	                        
	                        //$video_hover['category']=$currentseasons->shows_parent[0]->title_en;
	                        ?>
	                    @endif
                	
                        <?php
                        $img = config('mangoapi.mangodcn') . $item['img'];
                        $video_url = route('video', [$item['id'], (\App\Helpers\Functions::cleanurl($item['title_ar']))]);
                        ?>

                        <div class="item drama-related-list-div ">
                            <a href="{{$video_url}}?">
                                <img src="{{$img}}" class="img-responsive" alt="{{$item['title_ar']}}"/>
                            </a>
                            <div class="drama-content giveMeEllipsis">
                                {{$item['title_ar']}}
	                        </div>
                            <a href="{{$video_url}}" class="drama-related-hover" data-container="body" data-trigger="hover" data-placement="right"
			                           data-toggle="popover" title="{{$item['title_ar']}}"
			                           data-content="<p class='video_date'>{{$item['recorder_date']}}</p>"
			                           data-html="true">
                                <span class="hidden">{{$item['title_ar']}}</span>
                            		<i class="glyphicon glyphicon-chevron-up"></i>
                            </a>
                        </div>
                    @endforeach
                	                	
                </div>

            </div>


            @if(!empty($show_content['top_videos']))
                <div class="shows-items-wrapper shows-top-rated-list-wrapper">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="module-title">  {{ trans('content.allshows.toprated') }}</h3>
                            <a href="{{URL::to('show/more/toprated')}}" class="more-btn">
                                > {{ trans('content.allshows.viewmore') }}</a>

                            <div id="videos-top-rated-list"
                                 class="shows-page-video-list shows-top-rated-list videos-top-rated-list">

                                @foreach($show_content['top_videos'] as $item)

                                    <?php
                                                        
                                    $showdetails = $api->get_category_info($item['category_id']);

                                    $video_showdetails = $api->get_category_info($showdetails['parentID']);

                                    $video_hover['videotitle'] = $item['title_ar'];
                                    $video_hover['desc'] = $item['description_ar'];
                                    $video_hover['category'] = $item['show_title'];

                                    ?>
                                    @if(Session::get('lang') == 'en')
                                        <?php
                                        $video_hover['videotitle'] = $item['title_en'];
                                        $video_hover['desc'] = $item['description_en'];
                                        $video_hover['category'] = $item['show_title'];
                                        ?>
                                    @endif

                                    <?php
                                    $img = config('mangoapi.mangodcn') . $item['img'];
                                    $video_url = route('video', [$item['id'], (\App\Helpers\Functions::cleanurl($item['title_ar']))]);
                                    ?>

                                    <div class="item drama-related-list-div ">
                                        <a href="{{$video_url}}?">
                                            <img src="{{$img}}" class="img-responsive" alt="{{$item['title_ar']}}"/>
                                        </a>
										<div class="drama-content giveMeEllipsis">
                                            {{$item['title_ar']}}
				                        </div>
                                        <a href="{{$video_url}}" data-container="body" data-trigger="hover"
                                           data-placement="right" data-toggle="popover"
                                           title="{{$video_hover['videotitle']}}"
                                           data-content="<p class='video_category'>{{$video_showdetails['parentTitle']}}</p> <p class='video_desc'>{{str_limit($video_hover['desc'],50)}}</p>"
                                           data-html="true" class="drama-related-hover">
                                            <span class="hidden">{{$item['title_ar']}}</span>
                                            <i class="glyphicon glyphicon-chevron-up"></i>
                                        </a>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            @endif

        </div>

        @include('include.inner_footer')

    </div>


    <!-- LOGIN MODAL [START] -->

    <!-- LOGIN MODAL [END] -->

    <!-- REGISTER MODAL [START] -->

    <!-- REGISTER MODAL [END] -->

@endsection
