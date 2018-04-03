@include('include.dfp_leaderboard')

<div class="menu-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <nav class="navbar navbar-main">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand site-logo" href="{{URL::to('/')}}" title="AWAAN"><img src="{{ asset("images/logo.png")}}" alt="AWAAN"/></a>
                        @if(isset($notifications))
                            <?php






                            if($notifications->count){
                                $collapse ='collapse';
                                $href ='#menuprogramCollapse';
                            }
                            else{
                                $collapse = '';
                                $href ='javascript:void(0);';
                            }
                            ?>
                            <a class="navbar-brand site-menu-folder" alt="notification-icon" role="button" data-toggle="{{$collapse}}" href="{{$href}}" aria-expanded="false" aria-controls="menuprogramCollapse"><img src="{{ asset("images/icon-folder.png")}}" alt="notification icon" /><span>{{$notifications->count}}</span></a>
                            <div class="col-sm-6 menuprogramCollapse collapse" id="menuprogramCollapse">

                                @foreach($notifications->data as $item)
                                    {{--*/ $img = config('mangoapi.mangodcn').$item->img;/*--}}
                                    {{--*/ $img = config('mangoapi.mangodcn').$item->img;/*--}}
                                    <?php
                                    if(Session::get('lang') == 'ar'){
                                        $title = $item->title_ar;
                                    }else{
                                        $title = $item->title_en;
//                                        $channel_title = $item->channel_title_en;
                                    }
                                    ?>
                                    <div class="menuprogram-list">
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <div class="menuprogram-img">
                                                <a href="{{URL::to("video/open_notification/{$item->notification_id}/{$item->id}/".\App\Helpers\Functions::cleanurl($title))}}">
                                                    <img src="{{$img}}" />
                                                </a>
                                            </div>
                                            <div class="menuprogram-time">
                                                <span>{{date("H:i:s",$item->duration)}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-7">
                                            <div class="menuprogram-content">
                                                <a href="{{URL::to("video/open_notification/{$item->notification_id}/{$item->id}/".\App\Helpers\Functions::cleanurl($item->title_ar))}}">
                                                    <h4>{{(Session::get('lang') == 'ar')?$item->title_ar:$item->title_en}}</h4>
                                                </a>
                                                <span>{{$item->recorder_date}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="@if('' == Request::segment(1)) active @endif"><a href="{{URL::to('/')}}?">{{ trans('content.showinnerright.home') }}</a></li>
                            <li class="@if(('allprograms' == Request::segment(2)) &&('30348' == Request::segment(3))) active @endif"><a href="{{URL::to('show/allprograms/30348/'. trans('content.whole.series') )}}">{{ trans('content.whole.series') }}</a></li>
                            <li class="dropdown @if(( Request::segment(1) == 'radio') || ( Request::segment(1) == 'channels')) active @endif">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    {{ trans('content.showinnerright.channels') }}
                                </a>
                                <div class="dropdown-menu channel-menu">

                                    @if(isset($channels))
                                    @foreach($channels  as $item)
                                        <?php
                                        if(Session::get('lang') == 'ar'){
                                            $title = $item->title_ar;
                                        }else{
                                            $title = $item->title_en;
//                                        $channel_title = $item->channel_title_en;
                                        }
                                        ?>
                                        @if(!empty($title) and $item->premuim != 1 and $item->id != 25 and $item->id != 11)
                                            <?php
                                            if(isset($item->icon)) {
                                                $img = config('mangoapi.mangodcn').$item->icon;
                                            }
                                            ?>
                                                <div class="item @if(($item->id == Request::segment(3)) && ( Request::segment(1) == 'channels')) active @endif"><a href="{{URL::to("channels/view/{$item->id}/".\App\Helpers\Functions::cleanurl($title))}}"><img src="{{$img}}" alt="{{$title}}" /></a></div>
                                        @endif
                                    @endforeach
                                    @endif
                                    <hr class="channel--seperator">
                                     @if(isset($radio_channels))
                                    @foreach($radio_channels as $item)
                                            <?php
                                            if(Session::get('lang') == 'ar'){
                                                $title = $item->title_ar;
                                            }else{
                                                $title = $item->title_en;
//                                        $channel_title = $item->channel_title_en;
                                            }
                                            ?>
                                            @if(!empty($title) and $item->premuim != 1 and $item->id != 25)
                                                <?php
                                                if(isset($item->thumbnail)) {
                                                    $img = config('mangoapi.mangodcn').$item->thumbnail;
                                                }
                                                ?>
                                                <div class="item item-audio @if(($item->id == Request::segment(2)) && ( Request::segment(1) == 'radio')) active @endif"><a href="{{URL::to("radio/{$item->id}/".\App\Helpers\Functions::cleanurl($title))}}"><img src="{{$img}}" alt="{{$title}}" /></a></div>
                                            @endif
                                    @endforeach
                                        @endif
                                </div>
                            </li>
                            <li class="@if('catchup' == Request::segment(1)) active @endif"><a href="{{URL::to('catchup')}}">Catch Up</a></li>

                            <li class="@if('live' == Request::segment(1)) active @endif"><a href="{{URL::to('live')}}">{{ trans('content.showinnerright.livestream') }}</a></li>
                            {{--<li class="@if('categories' == Request::segment(1)) active @endif"><a href="{{URL::to('categories')}}">{{ trans('content.showinnerright.categories') }}</a></li>--}}
                            {{--<li><a href="#">أوان GOLD</a></li>--}}
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <p style="display: none">navigator</p>
                                    <i class="menu-icon-i" aria-hidden="true"></i>
                                    <i class="menu-icon-i" aria-hidden="true"></i>
                                    <i class="menu-icon-i" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li ><a class="@if(('allprograms' == Request::segment(2)) &&('' == Request::segment(3))) active @endif" href="{{URL::to('show/allprograms/' )}}">{{ trans('content.whole.all_shows') }}</a></li>
                                    <li><a class="@if('categories' == Request::segment(1)) active @endif" href="{{URL::to('categories')}}">{{ trans('content.showinnerright.categories') }}</a></li>
                                    {{--<li><a href="{{URL::to('channels')}}">{{ trans('content.showinnerright.channels') }}</a></li>--}}
                                    {{--<li><a href="{{URL::to('news')}}">{{ trans('content.showinnerright.news') }}</a></li>--}}
                                    {{--<li><a href="#">أوان GOLD</a></li>--}}
                                </ul>
                            </li>
                        </ul>

                    </div><!-- /.navbar-collapse -->

                </nav>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="searchform-div">
                    <div class="radiobtn-div">
                        <a href="javascript:void(0);" class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <img src="{{ asset("images/icon-audio.png")}}" alt="awaan audio icon" />
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            @if(isset($radio_channels))
                            @foreach($radio_channels as $channel)
                                <li><a href="{{URL::to("radio/".$channel->id."/".\App\Helpers\Functions::cleanurl($channel->title_ar))}}">{{$channel->title_ar}}</a></li>
                            @endforeach
                                @endif
                        </ul>
                    </div>
                    <div class="languageswitcher-div">
                        @if(Session::get('lang') == 'ar')
                            <a style="display: none" data-lang="ar" id="language-selected"></a>
                            <a href="{{URL::to('set/en')}}" class="btn btn-awaanbluebtn btn-languageswitcher">En</a>
                        @else
                            <a style="display: none" data-lang="en" id="language-selected"></a>
                            <a href="{{URL::to('set/ar')}}" class="btn btn-awaanbluebtn btn-languageswitcher">عر</a>
                        @endif
                    </div>
                    <div class="userbtn-div dropdown">
                        <div class="btn btn-awaanbluebtn btn-user dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-user"></i></div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            @if(Session::has('user_info'))
                                <li><a href="#">{{Session::get('user_info')->username}}</a></li>
                                <li><a href="{{URL::to("video/favoritesvideos")}}">{{ trans('content.showinnerright.favoritevideos') }}</a></li>
                                <li><a href="{{URL::to("video/favoritesfilms")}}">{{ trans('content.showinnerright.favoritevideosfilms') }}</a></li>
                                <li><a href="{{URL::to("shows/favoriteshows")}}">{{ trans('content.showinnerright.favoriteshows') }}</a></li>
                                <li><a href="{{URL::to("auth/logout")}}">{{ trans('content.showinnerright.signout') }}</a></li>
                            @else
                                <li><a href="{{URL::to("auth/login")}}">{{ trans('content.showinnerright.signin') }}</a></li>
                                <li><a href="{{URL::to("auth/register")}}">{{ trans('content.showinnerright.register') }}</a></li>
                            @endif
                        </ul>
                    </div>


                    <form class="form-inline search-form" action="{!! route('search') !!}" method="post">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <div class="form-group">
                            <label for="inputSearchTerm" style="display: none">Search</label>
                            <input type="text" class="form-control" placeholder="{{ trans('content.search.placeholder') }}" id="inputSearchTerm" name="term" spellcheck="false" autocomplete="off" pattern=".{3,}"   required title="{{ trans('content.whole.limit_3_words') }}" >
                        </div>
                        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i><h1 style="display: none">test</h1></button>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
