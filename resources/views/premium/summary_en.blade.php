@extends('layouts.master_inner')
@section('title', 'Premium')
        <!--This defines a home  section which gets displayed via "yield" -->

@section('premium')
        <!-- MAIN CONTAINER [START] -->
@include('show_innerright',['categories'=>$categories])


<div class="innerpage-leftbar" >

    <div class="mobile-menu visible-xs">
    	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" title="AWAAN" alt="AWAAN" /></a>
        <button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
    </div>
    <div class="premium-wrapper drama-list-wrapper">
        <div class="account-all-page-container" style="">

        <div class="col-md-12 account-list-container" >
            <h3 class="title-container"><span data-i18n="account.title">Account</span></h3>
            <div class="row account">
                <div class="col-md-12 " style="font-size: 18px; direction: ltr; text-align: left;">
                    {{--<h2><span data-i18n="premium.titlePremium">  {{ trans('content.premiumsummary.titlePremium') }}  </span></h2>--}}
                    {{--<p>{{ trans('content.premiumsummary.premiumWatch') }} </p>--}}
                    <h2>Awaan Gold Package</h2>
                    <p>
                        <strong>Awaan Drama:</strong> Contains all the parts of the historical series Hareem Al Sultan, in addition to the

                        latest Gulf series (Dubai London Dubai, Bent w Shayeb, Yaman kont Habebe and more).
                    </p>

                    <p>
                        <strong>Seevii Package:</strong> is a bouquet of five entertainment television channels that offers a wide range

                        of the best Arab series and programs that will satisfy all tastes and ages.
                    </p>

                    <h3>SEEVII Al Oula</h3>

                    <p>Offers a selection of the latest television series, and enables you to keep better track of the top

                        Arab drama productions this year with a selection of high-quality series from Egypt, Syria, the

                        Gulf, Jordan and Lebanon.</p>

                    <h3>SEEVII Drama</h3>

                    <p>It is a distinctive entertainment channel that enables Arab viewers the chance to follow their

                        favorite shows without commercial breaks. The channel contains a variety of high quality Arab

                        serials and programs from Egypt, the Gulf and Syria.</p>

                    <h3>SEEVII Shameya</h3>

                    <p>A channel addressed especially for Syrian drama fans, as it offers elite Syrian TV productions

                        that are being produced annually. It also allow  you to follow up on all programs without

                        commercial breaks and offers a comprehensive entertainment content varies between drama,

                        comedy and historical.</p>

                    <h3>SEEVII BEELINK</h3>

                    <p>A channel that offers the best TV series in the Arab world, and soon it will showcase the most

                        important dubbed Turkish show.</p>

                    <br>
                    @if($status != '' && $status != 'cancelled' && $status != 'Canceled'  )

                    <p class="sub-text"></p>

                    <div class="content">
                        <h2 data-i18n="account.subscribe.info.title"> {{ trans('content.premiumsummary.title') }} </h2>
                        <p style="background: rgba(162, 163, 168, 0.50); color: #000; margin-top: 10px; padding: 3px 10px 10px 10px; border-radius: 5px;">
                            <span data-i18n="account.subscribe.info.status">{{ trans('content.premiumsummary.status') }} </span>:
                            <b style="text-transform: capitalize;">{{$contract}}</b><br>
                            <span data-i18n="account.subscribe.info.payment_type"> {{ trans('content.premiumsummary.payment_type') }}</span>: <b style="text-transform: capitalize;" data-i18n="">{{trans('content.premiumsummary.payment_type')}}</b><br>
                            <span data-i18n="account.subscribe.info.recurring_period"> {{ trans('content.premiumsummary.recurring_period') }}</span>: <b data-i18n="account.subscribe.info.payment_circle">{{trans('content.premiumsummary.payment_circle')}}</b><br>
                            <span data-i18n="account.subscribe.info.mobile_number">{{ trans('content.premiumsummary.mobile_number') }} </span>: <b style="font-family: Arial">{{$item->msisdn}}</b><br>
                            <span data-i18n="account.subscribe.info.subscription_date">{{ trans('content.premiumsummary.subscription_date') }} </span>: <b style="font-family: Arial">{{$item->created_time}}</b>
                        </p>
                        @if($status == 'new' && $item->verified != '1')
                        <p><a href="{!! route('subscribe') !!}" class="btn red-btn pull-right"  data-i18n="account.active_btn">{{ trans('content.premiumsummary.active_btn') }}</a></p>
                        @endif
                    </div>

                    <p>
                        @if($status == 'active')
                        <div class="alert alert-success" role="alert" style="max-width: 300px">
                            <span class="glyphicon glyphicon-info-sign"></span> <span class="message">{{ trans('content.premiumsummary.subscribed_active') }}</span>
                        </div>
                        @endif

                        <a href="#" class="btn btn-danger subscribe-cancel"  data-i18n="account.cancel_big_btn">{{ trans('content.premiumsummary.cancel_big_btn') }}</a>

                    </p>

                    @else

                    <p class="sub-text"><span data-i18n="premium.premiumMonth">{{ trans('content.premiumsummary.premiumMonth') }} </span></p>
                    <p class="sub-text"><span data-i18n="premium.PremiumCurrently">Currently supported operators: Du (UAE) - AED 50 / month, Mobily (SAU) - SAR 50 / month, Vodafone (EGY) - EGP 100 / month, Orange (EGY) - EGP 100 / month, Jawwal (PSE) </span></p>
                    <!--<h1 style="color: #ffb400"><span style="font-size: 48px">50</span> <span data-i18n="premium.per"> per month</span></h1>-->
                    <a href="{!! route('subscribe') !!}" class="btn red-btn subscribe-btn" style="font-size: 25px; padding: 0 20px 0 20px; margin-bottom: 10px"><span data-i18n="premium.subscribe">{{ trans('content.premiumsummary.subscribe') }} </span></a>

                    @endif
                    <!--<p>اتصل بخدمة دعم العملاء على  00971564139143</p>-->
                </div>
            </div>
        </div>

        <div id="confirm" style="display:none">
            <div class="container" style="min-width:300px; padding: 5px; max-width:500px">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-info-circle"></i> <span data-i18n="account.subscribe.cancellation.title"> {{ trans('content.premiumsummary.cancel_big_btn') }} </span></h3>
                            <span class="clearfix"></span>
                        </div>
                        <div class="panel-body" data-i18n="account.subscribe.cancellation.message" style="color: black">
                            {{ trans('content.premiumsummary.cancelationmessage') }}
                        </div>
                        <div class="panel-footer">
                            <div class="row" style="padding: 10px;">
                                <button type="button" data-dismiss="modal" class="btn btn-primary" id="cancel_ok" data-i18n="account.subscribe.cancellation.yes"> {{ trans('content.premiumsummary.yes') }}</button>
                                <button type="button" data-dismiss="modal" class="btn btn-warning" id="no_cancel" data-i18n="account.subscribe.cancellation.no"> {{ trans('content.premiumsummary.no') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>

    @include('include.inner_footer')

    <script>
        $(".premium-wrapper").backstretch("http://admin.mangomolo.com/analytics/uploads/71/football-league-bg5.jpg", {centeredX: true, centeredY: true, fade: true});

        basket.require(
            {url: '{{asset("/js/premium.js")}}', skipCache: true},
            {url: '{{asset("/js/main.js")}}', skipCache: true}
        ).then(function () {
            subscribe_cancellation();
        });

    </script>
</div>
@endsection
        <!-- MAIN CONTAINER [END] -->
