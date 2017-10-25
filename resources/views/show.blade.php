@extends('layouts.master')
<?php

$cover = config('mangoapi.mangodcn').$content->cat->cover;
$description = $content->cat->description_ar;
$type = $content->cat->root_title;
$sessions_select='';
//    $show_times = $content->cat->show_times;
$authors = $content->cat->authors;

foreach($content->seasons as $id=>$item){
    if(Session::get('lang') == 'en'){
        $shadow_image = asset('images/bg-showpage-banner-en.png');
        if(!empty($item -> title_en) && $item->id == Request::segment(4)){
            $title = $item->title_en;
            $sessions_select .= '<option value="'.$item->id.'">'.$title.'</option>';
        }elseif(!empty($item -> title_en) && empty(Request::segment(4)) && $item->id == $content->default_season){
            $title = $item->title_en;
            $sessions_select .= '<option value="'.$item->id.'">'.$title.'</option>';
        }
        if(!empty($item -> description_en) && $item->id == Request::segment(4)){
            $description = $item->description_en;
        }elseif(!empty($item -> description_en) && empty(Request::segment(4)) && $item->id == $content->default_season){
            $description = $item->description_en;
        }
    }else{
        $shadow_image = asset('images/bg-showpage-banner.png');
        if(!empty($item -> title_ar) && $item->id == Request::segment(4)){
            $title = $item->title_ar;
            $sessions_select .= '<option value="'.$item->id.'">'.$title.'</option>';
        }elseif(!empty($item -> title_ar) && empty(Request::segment(4)) && $item->id == $content->default_season){
            $title = $item->title_ar;
            $sessions_select .= '<option value="'.$item->id.'">'.$title.'</option>';
        }
        if(!empty($item -> description_ar) && $item->id == Request::segment(4)){
            $description = $item->description_ar;
        }elseif(!empty($item -> description_ar) && empty(Request::segment(4)) && $item->id == $content->default_season){
            $description = $item->description_ar;
        }
    }

    if(!empty($item -> cover) && $item->id == Request::segment(4)){
        $cover = config('mangoapi.mangodcn').$item->cover;
    }elseif(!empty($item -> cover) && empty(Request::segment(4)) && $item->id == $content->default_season){
        $cover = config('mangoapi.mangodcn').$item->cover;
    }

    if(isset($item -> authors) && !empty($item -> authors) && count($item -> authors) > 0  && $item->id == Request::segment(4)){
        $authors = $item-> authors;
    }elseif(isset($item -> authors) && !empty($item -> authors) && count($item -> authors) > 0  && empty(Request::segment(4)) && $item->id == $content->default_season){
        $authors = $item-> authors;
    }
}
?>
@section('title', $title)
<!--This defines a home  section which gets displayed via "yield" -->
@section('social_header_meta')

    {{--@include('include.social_header',['content'=>$currentt,'meta'=>$content->ch_meta])--}}

