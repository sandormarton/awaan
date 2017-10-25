@extends('layouts.master_inner')
@section('title',trans('content.pagetitle.premium.premium'))

@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title' => trans('content.pagetitle.premium.premium'),
        'current_description' => trans('content.pagetitle.premium.premium'),
    ])
@endsection

<!--This defines a home  section which gets displayed via "yield" -->


@section('premium')
    <h1 style="display: none;">{{trans('content.pagetitle.premium.premium')}}</h1>
    <!-- MAIN CONTAINER [START] -->
    @include('show_innerright',['categories'=>$categories])


    <div class="innerpage-leftbar">

        <div class="mobile-menu visible-xs">
        	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" alt="DMI AWAAN" /></a>
            <button id='trigger' class="btn btn-mobile-menu">
                <span style="display: none;">mobile</span>
                <i class="ion-navicon-round"></i>
            </button>
        </div>

        <div class="premium-wrapper drama-list-wrapper">
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
	                                             alt="Premium"/>
	                                        <span style="margin-top:5px; background-color: gold;">GOLD</span>
	                                    </a>
	                                </li>
	                            @endif
	                        @endforeach
	                    </ul>
	                </div> 
                </div>
                <div class="premium-box">
                	<div class="row">
                		<div class="col-lg-7 col-md-6 col-sm-6">
                			<div class="media">
								<div class="media-left">
									<a href="{{URL::to('/gold/shows')}}">
									  <img src="/images/awaan-gold.png" alt="أوان GOLD">
									</a>
								</div>
								<div class="media-body">
									<a href="{{URL::to('/gold/shows')}}">
										<h4 class="media-heading">تابع برامجك المفضلة من باقة أوان GOLD</h4>
									</a>
								</div>
							</div>
                        </div>
                		<div class="col-lg-5 col-md-6 col-sm-6">

                			<div class="premiumshows-div">
                				@if(isset($premiumshows) && sizeof($premiumshows) >0 )
                				<div id="premiumshows-list" class="premiumshows-list">                				
                				@foreach($premiumshows as $premiumshow)
                				     <div class="premiumshow">
                				     	<a href="{{URL::to("/show/$premiumshow->id/$premiumshow->title_ar")}}" title="{{$premiumshow->title_ar}}">
                				     		<img src="http://admin.mangomolo.com/analytics/{{$premiumshow->thumbnail}}" class="img-responsive" alt="{{$premiumshow->title_ar}}"/>
                				     	</a>
                				     </div>
                				@endforeach                				
                				</div>
                				@endif
                			</div>
                			
                		</div>




                	</div>
                	<div class="subscriber-user">
                		<a href="{{URL::to('/gold/subscribe')}}"><i class="glyphicon glyphicon-user"></i> {{ trans('content.premiumsummary.my_account') }}</a>
                	</div>
                    <div class="player">                        
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
                                            <a href="{{$url}}"><img data-src="{{$img}}" alt="{{$item->title_ar}}" class="load-onscroll img-responsive center-block" /></a>
                                            <div class="drama-content">
                                                <a href="{{$url}}" class="drama-title giveMeEllipsis"> {{$item->title_ar}}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item"
                                            src="http://admin.mangomolo.com/analytics/index.php/customers/embed/index?id={{base64_encode($channel->user_id)}}&channelid={{base64_encode($channel->id)}}&countries=Q0M=&w=100%25&h=100%25&filter=DENY&signature={{$channel->signature}}&jwplayer=7"
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
                                            @if(count($live_next) > 0)
                                                @if(isset($live_next->now) && count($live_next->now) > 0)
                                                <div class="col-md-4 on-air-program-col">
                                                    <div class="program-div">
                                                        <div class="program-image">
                                                            <img src="{{end($live_next->now)->img}}" class="img-responsive"
                                                                 alt="{{end($live_next->now)->title}}"/>
                                                            <div class="program-timing">{{end($live_next->now)->start_time}}
                                                                - {{end($live_next->now)->stop_time}}</div>
                                                        </div>
                                                        <h3 class="program-title">{{end($live_next->now)->title}}</h3>
                                                        <div class="program-status">
                                                            على الهواء
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if(isset($live_next->next) && count($live_next->next) > 0)
                                                    @for ($i = 0; $i < count($live_next->next); $i++)
                                                        <div class="col-md-4 on-air-program-col">
                                                            <div class="program-div">
                                                                <div class="program-image">
                                                                    <img src="{{$live_next->next[$i]->img}}" class="img-responsive"
                                                                         alt="{{$live_next->next[$i]->title}}"/>
                                                                    <div class="program-timing">{{$live_next->next[$i]->start_time}}
                                                                        - {{$live_next->next[$i]->stop_time}}</div>
                                                                </div>
                                                                <h3 class="program-title">{{$live_next->next[$i]->title}}</h3>
                                                                <div class="program-status">
                                                                    يعرض بعد قليل
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                @endif
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
                <div style="margin: 10px auto; width: 60%; background-color: rgba(26, 26, 26, 0.45); padding: 0px">

                    <div style="font-size: 20pt; text-align: center" class="text-center">
                        <h3><img src="/images/awaangold_banner_{{Session::get('lang')}}.png" class="img-responsive center-block" alt="awaan gold banner"></h3>
                        <h3>{{ trans('content.premiumindex.premiumWatch') }}</h3>
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
                    <div class="more_information_dh" style="padding-top: 10px">
                    	<h3>   {{trans('content.premiumsummary.gold_moreinfo')}}  </h3>
                    </div>
                    <div class="press_here_dh">
                        <a href="{{URL::TO('gold/subscribe-new')}}"> {{trans('content.premiumsummary.gold_landingpage_link')}}  </a>
                    </div>

                    <div class="terms" style="padding-top: 35px; clear: both">
                        <p class="sub-text" data-i18n="account.subscribe_step_one.description_1">{!! trans('content.premiumsubscribe.description_1') !!}</p>
                        <p class="sub-text" data-i18n="account.subscribe_step_one.description_3">{{ trans('content.premiumsubscribe.description_3') }} </p>
                        <p class="sub-text" data-i18n="account.subscribe_step_one.description_4">{{ trans('content.premiumsubscribe.description_4') }} </p>
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
                                                 alt="أوان GOLD"
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
                                             alt="{{$info->title_ar}}"/>
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
                fade: true,
                alt: "football-league"
            });
            $('img[src$="http://admin.mangomolo.com/analytics/uploads/71/football-league-bg5.jpg"]').attr("alt","football-league");
        </script>
    </div>
@endsection
<!-- MAIN CONTAINER [END] -->
