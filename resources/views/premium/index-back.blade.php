@extends('layouts.master_inner')
@section('title',trans('content.pagetitle.premium.premium'))

<!--This defines a home  section which gets displayed via "yield" -->

@section('premium')
    <!-- MAIN CONTAINER [START] -->
    @include('show_innerright',['categories'=>$categories])


    <div class="innerpage-leftbar">

        <div class="mobile-menu visible-xs">
            <button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
        </div>

        <div class="premium-wrapper drama-list-wrapper" style="height: 100vh; min-height: 100%">
            @if( isset($check->status) && strtolower($check->status) == 'active' )
                <div class="premium-channels-list">
                	<div class="col-lg-8 col-md-10 premium-channels-list-div">
	                    <ul id="livebroadcast-channel-list-ul" class="list-inline premium-channels-ul">
	                        @foreach($channels as  $info)
	                            <?php
	                            // $url = route('/gold/', [$info->id, ($info->title_ar)]);
	                            ?>
	                            @if($info->premuim == 1)
	                                <li>
	                                    <a class="@if(Request::segment(2)==$info->id) selected @endif channel-id-{{$info->id}}"
	                                       href="{{URL::to("/gold/$info->id/$info->title_ar")}}" data-id="{{$info->id}}">
	                                        <img style="max-width:100px; max-height:100px"
	                                             class="img-responsive inline-block"
	                                             src="http://admin.mangomolo.com/analytics/{{$info->live_icon}}"
	                                             title="Premium" alt="Premium"/>
	                                        <span style="margin-top:5px; background-color: gold;">GOLD</span>
	                                    </a></li>
	                            @endif
	                        @endforeach
	                    </ul>
	                </div> 
                </div>
                <div class="premium-box">
                    <div class="player">
                        <p style="text-align: center">
                            <a href="{{URL::to('/gold/shows')}}">
                                 <label style="color: #FFF">
                                     تابع برامجك المفضلة من باقة أوان GOLD
                                     &nbsp; &nbsp;<img style="max-height: 100px; max-width: 100px" src="/images/awaan-gold.png"></label>
                              ‎</a><br><br>
                            <a href="{{URL::to('/gold/subscribe')}}" style="color: white"><i
                                        class="glyphicon glyphicon-user"></i> حسابي </a></p>
                        <div class="livebroadcast-player-wrapper">
                            @if(isset($shows) && sizeof($shows) >0 )
                                @foreach($shows as $item)
                                    <?php
                                    $img = config('mangoapi.mangodcn').$item->thumbnail;
                                    ?>
                                    <div class="col-md-6">
                                        <div class="drama-box">
                                            @if(isset( $item->premium ) and $item->premium == 1)
                                                <div class="ribbon" style="right: -5px !important;"><span>GOLD</span></div>
                                            @endif
                                            <?php
                                            $url = route('show', [$item->id, \App\Helpers\Functions::cleanurl($item->title_ar)]);
                                            ?>
                                            <a href="{{$url}}"><img data-src="{{$img}}" class="load-onscroll img-responsive center-block" /></a>
                                            <div class="drama-content">
                                                <a href="{{$url}}" class="drama-title giveMeEllipsis"> {{$item->title_ar}}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item"
                                            src="http://admin.mangomolo.com/analytics/index.php/customers/embed/index?id={{base64_encode($channel->user_id)}}&channelid={{base64_encode($channel->id)}}&countries=Q0M=&w=100%&h=100%&filter=DENY&signature={{$channel->signature}}&jwplayer=7"
                                            allowtransparency allowfullscreen></iframe>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if(!isset($shows))
                        <div class="livebroadcast-wrapper">
                            <div class="livebroadcast-content-wrapper">
                                <div class="clearfix row">
                                    <div class="col-lg-12 col-md-12 channel-content-column">

                                        <h3 class="channel-name">{{$channel->title_ar}}
                                            @if($channel->id != 11)
                                            <a href="{{URL::to("/gold/".$channel->id."/schedule")}}" class="pull-left">جدول البرامج</a>
                                            @endif
                                        </h3>
                                        <div class="row">
                                            @if(is_array($live_next) && count($live_next) > 0)
                                                @foreach($live_next as $index => $item)
                                                    @if($index == 3)
                                                        @break
                                                    @endif
                                                    @if(isset($item->title))
                                                    <div class="col-md-4 on-air-program-col">
                                                        <div class="program-div">
                                                            <div class="program-image">
                                                                <img src="{{$item->img}}" class="img-responsive"
                                                                     title="{{$item->title}}" alt="{{$item->title}}"/>
                                                                <div class="program-timing">{{$item->start_time}}
                                                                    - {{$item->stop_time}}</div>
                                                            </div>
                                                            <h3 class="program-title">{{$item->title}}</h3>
                                                            <div class="program-status">
                                                                @if($index == 0)
                                                                    على الهواء
                                                                @else
                                                                    يعرض بعد قليل
                                                                @endif</div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>

                                    </div>
                                    <!--<div class="col-lg-4 col-md-12 mango-social-column">
                                        <div class="mango-social-wrapper">
                                            <iframe class="" src="http://social.mangomolo.com/public/?client_id=NzE=&channel_id=6&current=http%3A%2F%2Fdcndigital.ae%2F%23%2Flive%2F6%2Fdubai-tv&via=dcndigital"></iframe>
                                        </div>
                                    </div>-->
                                </div>
                            </div>

                        </div>
                    @endif

                </div>
            @else
                <div style="margin: 8% auto; width: 60%; background-color: rgba(26, 26, 26, 0.45); padding: 0px">

                    <div style="font-size: 20pt; text-align: center" class="text-center">
                        <p><img src="/images/awaangold_banner.png" class="img-responsive center-block"></p>
                        <p>{{ trans('content.premiumindex.premiumWatch') }}</p>
                    </div>

                    <div class="premium-text-price" style="width: 100%; text-align: center">
                        @if(Session::has('user'))
                            <a href="{!! route('subscribe') !!}">
                                <span>{{ trans('content.premiumindex.subscribe') }}</span></a>
                        @else

                            <a data-toggle="modal" data-target="#loginModal" role="button" aria-haspopup="true"
                               aria-expanded="false" href="#"><span>{{trans('home.header.signin')}}</span></a> | <a
                                    data-toggle="modal" data-target="#registerModal" role="button" aria-haspopup="true"
                                    aria-expanded="false" href="#"><span>{{trans('home.header.register')}}</span></a>
                        @endif
                    </div>

                </div>

                <div class="premium-channels-list">
                    <ul class="list-inline premium-channels-ul">
                        @foreach($channels as $idx => $info)
                            <?php
                            // $url = route('/gold/', [$info->id, ($info->title_ar)]);
                            ?>
                            @if($idx == 0)
                                    <li >
                                        <a href="{{URL::to("/gold/shows")}}" >
                                            <img style=" max-width:100px; max-height:100px"
                                                 class="img-responsive inline-block"
                                                 src="/images/awaan-gold.png"
                                            />
                                        </a></li>
                            @endif
                            @if($info->premuim == 1)
                                <li>
                                    <a class="@if(Request::segment(2)==$info->id) selected @endif channel-id-{{$info->id}}"
                                       href="{{URL::to("/gold/$info->id/$info->title_ar")}}" data-id="{{$info->id}}">
                                        <img style="max-width:100px; max-height:100px"
                                             class="img-responsive inline-block"
                                             src="http://admin.mangomolo.com/analytics/{{$info->live_icon}}"
                                             title="Premium" alt="Premium"/>
                                        <span style="margin-top:5px; background-color: gold;">GOLD</span>
                                    </a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>

            @endif

        </div>

        @include('include.inner_footer')

        <script>
            $(".premium-wrapper").backstretch("http://admin.mangomolo.com/analytics/uploads/71/football-league-bg5.jpg", {
                centeredX: true,
                centeredY: true,
                fade: true
            });

        </script>
    </div>
@endsection
<!-- MAIN CONTAINER [END] -->
