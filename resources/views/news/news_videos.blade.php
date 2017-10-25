@extends('layouts.master_news')
@section('title', substr( $content->title_ar, 0, 64))
@section('social_header_meta')
@include('include.social_header',['social_meta'=>$content])
@endsection

@section('newsvideos')
<!--This defines a home  section which gets displayed via "yield" -->


<!-- MAIN CONTAINER [START] -->

<!-- HEADER WRAPPER [START] -->
{{--@include('include.dfp_leaderboard')--}}

@include('news.header',['categories'=>$categories])
<!-- HEADER WRAPPER [END] -->

<!-- NEWS PLAYER WRAPPER [START] -->

<div class="dramadetail-list-wrapper showdetail-english-list-wrapper">

    <div class="">
        <div class="col-md-8 video-left-container">
            <div class="drama-cover-image">

                <div class="embed-responsive embed-responsive-16by9">
                    <iframe title="{{$content->title_ar}}" id="video_embedd" class="embed-responsive-item" src="{{$content->embed}}"></iframe>
                </div>

            </div>

            <div class="drama-description-div">
                <div class="">
                    <div class="video-description-wrapper">
                        <h1 style="font-size: 24px;" class="video-title">{{$content->title_ar}} </h1>

                        <div class="video-content-div">
                            <p>{{$content->description_ar}}</p>
                        </div>


                        <div class="video-buttons-div">
                            @if(Session::has('user'))
                            <?php
                            $uid = session('user');
                            ?>

                            <button class="btn btn-blue" data-toggle="modal" data-target="#copyEmbedModel"  role="button" aria-haspopup="true" aria-expanded="false" >
                                {{ trans('content.video.getemb') }}
                            </button>
                            @else
                            <button class="btn btn-blue" data-toggle="modal"  data-target="#loginModal">
                                {{ trans('content.video.getemb') }}
                            </button>

                            @endif
                            <!-- <a href="#" class="btn btn-blue">
                        <i class="ion-android-favorite-outline"></i> المفضلة
                      </a>-->
                        </div>

                        <div class="video-social-media-div">
                            @include('include.social_share_buttons',['shortenurl'=>$shareurl])
                        </div>

                    </div>
                </div>



            </div>
        </div>
        <div class="col-md-4">
            <div class="">
                <div class="mpu-box">
                    @include('mpuads')
                </div>
            </div>
            <div class="video-mangosocial-wrapper">
                <div class="video-mangosocial-container">
                    @include('videos.mangosocial',['videoid'=>$content->id,'videotitle'=>$content->title_ar])
                </div>
            </div>
        </div>
    </div>
    <div class="drama-search-bar">
        <div class="col-lg-8 col-md-6 col-sm-12"><h3>{{$currentseasons->show_title_ar}}</h3></div>
        @if(count($otherseasons) > 0)
        <div class="col-lg-2 col-md-3 col-sm-6">
            <label for="newsseasons" class="hidden">news seasons</label>
            <select id="newsseasons" class="season-select-box form-control">
                @foreach($otherseasons as $item)
                <option value="{{$item->season_id}}">{{$item->season_title_ar}}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="col-lg-2 col-md-3 col-sm-6">
            @if(Session::has('user'))
            <?php
            $uid = session('user');
            ?>
            <a class="favoritevideo" data-lang="{{Session::get('lang')}}" title="Favorites" data-channeluserid="<?=$uid['id']?>" data-id="{{$vid}}">
                @if(empty($content->video_faved_id))
                <button class="btn btn-blue">
                    <i class="ion-android-favorite-outline"></i>{{ trans('content.show.favorites') }}
                </button>
                @else
                <button class="btn btn-blue">
                    <i class="ion-android-favorite-outline"></i>{{ trans('content.show.deletefromfavorite') }}
                </button>
                @endif
            </a>
            @else
            <button class="btn btn-blue" data-toggle="modal" data-target="#loginModal"  role="button" aria-haspopup="true" aria-expanded="false" >

                <i class="ion-android-favorite-outline" data-target="#loginModal"></i> {{ trans('content.show.favorites') }}
            </button>
            @endif
        </div>
    </div>
    <div class="drama-episode-list-wrapper" id='seaons_episodes'>
        <div class="row">
            @foreach($currentseasons->videos as $item)
            <?php
            $img = config('mangoapi.mangodcn').$item->img;
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="episode-box">
                    <a href="{{URL::to('news/videos/'.$item->id.'/'.\App\Helpers\Functions::cleanurl($item->title_ar))}}?" title="{{($item->title_ar)}}">
                    <div class="episode-img">
                        <img alt="{{($item->title_ar)}}" data-src="{{$img}}" class="load-onscroll img-responsive"/>
                        <span class="episode-duration">{{gmdate("H:i:s", $item->duration)}}</span>
                        <span class="episode-hover">&nbsp<i style="color: #318dcc;" class="glyphicon glyphicon-chevron-up"></i></span>
                    </div>
                    </a>
                    <div class="episode-content giveMeEllipsis">
                        <p>{{($item->title_ar)}}</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <div class="drama-related-list-wrapper">
        <h3 class="module-title">{{trans('content.show.alsolike')}} </h3>
        <!--        <a href="#" class="more-btn"> > شاهد المزيد</a>-->
        <div id="drama-related-list" class="drama-related-list">
            @foreach($featuredshows as $item)
            <?php
            $img = config('mangoapi.mangodcn').$item->thumbnail;
            $url = route('show', [$item->id, $item->title_ar]);
            ?>
            <div class="item drama-related-list-div">
                <a href="{{$url}}" title="Click here">
                    <img src="{{$img}}" alt="{{$item->title_ar}}" class="img-responsive" />
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- NEWS PLAYER WRAPPER [END] -->

<!-- FOOTER WRAPPER [START] -->
@include('include.inner_footer')
<!-- FOOTER WRAPPER [END] -->



<!-- MAIN CONTAINER [END] -->


<script type="text/javascript" src="{{asset("js/animate.js")}}"></script>

<!-- SHARE Modal -->
<div class="shareModal" id="shareModal">
    <div class="shareModal-body">
        <span>Share</span>
        <ul class="footer-sm-ul">
            <li><a href="#" title="Facebook ,opens in a new window" target="_blank"><img alt="Facebook" src="{{asset("images/icon-sm-facebook.png")}}" /></a></li>
            <li><a href="#" title="Twitter ,opens in a new window" target="_blank"><img alt="Twitter" src="{{asset("images/icon-sm-twitter.png")}}" /></a></li>
            <li><a href="#" title="Youtube ,opens in a new window" target="_blank"><img alt="Youtube" src="{{asset("images/icon-sm-youtube.png")}}" /></a></li>
        </ul>
    </div>
</div>

<!-- LOGIN MODAL [START] -->
@include('login_modal')
<!-- LOGIN MODAL [END] -->

<!-- Get embedd  MODAL [START] -->
@include('videos.get_videoembedd_modal',['embed'=>$content->embed,'vid'=>$content->id,'videosignature'=>$videosignature,'video'=>$content])
<!-- Get embedd MODAL [END] -->

<!-- REGISTER MODAL [START] -->
@include('register_modal')
<!-- REGISTER MODAL [END] -->
@endsection

