@extends('layouts.master_inner')
@section('title', 'Welcome Awan')
<!--This defines a home  section which gets displayed via "yield" -->

@section('show')
<div class="innerpage-rightbar" id="innerpage-rightbar">
    <div class="innerpage-rightbar-header">
        <div class="logo-div">
            <a href="#"><img src="images/logo-2.png" title="AWAAN" alt="AWAAN" /></a>
        </div>
        <div class="search-div">
            <form method="post">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-search" type="submit"></button>
                    </span>
                    <input type="text" name="search" class="form-control"  placeholder="{{ trans('content.showinnerright.shows') }}" />
                </div>
            </form>
        </div>
    </div>
    <div class="innerpage-rightbar-menubar">
        <ul class="navbar-menu">
            <li><a href="#" class="drama-menu">{{ trans('content.showinnerright.series') }}</a></li>
            <li class="active"><a href="#" class="shows-menu">{{ trans('content.showinnerright.shows') }}</a></li>
        </ul>
    </div>
    <div class="innerpage-rightbar-showsbar">
        <div class="shows-category-divs clearfix">
            <?php $counter = 1;?>
            @foreach($content['Categories'] as $item)
            <?php
            if($counter > 6) {
                break;
            }
            $img = config('mangoapi.mangodcn').$item['icon'];
            ?>
            @if(@empty($item['icon']))
            @continue
            @endif
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="category-block">
                    <a href="#"><img src="{{$img}}" class="img-responsive" /></a>
                    <a class="category-block-hover" href="#">{{$item['title_ar']}}</a>
                </div>
            </div>
            <?php $counter++?>
            @endforeach



        </div>
    </div>
    <div class="innerpage-rightbar-smbar">
        <ul class="footer-sm-ul">
            <li><a target="_blank" title="Facebook" href="#"><img src="{{asset("images/icon-sm-facebook.png")}}" alt="Facebook"></a></li>
            <li><a target="_blank" title="Twitter" href="#"><img src="{{asset("images/icon-sm-twitter.png")}}" alt="Twitter"></a></li>
            <li><a target="_blank" title="Youtube" href="#"><img src="{{asset("images/icon-sm-youtube.png")}}" alt="Youtube"></a></li>
            @if(Session::get('lang') == 'en')
                <li><a title="عربي" href="{{URL::to('set/ar')}}"><img src="{{asset("images/icon-ar.png")}}" alt="عربي"></a></li>
            @else
                <li><a title="Switch to English" href="{{URL::to('set/en')}}"><img src="{{asset("images/icon-en.png")}}" alt="English"></a></li>
            @endif
        </ul>
        <p class="copyright-text">AWAN &copy; 2016</p>
    </div>
</div>

<div class="innerpage-leftbar">

    <div class="mobile-menu visible-xs">
    	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" title="AWAAN" alt="AWAAN" /></a>
        <button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
    </div>

    <div class="dramadetail-list-wrapper showdetail-english-list-wrapper">
        <div class="drama-cover-image">
            <?php
            $img = config('mangoapi.mangodcn').$currentshow['shows_cover'];
            ?>
            <img src="{{$img}}" class="img-responsive" />
        </div>
        <div class="drama-description-div">
            <h4 class="drama-title"> {{$currentshow['show_title_ar']}}</h4>
            <p>{{$currentshow['shows_descp_ar']}}</p>
        </div>
        <div class="drama-search-bar">
            <div class="col-lg-8 col-md-6 col-sm-12"><h3>  {{$currentshow['season_title_ar']}} </h3></div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <label for="seasons" style="display: none;">seasons</label>
                <select id="seasons" class="season-select-box form-control">
                    <option  value="{{$currentshow['season_id']}}" selected="selected">{{$currentshow['season_title_ar']}}</option>

                    @foreach($content['ShowSeasons'] as $item)
                    <option value="{{$item['season_id']}}">{{$item['season_title_ar']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">

                <button class="btn btn-blue">
                    {{$currentshow->faved_id}}
                    show for logged user  <i class="ion-android-favorite-outline"></i> المفضلة
                </button>

            </div>
        </div>
        <div id='seaons_episodes'>


        </div>
        <div class="drama-episode-list-wrapper">

            <div class="row">
                @foreach($currentshow['videos'] as $item)
                <?php $img = config('mangoapi.mangodcn').$item['img']?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <div class="episode-box">
                        <div class="episode-img">
                            <a href="#"><img src="{{$img}}" class="img-responsive"/></a>
                            <div class="episode-duration">{{gmdate("H:i:s", $item['duration'])}}</div>
                            <div class="episode-hover"><a href="#"><i class="ion-play"></i></a></div>
                        </div>
                        <div class="episode-content">
                            <a href="#">{{str_limit($item['title_ar'],35)}} </a>
                        </div>
                    </div>
                </div>


                @endforeach
            </div>


        </div>
        <div class="drama-related-list-wrapper">
            <h3 class="module-title"> {{ trans('content.show.alsolike') }} </h3>
            <a href="#" class="more-btn"> > {{ trans('content.show.viewmore') }} </a>
            <div id="drama-related-list" class="drama-related-list">

                @foreach($content['featuredshows'] as $item)
                <?php $img = config('mangoapi.mangodcn').$item['thumbnail']?>
                <div class="item drama-related-list-div">
                    <a href="#">
                        <img src="{{$img}}" class="img-responsive" />
                    </a>
                </div>
                @endforeach


            </div>
        </div>
    </div>


    <footer class="footer-wrapper">
        <p> {{ trans('content.innerfooter.allrightsreserved') }}&copy; Awan</p>
        <p>{{ trans('content.innerfooter.privacypolicy') }} </p>
    </footer>

</div>

@endsection
