@extends('layouts.master_news')
@section('title', $category_pagetitle['page_title_ar'])
@section('news_categ_videos')
<h1 class="hidden">{{$category_pagetitle['page_title_ar']}}</h1>
    <!-- MAIN CONTAINER [START] -->

    <!-- HEADER WRAPPER [START] -->
    {{--@include('include.dfp_leaderboard')--}}

    @include('news.header',['categories'=>$categories])
    <!-- HEADER WRAPPER [END] -->

    <!-- NEWS PLAYER WRAPPER [START] -->

    <div class="dramadetail-list-wrapper showdetail-english-list-wrapper">
        <div class="drama-cover-image">

            <img src="{{config('mangoapi.mangodcn').$current->season_cover}}" class="img-responsive center-block"
                 width="100%" alt="AWAAN News"/>
            <div class="drama-description-div">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!--<h4 class="drama-title">{{$current->title_ar}}</h4>-->
                        <p>{{$current->description_ar}}</p>
                    </div>
                <!--<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                    <div class="mpu-box">
                        @include('mpuads')
                        </div>
                    </div>-->
                </div>
            </div>

        </div>
        <div class="drama-search-bar">
            <div class="col-lg-8 col-md-6 col-sm-12"><h2>{{$current->title_ar}}</h2></div>
            @if(count($otherseasons) > 0)
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <label class="hidden" for="newsseasons">Male</label>
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
                    //$favshows_url = route('favoritesshows', [$uid['id']]);
                    ?>
                    <a class="setfavoriteshows" data-channeluserid="<?=$uid['id']?>" data-id="{{$current->id}}">
                        @if(is_null($current->video_faved_id))
                            <button class="btn btn-blue">
                                <i class="ion-android-favorite-outline"></i>{{ trans('content.video.favorites') }}
                            </button>
                        @elseif(!is_null($current->video_faved_id))
                            <button class="btn btn-blue">
                                <i class="ion-android-favorite-outline"></i> {{ trans('content.show.deletefromfavorite') }}
                            </button>
                        @endif

                    </a>
                @else
                    <button class="btn btn-blue" data-toggle="modal" data-target="#loginModal" role="button"
                            aria-haspopup="true" aria-expanded="false">

                        <i class="ion-android-favorite-outline"
                           data-target="#loginModal"></i> {{ trans('content.show.favorites') }}
                    </button>
                @endif

            </div>
        </div>
        <div class="drama-episode-list-wrapper" id='seaons_episodes'>
            <div id="scroll-content" class="row">
                @foreach($content as $item)
                    <?php
                    $img = config('mangoapi.mangodcn') . $item->img;
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                        <div class="episode-box">
                            <div class="episode-img loading-image">
                                <a href="#" title="{{$item->title_ar}}"><img data-src="{{$img}}"
                                                                             class="load-onscroll img-responsive"
                                                                             alt="{{$item->title_ar}} -صورة-"/>

                                </a>
                                <div class="episode-hover"><a title="{{$item->title_ar}}"
                                                              href="{{URL::to("news/videos/{$item->id}/{$item->title_ar}")}}">
                                        <i class="glyphicon glyphicon-chevron-up"></i><span
                                                class="hidden">{{$item->title_ar}}</span></a>
                                    <span class="hidden">{{$item->title_ar}}</span>
                                </div>
                            </div>
                            <!-- Test comment-->
                            <div class="episode-content giveMeEllipsis">
                                <p>{{$item->title_ar}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <a id="next" style="display: none;" href="?page=2">next page?</a></li>
        </div>
        <div class="drama-related-list-wrapper">
            <h3 class="module-title">  {{trans('content.show.alsolike')}}   </h3>
            <!--        <a href="#" class="more-btn"> > شاهد المزيد</a>-->
            <div id="drama-related-list" class="drama-related-list news-reports-you-may-also-like-list">
                @foreach($featuredshows as $item)
                    <?php
                    $img = config('mangoapi.mangodcn') . $item->thumbnail;
                    $url = route('show', [$item->parent_id, $item->title_ar]);
                    ?>
                    <div class="item drama-related-list-div">
                        <a href="{{$url}}" title="{{$item->title_ar}}">
                            <img src="{{$img}}" class="img-responsive"
                                 alt="{{$item->title_ar}} -صورة-"/>
                            <span class="hidden">{{$item->title_ar}}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var current_page = 1;
            $('#scroll-content').infinitescroll({
                // callback		: function () { console.log('using opts.callback'); },
                navSelector: "a#next:last",
                nextSelector: "a#next:last",
                itemSelector: "#scroll-content .col-lg-3",
                debug: true,
                //dataType	 	: 'json',
                // behavior		: 'twitter',
                appendCallback: false, // USE FOR PREPENDING
                // pathParse     	: function( pathStr, nextPage ){ return pathStr.replace('2', nextPage ); }
            }, function (response) {
                current_page++;
                $theCntr = $("#scroll-content");
                $theCntr.append(response);
                $(".load-onscroll").unveil(200, function () {
                    $(this).load(function () {
                        this.style.opacity = 1;
                    });
                });
            });
        });
    </script>

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
                <li><a href="#" title="Facebook ,opens in a new window" target="_blank"  rel="noopener noreferrer"><img alt="Facebook icon"
                                                                                             src="{{asset("images/icon-sm-facebook.png")}}"/><span
                                class="hidden">Share on facebook</span></a></li>
                <li><a href="#" title="Twitter ,opens in a new window" target="_blank"  rel="noopener noreferrer"><img alt="Twitter icon"
                                                                                            src="{{asset("images/icon-sm-twitter.png")}}"/><span
                                class="hidden">Share on twitter</span></a></li>
                <li><a href="#" title="Youtube ,opens in a new window" target="_blank"  rel="noopener noreferrer"><img alt="Youtube icon"
                                                                                            src="{{asset("images/icon-sm-youtube.png")}}"/><span
                                class="hidden">Share on youtube</span></a></li>
            </ul>
        </div>
    </div>








    <!-- LOGIN MODAL [START] -->
    @include('login_modal')
    <!-- LOGIN MODAL [END] -->

    <!-- REGISTER MODAL [START] -->
    @include('register_modal')
    <!-- REGISTER MODAL [END] -->
@endsection