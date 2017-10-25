@extends('layouts.master_news')
@section('title',substr( $currentnews->title_ar, 0, 64))

@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title' => $currentnews->title_ar,
        'current_description' => $currentnews->title_ar,
    ])
@endsection

@section('news')
<h1 style="display: none;">{{$currentnews->title_ar}}</h1>
<!-- MAIN CONTAINER [START] -->

<!-- HEADER WRAPPER [START] -->
{{--@include('include.dfp_leaderboard')--}}

@include('news.header',['categories'=>$categories])

<!-- HEADER WRAPPER [END] -->

<!-- NEWS PLAYER WRAPPER [START] -->
<div class="news-player-wrapper">
    <!--<div class="news-player-title">
        {{trans('content.allshows.wechoose')}}
    </div>-->

    <div class="news-player-wrapper-container row">
        <div class="col-lg-9 col-md-8">
            <div class="col-lg-9 col-md-8 news-player-container">
                <div class="news-player-container">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe title="{{isset($currentnews->title_ar)?$currentnews->title_ar:"News"}}" class="embed-responsive-item" id="video_embedd" src="{{$currentnews->embed}}&autoplay=false&jwplayer=7"></iframe>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($news_details_rows))
        <!--    Here we call the favoritnewsdetailsesshorows templates that has been returned from the controller to render-->
        <div class="col-lg-3 col-md-4">
            <div class="news-playlist-wrapper">
                <div id="news-playlist" class="news-playlist">
                    <?php echo $news_details_rows?>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="news-play-description-wrapper">
        <!--<div id="news_title" class="news-play-description">
            {{$currentnews->title_ar}}
        </div>
        <div class="news-date">
            {{$currentnews->news_date}}
        </div>-->
        <!--
                <div class="news-sharing">

            <ul class="video-sharing-links">
                <li><a href="#"><img src="images/icon-newspage-link.png" /></a></li>
                <li><a href="#"><img src="images/icon-newspage-envelope.png" /></a></li>
                <li><a href="#"><img src="images/icon-newspage-code.png" /></a></li>
            </ul>

            <ul class="video-smsharing-links">
                <li><a href="#"><img src="images/icon-newspage-google-plus.png" /></a></li>
                <li><a href="#"><img src="images/icon-newspage-daglo.png" /></a></li>
                <li><a href="#"><img src="images/icon-newspage-linkedin.png" /></a></li>
                <li><a href="#"><img src="images/icon-newspage-facebook2.png" /></a></li>
                <li><a href="#"><img src="images/icon-newspage-twitter2.png" /></a></li>
            </ul>

        </div>
        -->
    </div>
</div>
<!-- NEWS PLAYER WRAPPER [END] -->


<!-- NEWS PLAYER EXTRA ITEMS WRAPPER [START] -->
<div class="news-player-extra-items-wrapper">
    <div class="news-player-latest-news-wrapper">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-8 news-player-latest-news-column">
                <h3 class="news-player-extra-title"> {{ trans('content.news.latestnews') }}</h3>
                <a class="more-btn" href="{{URL::to('/news/more/latest')}}" title="شاهد المزيد"> &gt;شاهد المزيد</a>
                <div id="news-latest-news-playlist" class="news-latest-news-playlist news-player-extra-items-list">

                    @if(!empty($news_featured_rows))
                    <?php echo $news_featured_rows?>
                    @endif

                </div>
            </div>
            <div class="col-md-3 col-md-3 col-sm-4 mpu-banner-column">
                <div class="mpu-banner-div">
                    @include('mpuads')
                </div>
            </div>
        </div>
    </div>

    <div class="news-player-most-watched-wrapper">
        <h3 class="news-player-extra-title">  {{trans('content.allshows.mostviewed')}} </h3>
        <a class="more-btn" href="{{URL::to('/news/more/most')}}" title="شاهد المزيد"> &gt;شاهد المزيد</a>
        <div id="news-most-watched-playlist" class="news-most-watched-playlist news-player-extra-items-list">
            @include('news.news_mostviewed')

        </div>
    </div>

</div>
<!-- NEWS PLAYER EXTRA ITEMS WRAPPER [END] -->

<!-- FOOTER WRAPPER [START] -->
@include('include.inner_footer')
<!-- FOOTER WRAPPER [END] -->

<!-- MAIN CONTAINER [END] -->

<script type="text/javascript" src="{{asset("js/animate.js")}}"></script>

<!-- SHARE Modal -->
<div class="shareModal" id="shareModal">
    <div class="shareModal-body">
        <span> {{trans('content.allshows.share')}} </span>
        <ul class="footer-sm-ul">
            <li><a href="#" title="Facebook ,opens in a new window" target="_blank"><img alt="Facebook" src="{{asset("images/icon-sm-facebook.png")}}" /></a></li>
            <li><a href="#" title="Twitter ,opens in a new window" target="_blank"><img alt="Twitter" src="{{asset("images/icon-sm-twitter.png")}}" /></a></li>
            <!--<li><a href="#" title="Youtube" target="_blank"><img title="Youtube" alt="Youtube" src="images/icon-sm-youtube.png" /></a></li>-->
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