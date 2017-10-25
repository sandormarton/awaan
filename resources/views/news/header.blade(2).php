<div class="newspage-header-wrapper clearfix">
    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 header-right-part-div">
        <div class="dropdown menu-div">
            <a href="#" class="menu-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="menu-icon-i"></i>
                <i class="menu-icon-i"></i>
                <i class="menu-icon-i"></i>
            </a>

            <ul class="dropdown-menu" data-dropdown-out="fadeOut" data-dropdown-in="fadeIn">
                <li><a href="{{URL::to('/')}}">{{ trans('home.header.home') }}</a></li>
                <li><a href="{{URL::to('live')}}">{{ trans('home.header.livestream') }}</a></li>
                <li><a href="{{URL::to('allshows')}}">{{ trans('home.header.vod') }}</a></li>
                <li><a href="{{URL::to('catchup')}}">CATCH-UP</a></li>
                <li><a href="{{URL::to('premium')}}">{{ trans('home.header.premium') }}</a></li>
                <li><a href="{{URL::to('news')}}">{{ trans('home.header.news') }}</a></li>
                <li><a href="http://dcndigital.ae/mydcn/">MYDCN#</a></li>
                <li><a href="http://dcnsearch.com/">{{ trans('home.header.search') }}</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::to('video/favoritesvideos')}}">{{ trans('home.header.favoritevideo') }}</a></li>
                <li><a href="{{URL::to('shows/favoriteshows')}}">{{ trans('home.header.favoriteshows') }}</a></li>
                <li class="divider"></li>
                @if(Session::get('lang') == 'ar')
                <li><a href="{{URL::to('set/en')}}">ENGLISH</a></li>
                @else
                <li><a href="{{URL::to('set/ar')}}">{{ trans('home.header.opositelanguage') }}</a></li>
                @endif
                <li class="menu-level-2">
                    @if(Session::has('user'))
                    <a href="{{URL::to('/auth/logout')}}" data-toggle="modal" role="button" aria-expanded="false">{{ trans('home.header.signout') }}</a>
                    @else
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('home.header.signin') }}</a>
                    <a  href="javascript:void(0)" data-toggle="modal" data-target="#registerModal" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('home.header.register') }}</a></li>
                @endif
                <!--<li class="menu-copyright">&copy; 2016<br/> Dubai Channels Network</li>-->
            </ul>
        </div>
        <div class="logo-div">
            <a href="{{URL::to('/')}}"><img src="{{ asset("images/logo-2.png")}}" title="AWAAN" alt="AWAAN" /></a>
        </div>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 header-left-part-div">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                <!--<div class="social-media-div">
    <ul class="social-media-ul">
        <li><a href="#"><img src="images/icon-newspage-facebook.png" /></a></li>
        <li><a href="#"><img src="images/icon-newspage-twitter.png" /></a></li>
        <li><a href="#"><img src="images/icon-newspage-youtube.png" /></a></li>
    </ul>
</div>-->
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
                <div class="stock-box-div">
                    <span class="stock-name">DF MGI</span>
                    <span class="stock-status"><i class="ion-arrow-down-b"></i> 3,423.91</span>
                    <span class="stock-average">9.78 | 0.28%</span>
                </div>
                <ul class="language-selector">
                    @if(Session::get('lang') == 'ar')
                    <li><a href="{{URL::to('set/en')}}">EN</a></li>
                    @else
                    <li><a href="{{URL::to('set/ar')}}">ع</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                <div class="search-div">
                    <form method="post" action="{!! route('search') !!}">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-search" type="submit"><img src="{{ asset("images/icon-search.png")}}" title="Search" alt="Search"></button>
                            </span>
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <!--  -CSRF protection out of the box-->
                            <input type="text" name="term" class="form-control" placeholder="{{ trans('content.searchmorevideos') }}"/>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

</div>

<div class="newspage-headermenu-wrapper clearfix">
    <nav class="navbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header visible-xs">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#newspage-collapse-menu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">DCN</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="newspage-collapse-menu">
            <ul class="nav navbar-nav">
                @foreach($categories as $id=>$categorie)

                <li><a href="{{URL::to('news/categories/'.$id.'/'.\App\Helpers\Functions::cleanurl($categorie))}}">{{$categorie}}</a></li>
                @endforeach
            </ul>
            <!--            <ul class="nav navbar-nav navbar-left">
                            <li><a href="#">Market watch</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">أخبار عاجلة <span class="ion-chevron-down"></span></a>
                                <ul class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                        </ul>-->
        </div><!-- /.navbar-collapse -->

    </nav>
</div>