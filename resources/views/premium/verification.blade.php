@extends('layouts.master_inner')
@section('title', trans('content.pagetitle.premium.activation'))

<!--This defines a home  section which gets displayed via "yield" -->

@section('subscribe')
<!-- MAIN CONTAINER [START] -->
@include('show_innerright',['categories'=>$categories])


<div class="innerpage-leftbar @if(Session::get('lang') == 'ar') text-left @else text-right @endif">

    <div class="mobile-menu visible-xs">
    	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" title="AWAAN" alt="AWAAN" /></a>
        <button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
    </div>

    <div class="premium-wrapper drama-list-wrapper" style="height: 100vh; min-height: 100%">
        <div class="account-all-page-container">

            <div class="col-md-12 account-list-container">
                <h3 class="title-container">
                    {{ trans('content.premiumsummary.free') }} <span class="premium-price"> {{$amount}} </span> <span class="premium-currency"> {{$currency}} </span> <span>  {{ trans('content.premiumsubscribe.permonth') }} </span>
                </h3>
                <div class="row account">
                    <div class="col-md-12 @if(Session::get('lang') == 'ar') text-right @else text-left @endif">
                        <h2 style="margin: 0 0 15px 0" data-i18n="account.subscribe_step_two.title">{{ trans('content.premiumactivation.title') }} </h2>
                        <p class="sub-text" data-i18n="account.subscribe_step_two.description_1">
                            {{ trans('content.premiumactivation.description_1') }} ({{ trans('content.premiumsummary.free') }}<span class="premium-price"> {{$amount}} </span> <span class="premium-currency"> {{$currency}} </span> <span data-i18n="premium.per">  {{ trans('content.premiumsubscribe.permonth') }} </span>)
                        </p>
                        <p class="sub-text subscribe_step_two">

                        </p>

                        <br>
                        <div class="provider_board">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group col-md-9" style="height: 40px; direction: ltr">
                                            <input id="PinCode" style="height: 40px; width:150px" name="pinCode" class="form-control" type="number">
                                            <input id="msisdn" value="{{$msisdn}}" class="form-control" type="hidden">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-dismissible reg_error" role="alert" style="display: none">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <span class="glyphicon glyphicon-info-sign"></span> <span class="message"></span>
                            </div>
                            <a href="#" class="btn subscribe_btn verify-btn"  data-i18n="account.subscribe_step_two.process_btn">{{ trans('content.premiumactivation.process_btn') }} </a>

                            {{--<a href="#" class="btn subscribe_btn resend-code" data-i18n="account.resend_btn" style="margin-right: 15px; margin-left: 15px">{{ trans('content.premiumactivation.resend_btn') }} </a>--}}

                            <a href="#" class="btn subscribe_btn subscribe-cancel"  data-i18n="account.cancel_btn"> {{ trans('content.premiumactivation.cancel_btn') }} </a>
                            <p>{{ trans('content.premiumsummary.free') }} <span class="premium-price"> {{$amount}} </span> <span class="premium-currency"> {{$currency}} </span> <span>  {{ trans('content.premiumsubscribe.permonth') }} </span></p>
                            <p class="sub-text" data-i18n="account.subscribe_step_one.description_0"><u>{{ trans('content.premiumsubscribe.description_0') }}</u></p>
                            <p class="sub-text" data-i18n="account.subscribe_step_one.description_0_0">- {{ trans('content.premiumsubscribe.description_0_0') }} </p>
                            <p class="sub-text" id="description_5" data-i18n="account.subscribe_step_one.description_5">- {!! trans('content.premiumsubscribe.description_5') !!} </p>
                            <p class="sub-text" data-i18n="account.subscribe_step_one.description_3">- {{ trans('content.premiumsubscribe.description_3') }} </p>
                            <p class="sub-text" data-i18n="account.subscribe_step_one.description_4">- {{ trans('content.premiumsubscribe.description_4') }} </p>
                            <p class="sub-text" data-i18n="account.subscribe_step_one.description_1">- {!! trans('content.premiumsubscribe.description_6') !!}</p>
                            <p class="sub-text" data-i18n="account.subscribe_step_one.description_1">- {!! trans('content.premiumsubscribe.description_1') !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="confirm" style="display:none">
                <div class="container" style="min-width:300px; padding: 5px; max-width:500px">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info-circle"></i> <span data-i18n="account.subscribe.cancellation.title">{{ trans('content.premiumsummary.cancel_big_btn') }}</span></h3>
                                <span class="clearfix"></span>
                            </div>
                            <div class="panel-body" data-i18n="account.subscribe.cancellation.message" style="color: black">
                                {{ trans('content.premiumsummary.cancelationmessage') }}
                            </div>
                            <div class="panel-footer">
                                <div class="row" style="padding: 10px;">
                                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="cancel_ok" data-i18n="account.subscribe.cancellation.yes">{{ trans('content.premiumsummary.yes') }}</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-warning" id="no_cancel" data-i18n="account.subscribe.cancellation.no">{{ trans('content.premiumsummary.no') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('include.inner_footer')

    <script type="/js/premium.js"></script>

    <script>
        basket.require(
            {url: '{{asset("/js/premium.js")}}', skipCache: true},
            {url: '{{asset("/js/main.js")}}', skipCache: true}
        ).then(function () {
            resend_pincode("{{$msisdn}}");
            subscribe_cancellation();
        });

        $(document).ready(function () {
            var shortCode = false;
            var provider = '{{$provider}}';
            var operatorCode = '{{$operatorCode}}';
            var shortCodeCMD = '';
            var lang = '{{Session::get('lang')}}';

            if(provider == 'Etisalat' && operatorCode == '971'){
                shortCode = '1151';
            }else if(provider == 'Du' && operatorCode == '971'){
                shortCode = '2884';
            }else if(provider == 'Ooredoo' && operatorCode == '974'){
                shortCode = '92823';
            }else if(provider == 'Ooredoo' && operatorCode == '965'){
                shortCode = '91825';
            }else if(provider == 'Viva' && operatorCode == '965'){
                shortCode = '50471';
            }else if(provider == 'Umniah' && operatorCode == '962'){
                shortCode = '91825';
            }else if(provider == 'Orange' && operatorCode == '962'){
                shortCode = '99222';
            }else if(provider == 'Viva' && operatorCode == '973'){
                shortCode = '98726';
            }else if(provider == 'Watanyia' && operatorCode == '97'){
                shortCode = '7825';
            }else if(provider == 'Vodafone' && operatorCode == '20'){
                shortCode = '6699';
            }else if(provider == 'Orange' && operatorCode == '20'){
                shortCode = '5030';
            }else if(provider == 'Zain' && operatorCode == '962'){
                shortCode = '97970';
            }else if(provider == 'Asia' && operatorCode == '964'){
                shortCode = '3760';
                shortCodeCMD = '05';
            }

            if(shortCodeCMD == ''){
                if(lang == 'ar'){
                    shortCodeCMD = 'الغاء';
                }else{
                    shortCodeCMD = 'cancel';
                }
            }

            if(shortCode > 0){
                $(document).find(".short-code").html(shortCode);
                $(".provider_board #description_5").show();
            }else{
                $(".provider_board #description_5").hide();
            }

            $(document).find(".short-code").html(shortCode);
            $(document).find(".short-code-cmd").html(shortCodeCMD);

            $(".premium-wrapper").backstretch("http://admin.mangomolo.com/analytics/uploads/71/football-league-bg5.jpg", {centeredX: true, centeredY: true, fade: true});
        });

    </script>
</div>
@endsection
<!-- MAIN CONTAINER [END] -->
