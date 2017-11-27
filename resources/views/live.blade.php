@extends('layouts.master')
@section('title', trans('content.pagetitle.live')." - ".((Session::get('lang') == 'en')?$channel->title_en:$channel->title_ar))
<!--This defines a home  section which gets displayed via "yield" -->
@section('social_header_meta')

    {{--@include('include.social_header',['content'=>$currentt,'meta'=>$content->ch_meta])--}}

@endsection

@section('main-content')
    <h1 style="display: none;">Awaan live</h1>
    <h2 style="display: none;">Awaan live</h2>
    <h3 style="display: none;">Awaan live</h3>
<!-- LIVE WRAPPER [START]	-->
<div class="live-wrapper">

    <div class="channel-list-wrapper">
        <div class="container">
            <div id="channel-carousel" class="owl-carousel channel-carousel">

                @foreach($channels_list as $index => $info)

                    <div class="item @if($info->id == Request::segment(2)) active @endif">
                    <a href="@if($info->premuim == 1) {{URL::to('gold')."?".\App\Helpers\Functions::cleanurl($info->title_en)}} @else {{URL::to("live/{$info->id}/".\App\Helpers\Functions::cleanurl($info->title_en))}}  @endif">
                        <div class="channel-div">
                            <img src="http://admin.mangomolo.com/analytics/{{$info->live_icon}}" class="img-responsive img-circle center-block" alt="{{$info->title_en}}" />
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div><!-- CONTAINER [END]	-->
    </div>
    <?php
        if(isset($channel->cover) and !empty($channel->cover)){
            $live_cover = 'http://admin.mangomolo.com/analytics/'.$channel->cover;
        }else{
            $live_cover = '';
        }
    ?>
    <div class="channel-content-wrapper" style="background: url({{$live_cover}});background-size: cover; ">
        <div class="container">

            <h4 class="content-title">@if(Session::get('lang') == 'ar') {{$channel->title_ar}} @else {{$channel->title_en}} @endif</h4>
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="video-player-div">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe title="{{$channel->title_ar}}" class="embed-responsive-item" src="http://player.mangomolo.com/v1/live?id={{base64_encode($channel->user_id)}}&channelid={{base64_encode($channel->id)}}&countries=Q0M=&w=100%25&h=100%25&filter=DENY&signature={{$channel->signature}}" allowfullscreen="allowfullscreen" scrolling="no" style="border: 0; overflow: hidden"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="uplcoming-shows-wrapper">
                        <div class="row">
                            @if(isset($channel->catchup) && $channel->catchup)
                                @foreach($live_next as $index => $item)

                                    @if(!is_object($item) || $index == 2)
                                        @break
                                    @endif
                                        <div class="col-md-12 col-sm-6 col-xs-12 live-upcoming-mobo">
                                            <div class="uplcoming-show-div @if($index == 0) active  @else second-live-upcomming @endif">
                                                <div class="uplcoming-shows-img-div" style="background-image: url('{{$item->img}}');"></div>
                                                <div class="uplcoming-shows-program ">
                                                    <div class="overlay"></div>
                                                    <span class="uplcoming-shows-title">{{$item->title}} - @if($index == 0) على الهواء @else يعرض بعد قليل @endif</span>
                                                    <span class="uplcoming-shows-time">{{$item->start_time}} - {{$item->stop_time}}</span>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- LIVE WRAPPER [END]		-->
@endsection

@section("additional_scripts")
    <script  type="text/javascript">
        jQuery(document).ready( function() {
            jQuery('#channel-carousel').owlCarousel({
                navText   : ['',''],
                rtl       : true,
                loop      : true,
                margin    : 25,
                nav       : true,
                responsive: {
                    0:{
                        items:2
                    },
                    400:{
                        items:5
                    },
                    767:{
                        items:7
                    },
                    991:{
                        items:8
                    },
                    1200:{
                        items:9
                    }
                }
            });

        });
    </script>
@endsection
