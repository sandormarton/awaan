@include('include.dfp_leaderboard')

<header class="header-wrapper">

    <div class="navbar navbar-main">

        <div class="left-menu-container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-logo" href="{{URL::to('/')}}"><img src="{{asset("images/logo-2.png")}}" /></a>
                <div class="hidden-xs navbar-brand">
                    <div class="btn-group">
                        <button type="button" class="btn btn-menu-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="glyphicon glyphicon-menu-hamburger"></i>
                        </button>
                        <ul class="dropdown-menu mainmenu-dropdown-menu">
                            <li><a href="{{URL::to('/')}}">{{ trans('content.showinnerright.home') }}</a></li>
                            <li><a href="{{URL::to('live')}}">{{ trans('content.showinnerright.livestream') }}</a></li>
                            <li><a href="{{URL::to('live')}}">{{ trans('content.showinnerright.ramadan') }}</a></li>
                            <li><a href="{!! route('allshows') !!}">{{ trans('content.showinnerright.vod') }}</a></li>
                            <li><a href="{{URL::to('catchup')}}">CATCH-UP</a></li>
                            <li><a href="{{URL::to('gold')}}">{{ trans('content.showinnerright.premium') }}</a></li>
                            <li><a href="{{URL::to('news')}}">{{ trans('content.showinnerright.news') }}</a></li>
                            <li><a href="{{URL::to('relatedshows/30348/مسلسلات')}}">{{ trans('content.showinnerright.series') }}</a></li>
                            <li><a class="allprogrmas-menu" href="{{URL::to('show/allprograms')}}">{{ trans('content.showinnerright.allshows') }}</a></li>
                            <li><a href="{{URL::to('categories')}}">{{ trans('content.showinnerright.categories') }}</a></li>
                            <li><a href="{{URL::to('channels')}}">{{ trans('content.showinnerright.channels') }}</a></li>

                            {{--<li><a href="http://smartmedialive.com/">{{ trans('content.gitex') }}</a></li>--}}
                            {{--<li><a href="http://dcndigital.ae/search">{{ trans('content.showinnerright.search') }}</a></li>--}}

                            @if(Session::has('user'))
                                <li class="divider"></li>
                                <li><a href="{{URL::to('video/favoritesvideos')}}">{{ trans('content.showinnerright.favoritevideos') }}</a></li>
                                <li><a href="{{URL::to('shows/favoriteshows')}}">{{ trans('content.showinnerright.favoriteshows') }}</a></li>
                            @endif
                            <li class="divider"></li>
                            @if(Session::get('lang') == 'ar')
                                <li><a href="{{URL::to('set/en')}}">{{ trans('content.showinnerright.opositelanguage') }}</a></li>
                            @else
                                <li><a href="{{URL::to('set/ar')}}">{{ trans('content.showinnerright.opositelanguage') }}</a></li>
                            @endif
                            <li class="menu-level-2">
                                @if(Session::has('user'))
                                    <a href="{{URL::to('/auth/logout')}}" data-toggle="modal" role="button" aria-expanded="false">{{ trans('content.showinnerright.signout') }}</a></li>
                            @else
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('content.showinnerright.signin') }}</a><li>
                                    <a  href="javascript:void(0)" data-toggle="modal" data-target="#registerModal" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('content.showinnerright.register') }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <ul class="hidden-xs nav navbar-nav">
                <li><a href="{{URL::to('live')}}">{{ trans('content.showinnerright.livestream') }}</a></li>
                <li><a href="{{URL::to('live')}}">{{ trans('content.showinnerright.ramadan') }}</a></li>
                <li><a href="{!! route('allshows') !!}">{{ trans('content.showinnerright.vod') }}</a></li>
                <li><a href="{{URL::to('catchup')}}">CATCH-UP</a></li>
                <li><a href="{{URL::to('gold')}}">{{ trans('content.showinnerright.premium') }}</a></li>
                <li><a href="{{URL::to('categories')}}">{{ trans('content.showinnerright.categories') }}</a></li>
                <li><a href="{{URL::to('channels')}}">{{ trans('content.showinnerright.channels') }}</a></li>
                {{--<li><a href="http://smartmedialive.com/">{{ trans('content.gitex') }}</a></li>--}}

                {{--                <li><a href="{{URL::to('news')}}">{{ trans('content.showinnerright.news') }}</a></li>--}}
                {{--<li><a href="http://dcndigital.ae/mydcn/">MYDCN#</a></li>--}}
                {{--<li><a href="http://dcndigital.com/search">{{ trans('content.showinnerright.search') }}</a></li>--}}
            </ul>

            <div class="visible-xs mobile-menu-wrapper">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="{{URL::to('live')}}">{{ trans('content.showinnerright.livestream') }}</a></li>
                        <li><a href="{{URL::to('live')}}">{{ trans('content.showinnerright.ramadan') }}</a></li>
                        <li><a href="{!! route('allshows') !!}">{{ trans('content.showinnerright.vod') }}</a></li>
                        <li><a href="{{URL::to('catchup')}}">CATCH-UP</a></li>
                        <li><a href="{{URL::to('gold')}}">{{ trans('content.showinnerright.premium') }}</a></li>
                        <li><a href="{{URL::to('categories')}}">{{ trans('content.showinnerright.categories') }}</a></li>
                        <li><a href="{{URL::to('channels')}}">{{ trans('content.showinnerright.channels') }}</a></li>
                        {{--<li><a href="http://smartmedialive.com/">{{ trans('content.gitex') }}</a></li>--}}

                        {{--                        <li><a href="{{URL::to('news')}}">{{ trans('content.showinnerright.news') }}</a></li>--}}
                        {{--<li><a href="http://dcndigital.ae/mydcn/">MYDCN#</a></li>--}}
                        {{--<li><a href="http://dcndigital.com/search">{{ trans('content.showinnerright.search') }}</a></li>--}}
                    </ul>
                </div>
            </div>

        </div>

        <div class="search-form-container">

            <div class="btn-group">
                <button type="button" class="navbar-left btn btn-user-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(Session::has('user'))
                        Welcome
                    @else
                        {{ trans('content.showinnerright.signin') }}
                    @endif
                    <i class="ion-ios-arrow-down"></i>
                </button>
                <ul class="dropdown-menu user-dropdown-menu">
                    @if(Session::has('user'))
                        <li>
                            <a href="{{URL::to('/auth/logout')}}" data-toggle="modal" role="button" aria-expanded="false">{{ trans('content.showinnerright.signout') }}</a></li>
                        <li><a href="{{URL::to('video/resume')}}">{{ trans('content.showinnerright.resume') }}</a></li>
                    @else
                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('content.showinnerright.signin') }}</a></li>
                        <li><a  href="javascript:void(0)" data-toggle="modal" data-target="#registerModal" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('content.showinnerright.register') }}</a></li>
                    @endif
                </ul>
            </div>
            <div class="btn-group">
                <button type="button" class="navbar-left btn btn-search-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
                <div class="dropdown-menu search-dropdown">
                    <form action="{!! route('search') !!}" class="navbar-form search-form" role="search" method="post">
                        <div class="input-group">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <input type="text" placeholder="@if(Session::get('lang') == 'en') Search @else ابحث هنا @endif" class="form-control" name="term" spellcheck="false" autocomplete="off">
                            <span class="input-group-btn">
										<button class="btn btn-search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
									</span>
                        </div><!-- /input-group -->
                    </form>
                </div>
            </div>

        </div>

    </div>
</header>
