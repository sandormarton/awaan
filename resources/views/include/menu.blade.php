<a href="#" class="menu-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Awaan">
    <i class="menu-icon-i"></i>
    <i class="menu-icon-i"></i>
    <i class="menu-icon-i"></i>
    <span class="hidden">Menu</span>
</a>

<!--<ul class="dropdown-menu" data-dropdown-out="fadeOut" data-dropdown-in="fadeIn">-->
<ul class="dropdown-menu">
    <li><a href="{{URL::to('/')}}">{{ trans('content.showinnerright.home') }}</a></li>
    <li><a href="{{URL::to('live')}}">{{ trans('content.showinnerright.livestream') }}</a></li>
    {{-- <li><a href="{!! route('allshows') !!}" title="{{ trans('content.showinnerright.vod') }}">{{ trans('content.showinnerright.vod') }}</a></li> --}}
    <li><a href="{{URL::to('catchup')}}">CATCH-UP</a></li>

{{--    <li><a href="{{URL::to('gold')}}" >{{ trans('content.showinnerright.premium') }}</a></li>--}}
    <li><a href="{{URL::to('news')}}" >{{ trans('content.showinnerright.news') }}</a></li>
    <li><a class="allprogrmas-menu" href="{{URL::to('show/allprograms')}}" >{{ trans('content.showinnerright.allshows') }}</a></li>
    <li><a href="{{URL::to('categories')}}" >{{ trans('content.showinnerright.categories') }}</a></li>
    <li><a href="{{URL::to('channels')}}" >{{ trans('content.showinnerright.channels') }}</a></li>
    {{--<li><a href="http://dcndigital.com/search">{{ trans('content.showinnerright.search') }}</a></li>--}}
    @if(Session::has('user'))
    <li class="divider"></li>
    <li><a href="{{URL::to('video/favoritesvideos')}}" title="{{ trans('content.showinnerright.favoritevideos') }}">{{ trans('content.showinnerright.favoritevideos') }}</a></li>
    <li><a href="{{URL::to('shows/favoriteshows')}}" title="{{ trans('content.showinnerright.favoriteshows') }}">{{ trans('content.showinnerright.favoriteshows') }}</a></li>
    <li class="divider"></li>
    <li><a href="{{URL::to('video/resume')}}" title="{{ trans('content.showinnerright.resume') }}">{{ trans('content.showinnerright.resume') }}</a></li>
    @endif
    <li class="divider"></li>
    @if(Session::get('lang') == 'ar')
        <li><a href="{{URL::to('set/en')}}" >{{ trans('content.showinnerright.opositelanguage') }}</a></li>
    @else
        <li><a href="{{URL::to('set/ar')}}" >{{ trans('content.showinnerright.opositelanguage') }}</a></li>
    @endif
    <li class="menu-level-2">
        @if(Session::has('user'))
            <a href="{{URL::to('/auth/logout')}}" data-toggle="modal" role="button" aria-expanded="false" >{{ trans('content.showinnerright.signout') }}</a></li>
        @else
            <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" >{{ trans('content.showinnerright.signin') }}</a>
            <a  href="javascript:void(0);" data-toggle="modal" data-target="#registerModal" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" >{{ trans('content.showinnerright.register') }}</a></li>
    @endif
            <!--<li class="menu-copyright">&copy; 2016<br/> Dubai Channels Network</li>-->
</ul>




