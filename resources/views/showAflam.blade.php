@extends('layouts.master')
<?php
//print_r($content);
//$cover = config('mangoapi.mangodcn').$content->cat->cover;
//$description = $content->cat->description_ar;
//$type = $content->cat->root_title;
//$sessions_select='';
//    $show_times = $content->cat->show_times;
//$authors = $content->cat->authors;

?>
<?php

if(Session::get('lang') == 'en'){
    $title = $content->title_en;
    $description = $content->description_en;
}else{
    $title = $content->title_ar;
    $description = $content->description_ar;
}
?>
@section('title', $title)

@section('social_header_meta')

    {{--@INCLUDE('INCLUDE.SOCIAL_HEADER',['CONTENT'=>$CURRENTT,'META'=>$CONTENT->CH_META])--}}
@endsection
@section('main-content')
    <h1 style="display: none;">Awaan</h1>
    <h2 style="display: none;">Awaan</h2>
    <h3 style="display: none;">Awaan</h3>
    <div class="movie-wrapper">

        <div class="movie-detail-wrapper">
            <div class="container">
                <div class="movie-detail-container">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 @if((isset($content->cast->actor)) and !empty($content->cast->actor) and is_array($content->cast->actor)) border-movie @endif">
                            <div class="col-md-6 col-sm-6 img-col scaleZoomImg">
                                {{--                            <img src="{{ config('mangoapi.mangodcn') . $content->img}}" class="img-responsive" />--}}
                                <div class="lazy-image-handler aflam-image aflam-image-cover" data-src="{{config('mangoapi.mangodcn') . $content->img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                            </div>
                            <div class="col-md-6 col-sm-6 details-col">
                                <p>
                                    <span class="title">{{$title}}</span><br/>
                                    {{--<span class="value">دراما</span>--}}
                                </p>
                                <br/>
                                <p>
                                    <span class="value">{{date('h\h i\m ',$content->duration)}}</span>
                                </p>
                                <br/>
                                <p>
                                    <span class="title">{{ trans('content.whole.production_year') }} - </span>
                                    <span class="value">{{$content->production_year}}</span>
                                    <br/>
                                    @if(isset($content -> cast -> author) && count($content -> cast -> author) > 0)
                                        @if(Session::get('lang') == 'en')
                                            <?php
                                            $a = array_map(function($obj) { return $obj->fullname_en; }, $show -> cast->author);
                                            $a = implode(" , ", $a);
                                            ?>
                                            <span class="title">Author - </span>
                                            <span class="value">{{ $a }}</span>
                                        @else
                                            <?php
                                            $a = array_map(function($obj) { return $obj->fullname_en; }, $content -> cast->author);
                                            $a = implode(" , ", $a);
                                            ?>
                                            <span class="title">تأليف - </span>
                                            <span class="value">{{ $a }}</span>
                                        @endif
                                    @endif
                                    <br/>
                                    @if(isset($content -> cast -> producer) && count($content -> cast -> producer) > 0)
                                        @if(Session::get('lang') == 'en')
                                            <?php
                                            $a = array_map(function($obj) { return $obj->fullname_en; }, $show -> cast->producer);
                                            $a = implode(" , ", $a);
                                            ?>
                                            <span class="title">Producer - </span>
                                            <span class="value">{{ $a }}</span>
                                        @else
                                            <?php
                                            $a = array_map(function($obj) { return $obj->fullname_en; }, $content -> cast->producer);
                                            $a = implode(" , ", $a);
                                            ?>
                                            <span class="title">منتج - </span>
                                            <span class="value">{{ $a }}</span>
                                        @endif
                                    @endif
                                    <br/>
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
                                        <span class="title">إخراج - </span>
                                        <span class="value">{{ $a }}</span>
                                    @endif
                                @endif

                                        </p>
                                        <br/>
                                        <div class="btns-div">
                                            {{--<button class="btn btn-share"><img src="images/icon-share.png"></button>--}}
                                            {{--<button class="btn btn-favourite"><img src="images/icon-fav.png"></button>--}}
                                            @if(Session::has('user_info'))
                                                <?php
                                                $uid = Session::get('user_info');
                                                ?>
                                                @if(empty($content->faved_id))
                                                    <a  class="btn btn-favourite not-active-fav" data-channeluserid="<?=$uid->id?>" data-lang="{{Session::get('lang')}}" data-id="{{$content->id}}"><img src="{{asset('images/icon-fav.png')}}" alt="favourite" /></a>
                                                @else
                                                    <a  class="btn btn-favourite active-fav" data-channeluserid="<?=$uid->id?>" data-lang="{{Session::get('lang')}}" data-id="{{$content->id}}"><img src="{{asset('images/icon-fav-active.png')}}" alt="favourite" /></a>
                                                @endif
                                            @else
                                                <a href="<?=URL::to('auth/login')?>" class="btn btn-favourite"><img src="{{asset('images/icon-fav.png')}}" alt="favourite" /></a>
                                            @endif
                                            <a href="{{route('video', [$content->id, \App\Helpers\Functions::cleanurl($title)])}}" class="btn btn-awaanbluebtn btn-viewall">{{ trans('content.whole.watch_now') }}</a>
                                        </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12 b-actors-container">
                            @if((isset($content->cast->actor)) and !empty($content->cast->actor) and is_array($content->cast->actor))
                                <div class="actors-container">
                                    <div class="title-section">
                                        <h3>{{ trans('content.whole.actors') }}</h3>
                                        <div class="row">
                                            @foreach($content->cast->actor as $actor)
                                                <div class="col-md-15 col-sm-4 related-series-col">
                                                    <div class="related-series-box">
                                                        <?php
                                                        if(isset($actor->url) && !empty($actor->url)){
                                                            $image_url = config('mangoapi.mangodcn') . $actor->url;
                                                        }else{
                                                            $image_url = asset("images/image-not-available.jpg");
                                                        }
                                                        if(isset($actor->fullname) && !empty($actor->fullname)){
                                                            $actor_name = $actor->fullname;
                                                        }
                                                        if(empty($actor_name)){
                                                            $actor_name = $actor->fullname_en;
                                                        }
                                                        ?>
                                                        <a href="javascript:void(0);">
                                                            <p style="display: none">{{$actor_name}}</p>
                                                            <div class="actor-image" style="background-image: url('{{$image_url}}')"></div>
                                                        </a>
                                                        <div class="related-series-content">
                                                            <a href="javascript:void(0);">{{$actor_name}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>


            </div><!-- CONTAINER [END]	-->
        </div>




        @if(isset($content->related) && !empty($content->related) && count($content->related) > 0)
            <div class="container">

                <div class="homeprograms-section films-programs-section">
                    <div class="title-section">
                        <h3>{{ trans('content.whole.related_movies') }}</h3>
                        <a href="{{URL::to('show/allprograms/208109/'. trans('content.whole.movies') )}}" class="btn btn-awaanbluebtn btn-viewall">{{ trans('content.whole.other_movies') }}</a>
                    </div>
                    <div class="data-section">
                        <div id="films-carousel" class="owl-carousel data-carousel films-carousel">
                            @foreach($content->related as $related)
                                <?php
                                if(Session::get('lang') == 'en'){
                                    $title = $related->title_en;
                                }else{
                                    $title = $related->title_ar;
                                }
                                ?>
                                <div class="item">
                                    <a href="{{URL::to("movie/{$related->id}/".\App\Helpers\Functions::cleanurl("{$title}"))}}">
                                        <p style="display: none">{{$title}}</p>
                                        {{--<img src="{{config('mangoapi.mangodcn') . $related->img}}" alt="{{$title}}"/>--}}
                                        <div class="lazy-image-handler aflam-image2" data-src="{{config('mangoapi.mangodcn') . $related->img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                    </a>
                                    <div class="content">
                                        <h4 class="name"><a href="#">{{$title}}</a></h4>
                                        <p class="category">{{$related->tags}}</p>
                                        <span class="time">{{date('h\h i\m ',$related->duration)}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>

@endsection
<!-- MAIN CONTAINER [END] -->





@section("additional_scripts")
    <script  type="text/javascript">
        jQuery(document).ready( function() {
            jQuery('#films-carousel').owlCarousel({
                dots: false,
                nav: false,
                navText   : ['',''],
                rtl       : true,
                loop      : false,
                margin    : 15,
                responsive: {
                    0:{
                        items:2
                    },
                    400:{
                        items:2
                    },
                    580:{
                        items:3
                    },
//                    767:{
//                        items:3
//                    },
                    991:{
                        items:5
                    },
                    1200:{
                        items:5
                    }
                }
            });
            jQuery('.btn-favourite').click(function (e) {
                console.log('add');
                var htmltext = '';
                if(jQuery(this).hasClass('active-fav')) {
                    jQuery(this).find('img').attr('src','{{asset('images/icon-fav.png')}}');
                    jQuery(this).removeClass('active-fav');

                } else {
                    jQuery(this).find('img').attr('src','{{asset('images/icon-fav-active.png')}}');
                    jQuery(this).addClass('active-fav');
                }
                jQuery.post("http://admin.mangomolo.com/analytics/index.php/plus/favor", {
                    faved_id: jQuery(this).data('id'),
                    channel_userid: jQuery(this).data('channeluserid'),
                    user_id: 71
                }).done(function (data) {
                    console.log(data);
                });
            });
        });
    </script>
@endsection