@endsection
@section('main-content')
    <h1 style="display: none;">Awaan</h1>
    <h2 style="display: none;">Awaan</h2>
    <h3 style="display: none;">Awaan</h3>
    <!-- MAIN CONTAINER [START] -->

    <!--  SHOWS CAROUSEL SECTION	[START]	-->
    <div class="showpage-banner-wrapper">
        <div class="container custom-margin-bottom-inverse">
            <div class="image-section">
                <div class="banner-content" style="background-image: url({{$shadow_image}}),url({{$cover}})">

                    <div class="showpage-title">
                        <span class="showpage-title-span">{{$title}}</span>
                        <!--<i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star"></i>-->
                    </div>
                    <div class="row">
                        <div class="showpage-details col-md-9">
                            @if(!empty($description))
                                <p>{!! $description !!}</p>
                            @endif
                            <br/>
                            @if(!empty($type))
                                @if(Session::get('lang') == 'en')
                                    <p>Type - {{$type}}</p>
                                @else
                                    <p>الفئة - {{$type}}</p>
                                @endif
                            @endif
                            @if((isset($content->cast)) && (!empty($content -> cast)))

                                @if(isset($content -> cast -> author) && count($content -> cast -> author) > 0)
                                    @if(Session::get('lang') == 'en')
                                        <?php
                                        $a = array_map(function($obj) { return $obj->fullname_en; }, $show -> cast->author);
                                        $a = implode(" , ", $a);
                                        ?>
                                        <p>Author - {{ $a }}</p>
                                    @else
                                        <?php
                                        $a = array_map(function($obj) { return $obj->fullname_en; }, $content -> cast->author);
                                        $a = implode(" , ", $a);
                                        ?>
                                        <p>تأليف - {{ $a }}</p>
                                    @endif
                                @endif
                                @if(isset($content -> cast -> director) && count($content -> cast -> director) > 0)
                                    @if(Session::get('lang') == 'en')
                                        <?php
                                        $a = array_map(function($obj) { return $obj->fullname_en; }, $content -> cast->director);
                                        $a = implode(" , ", $a);
                                        ?>
                                        <p>Director - {{ $a }}</p>
                                    @else
                                        <?php
                                        $a = array_map(function($obj) { return $obj->fullname; }, $content -> cast->director);
                                        $a = implode(" , ", $a);
                                        ?>
                                        <p>الإخراج - {{ $a }}</p>
                                    @endif
                                @endif
                                @if((isset($content->cast->actor)) and !empty($content->cast->actor) and is_array($content->cast->actor))
                                    <p>{{ trans('content.whole.actors') }} -
                                        @if(Session::get('lang') == 'en')

                                            <?php
                                            $a = array_map(function($obj) { return $obj->fullname_en; }, $content -> cast->actor);
                                            $a = implode(" , ", $a);
                                            echo $a;
                                            ?>
                                        @else
                                            <?php
                                            $a = array_map(function($obj) { return $obj->fullname; }, $content -> cast->actor);
                                            $a = implode(" , ", $a);
                                            echo $a;
                                            ?>
                                        @endif
                                    </p>
                                @endif
                                @if(!empty($content->cat->production_year))
                                    @if(Session::get('lang') == 'en')
                                        <p>Production year : {{$content->cat->production_year}}</p>
                                    @else
                                        <p>سنة الإنتاج - {{$content->cat->production_year}}</p>
                                    @endif

                                @endif
                            @endif
                            @if(isset($content->videos_count))
                                @if(Session::get('lang') == 'en')
                                    <p>Number of episodes - {{$content->videos_count}}</p>
                                @else
                                    <p>عدد الحلقات - {{$content->videos_count}}</p>
                                @endif

                            @endif
                        </div>
                        <div class="showpage-details col-md-3">
                            <div class="share-details">
                                <div class="link-section">
                                    @if(Session::has('user_info'))
                                        <?php
                                        $uid = Session::get('user_info');
                                        //$favshows_url = route('favoritesshows', [$uid['id']]);
                                        //                                        print_r($content->cat);
                                        ?>
                                        @if(isset($content->cat->faved_id) and !empty($content->cat->faved_id))
                                            <a href="#" class="add-to-my-list favadd favorited" data-channeluserid="<?=$uid->id?>"    data-lang="{{Session::get('lang')}}" data-id="{{$content->cat->id}}">{{ trans('content.whole.delete_from_list') }}</a>
                                        @else
                                            <a href="#" class="add-to-my-list favadd" data-channeluserid="<?=$uid->id?>"    data-lang="{{Session::get('lang')}}" data-id="{{$content->cat->id}}">{{ trans('content.whole.add_to_list') }}</a>
                                        @endif

                                        <div id="rateYo" data-lang="{{Session::get('lang')}}" data-id="{{$content->cat->id}}" data-channeluserid="<?=$uid->id?>"></div>
                                    @else
                                        <a href="<?=URL::to('auth/login')?>?" class="add-to-my-list">{{ trans('content.whole.add_to_list') }}</a>
                                    @endif
                                    {{--<a href="#" class="add-to-my-list">أضف إلى قائمتي</a>--}}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($content->seasons) && !empty($content->seasons) && is_array($content->seasons)  && sizeof($content->seasons) > 1)
                    <div class='col-md-2 col-sm-4  drop-season-custom'>
                    <div class="dropdown-section">
                        <select class="form-control showpage-dropdown" id="season-selector">
                            <?php

                            if(isset($content->seasons) && !empty($content->seasons) && is_array($content->seasons)){
                                foreach ($content->seasons as $season){
                                    if(Session::get('lang') == 'en'){
                                        $season_title = $season->title_en;
                                    }else{
                                        $season_title = $season->title_ar;
                                    }
                                    $season_url = URL::to("show/".Request::segment(2) ."/".\App\Helpers\Functions::cleanurl($season_title)."/".$season->id);
                                    if( !empty(Request::segment(4)) and Request::segment(4) == $season->id){
                                        echo '<option value="'.$season->id.'" data-url="'. $season_url.'" selected>'.$season_title.'</option>';
                                    }else{
                                        echo '<option value="'.$season->id.'" data-url="'.$season_url.'" >'.$season_title.'</option>';
                                    }

                                }
                            }
                            ?>
                        </select>
                    </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!--  SHOWS CAROUSEL SECTION	[END]	-->


    <!-- SHOWPAGE LIST WRAPPER [START]	-->
    <div class="showpage-list-wrapper">
        <div class="container">
            <div class="row" id="series-container">
                <?php $counter = 1;
                $video_hover['desc']=$video_hover['category']='';
                //            if(isset($currentshow->shows_parent) && is_array($currentshow->shows_parent) && $currentshow->shows_parent[0]){
                //                (Session::get('lang') == 'ar') ? $video_hover['category']=$currentshow->shows_parent[0]->title_ar : $video_hover['category']=$currentshow->shows_parent[0]->title_en;
                //            }
                ?>
                @if (count($content->videos) > 0)
                    @foreach($content->videos as $item)
                        @if(Session::get('lang') == 'ar')
                            <?php
                            $title = $item->title_ar;
                            $video_hover['videotitle']= $item->title_ar;
                            $video_hover['desc'] = '';
                            if(isset($item->description_ar) && !empty($item->description_ar) && (Session::get('lang') == 'ar') ){
                                $video_hover['desc']=$item->description_ar;
                            }
                            ?>

                        @else
                            <?php
                            $title = $item->title_en;
                            $video_hover['videotitle']= $item->title_en;
                            if(isset($item->description_en) && !empty($item->description_en)){
                                $video_hover['desc']=$item->description_en;
                            }
                            $video_hover['desc'] = '';
                            if(isset($item->description_en) && !empty($item->description_en) && (Session::get('lang') == 'en') ){
                                $video_hover['desc']=$item->description_en;
                            }
                            ?>

                        @endif

                        <?php

                        $img = config('mangoapi.mangodcn').$item->img;
                        if($counter == 4) {

                        }
                        $url = route('video', [$item->id, \App\Helpers\Functions::cleanurl($title)]);
                        $share_url = route('video', [$item->id, rawurlencode(\App\Helpers\Functions::cleanurl($title))]);
                        ?>
                        <div class="col-md-3 col-sm-4 col-xs-6 showpage-video-col">
                            <a href="{{$url}}?x">
                                <div class="img-div scaleZoomImg">
                                <!--<img src="{{$img}}" class="img-responsive center-block" />-->
                                    <div class="embed-responsive-item image-div  lazy-image-handler  @if($catid == 208109 ) aflam-image @endif"  data-src="{{$img}}"  style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                    <div class="show-time-showpagelist">
                                        <span>{{gmdate("H:i:s", $item->duration)}}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="content">
                                <a href="{{$url}}?" class="title-link">{{$title}}</a>
                            </div>
                        </div>
                        <?php $counter++?>
                    @endforeach
                @endif

            </div><!-- ROW [END]	-->
            @if (count($content->videos) == 16)
                <div class="load-more-div">
                    <a href="#" class="btn btn-awaanbluebtn btn-viewall" id="load-more-btn" data-category-offset="2">{{ trans('content.whole.show_more') }}</a>
                </div>
            @endif

        </div><!-- CONTAINER [END]	-->
    </div>
    <!-- SHOWPAGE LIST WRAPPER [END]	-->

