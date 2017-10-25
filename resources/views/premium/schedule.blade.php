@extends('layouts.master_inner')
@section('title',trans('content.pagetitle.premium.premium'))

<!--This defines a home  section which gets displayed via "yield" -->

@section('premium')
    <!-- MAIN CONTAINER [START] -->
    @include('show_innerright',['categories'=>$categories])

    <div class="innerpage-leftbar">

        <div class="mobile-menu visible-xs">
        	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" title="AWAAN" alt="AWAAN" /></a>
            <button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
        </div>

        <div class="premium-wrapper drama-list-wrapper" style="height: 100vh; min-height: 100%">
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
                    <div class="col-md-12">

                        {{--<p>The .table-striped class adds zebra-stripes to a table:</p>--}}
                        <table class="table table-condensed" style="width: 70%; margin: 0 auto">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="3"><h1>{{$channel->title_ar}}
                                        <button href="#" onclick="window.history.back()" class="btn btn-sm pull-left" style="background-color: rgb(47, 141, 203)">العودة</button>
                                    </h1>

                                </td>
                            </tr>
                            @if(!empty($shows))
                            @foreach($shows as $show)
                            <tr>
                                <td><img src="{{$show->img}}" style="height: 120px" class="img-thumbnail img-responsive"></td>
                                <td style="vertical-align: middle; font-size: 12pt">{{$show->title}}</td>
                                <td  style="vertical-align: middle; direction: ltr; font-size: 12pt text-align: center"> {{$show->start_time}} UAE</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="2">لا يوجد جدول</td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
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
