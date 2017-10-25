
<!-- LOGIN MODAL [START] -->
@include('login_modal')
<!-- LOGIN MODAL [END] -->

<!-- REGISTER MODAL [START] -->
@include('register_modal')
<!-- REGISTER MODAL [END] -->

<div class="sidebar right innerpage-rightbar" id="innerpage-rightbar">
	<button id="close-sidebar" class="btn btn-lg btn-danger close-sidebar">
        <i class="ion-close-round"></i>
        <span style="display: none;">close sidebar</span>
    </button>
    <div class="innerpage-rightbar-header">
        <div class="">
            <div class="dropdown menu-div">
                @include('include.menu')
            </div>
        </div>
        <div class="logo-div">
            <a href="{!! route('/') !!}"><img src=" {{ asset("/images/logo-2.png")}}" alt="DMI AWAAN" /></a>
        </div>
        <div class="search-div">
            <form method="post" action="{!! route('search') !!}">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-search" type="submit">
                            <span style="display: none;">search</span>
                        </button>
                    </span>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <!--                    CSRF protection out of the box-->
                    <label for="searchTerm" style="display: none;">{{ trans('content.showinnerright.shows') }}</label>
                    <input id="searchTerm" type="text" spellcheck="false" autocomplete="off" name="term" class="form-control"  title="{{ trans('content.showinnerright.shows') }}" placeholder="{{ trans('content.showinnerright.shows') }}" />
                </div>
            </form>
        </div>
    </div>









    <div class="innerpage-rightbar-menubar">
        <?php
        $activeclass = '';
        $current = Request::segment(1);
        $relatedshow = Request::segment(2);
        $active = ( $current == 'live' || $current == 'catchup' || $current == 'news' || $current == 'premium' || $current == 'allshows' || $current == 'show' || $current == 'categories' || $current == 'channels') ? 'active' : false;
        ?>
        <?php
        if($current == false) {
            $activeclass = '';
        }
        elseif($active != false) {
            $activeclass = "class=active";
            $active = false;
        }
        else {
            $activeclass = '';
        }
        ?>
        <ul class="navbar-menu">
            <li  class="<?=($current == 'live') ? 'active' : ''?>"><a class="livebroadcast-menu" href="{{URL::to('live')}}">{{ trans('content.showinnerright.livestream') }}</a></li>
            <li class="<?=($current == 'catchup') ? 'active' : ''?>"><a class="catchup-menu" href="{{URL::to('catchup')}}">Catch Up</a></li>
            <li class="<?=($current == 'news') ? 'active' : ''?>"><a class="news-menu" href="{{URL::to('news')}}">{{ trans('content.showinnerright.news') }} ‎</a></li>
            <li class="<?=($relatedshow == '30348') ? 'active' : ''?>"><a class="drama-menu" href="{{URL::to('relatedshows/30348/%D9%85%D8%B3%D9%84%D8%B3%D9%84%D8%A7%D8%AA')}}">{{ trans('content.showinnerright.series') }}</a></li>
           <!--  <li class="<?=($current == 'allshows') ? 'active' : ''?>"><a class="shows-menu" href="{!! route('allshows') !!}">{{ trans('content.showinnerright.shows') }}</a></li> -->
            <li class="<?=($current == 'show') ? 'active' : ''?>"><a class="allprogrmas-menu" href="{{URL::to('show/allprograms')}}">{{ trans('content.showinnerright.allshows') }}</a></li>
            <li class="<?=($current == 'channels') ? 'active' : ''?>"><a class="channel-menu" href="{{URL::to('channels')}}">{{ trans('content.showinnerright.channels') }}</a></li>
            <li class="<?=($current == 'categories' || ($current == 'relatedshows' /*&& $relatedshow != "207815"*/ && $relatedshow != "30348")) ? 'active' : ''?>"><a class="categories-menu" href="{{URL::to('categories')}}">{{ trans('content.showinnerright.categories') }}</a></li>

        </ul>
    </div>
    @if(ends_with(Route::currentRouteAction(), 'Shows@GetAllShows'))
    <div class="innerpage-rightbar-showsbar">
        <div id="shows-category-divs" class="shows-category-divs clearfix">
            <?php
            $counter = 1;
            ?>
            @if(isset($categories))
            @foreach($categories as $item)
            @if(@empty($item->icon))
            @continue
            @endif
            <?php
            $relatedshows_url = route('relatedshows', [$item->id, ($item->title_ar)]);

            $img = config('mangoapi.mangodcn').$item->icon;
            ?>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="category-block">
                    <a href="{{$relatedshows_url}}?"><img src="{{$img}}" class="img-responsive" alt="{{$item->title_ar}}" /></a>
                    <a class="category-block-hover" href="{{$relatedshows_url}}">{{$item->title_ar}}</a>
                </div>
            </div>
            <?php $counter++?>
            @endforeach
            @endif
        </div>
    </div>
    @elseif(ends_with(Route::currentRouteAction(), 'Home@live'))
    <div class="innerpage-rightbar-showsbar">
        <div id="shows-category-divs" class="shows-category-divs clearfix">
            <?php
            $counter = 1;
            ?>
            @if(isset($inner_channels))
            @foreach($inner_channels as $item)
            @if(@empty($item->icon))
            @continue
            @endif
            <?php
            $live_url = route('live_streaming', [$item->id, ($item->title_ar)]);

            $img = config('mangoapi.mangodcn').$item->live_icon;
            ?>
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="category-block">
                    <a href="{{$live_url}}?"><img src="{{$img}}" class="img-responsive" alt="{{$item->title_ar}}" /></a>
                    <a class="category-block-hover" href="{{$live_url}}">{{$item->title_ar}}</a>
                </div>
            </div>
            <?php $counter++?>
            @endforeach
            @endif
        </div>
    </div>
    @endif
    <div class="innerpage-rightbar-smbar">
        @include('include.social_footericons')

        {{--<p class="copyright-text">Awan &copy; 2016</p>--}}
    </div>
</div>