@endsection
<!-- MAIN CONTAINER [END] -->

@section("additional_scripts")
    <script  type="text/javascript">
        jQuery(document).ready( function() {
            jQuery('body').on('click','#load-more-btn', function(e) {
                var offset =jQuery(this).attr('data-category-offset');
//                var cat_id =jQuery(this).attr('data-category-id');
//                console.log('cat: ' +cat_id );
                console.log('offset: ' +offset );
                jQuery.ajax({
                    type: "GET",
                    url: "{{Request::url()}}",
                    data: {
                        p: offset,
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
                        // $('#loader-icon').hide();
                    },
                    success: function(data){
                        if(data['count'] >= 16){
                            jQuery('#series-container').append(data['html']);
                            offset = Number(offset) + 1;
                            console.log('offset' + offset);
                            console.log('offset' + data['count']);
                            jQuery('#load-more-btn').attr('data-category-offset',offset);
                        }else{
                            jQuery('#load-more-btn').css('display','none');
                            jQuery('#series-container').append(data['html']);
                        }
                        jQuery(".lazy-image-handler").Lazy({
                            onFinishedAll: function() {
                                jQuery(this).removeData("src");
                                jQuery(this).addClass("loaded");
                            }
                        });
                        setTimeout(function() {
                            $("body").getNiceScroll().resize();
                        }, 1000);

                    },
                    error: function(){}
                });
                return false;
            });

//            jQuery('.ratthisshow').click(function (e) {
//                console.log('rated');
//                var htmltext = '';
//                if(jQuery(this).hasClass('ratedshow')) {
//                    jQuery(this).html('');
//                    jQuery(this).removeClass('ratedshow');
//                    htmltext = 'Rate this show';
//                    if(jQuery(this).data('lang') == 'ar') {
//                        htmltext = 'تقييم هذا العرض';
//                    }
//                    jQuery(this).html(htmltext);
//                } else {
//                    jQuery(this).find('button').html('');
//                    htmltext = 'Unrate';
//                    if(jQuery(this).data('lang') == 'ar') {
//                        htmltext = 'الغاء التقييم';
//                    }
//                    jQuery(this).html(htmltext);
//                    jQuery(this).addClass('ratedshow');
//                }
//                jQuery.post("http://admin.mangomolo.com/analytics/index.php/plus/rateit", {
//                    rated_id: jQuery(this).data('id'),
//                    rate_value: 5,
//                    channel_userid: jQuery(this).data('channeluserid'),
//                    user_id: 71,
//                    key:'e2c420d928d4bf8ce0ff2ec1',
//                }).done(function (data) {
//
//                });
//                return false;
//            });
//
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
                    user_id: 71
                }).done(function (data) {

                });
                return false;
            });

            jQuery('#season-selector').change(function() {
                jQuery('#programs-container').html('');
                var season = jQuery(this).val();
                var url = jQuery(this).find('option:selected').attr('data-url');
//                var title = 'sss';
                window.location.href = url;
{{--               console.log("{{URL::to("show/".Request::segment(2))}}" + "/" + title + "/" + season);--}}
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
                        key:'e2c420d928d4bf8ce0ff2ec1',
                    }).done(function (data) {

                    });
                }
            });
            @endif
        });
    </script>
@endsection
