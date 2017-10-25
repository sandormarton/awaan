@extends('layouts.master_inner')
@section('title', trans('content.pagetitle.premium.premium'))

<!--This defines a home  section which gets displayed via "yield" -->

@section('subscribe')
<!-- MAIN CONTAINER [START] -->
@include('show_innerright',['categories'=>$categories])


<div class="innerpage-leftbar">

    <div class="mobile-menu visible-xs">
    	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" title="AWAAN" alt="AWAAN" /></a>
        <button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
    </div>

    <div class="premium-wrapper drama-list-wrapper" style="height: 100vh; min-height: 100%">
        <div class="account-list-container">
            <div class="row account">
                <div class="col-md-3 hidden-xs hidden-sm">
                    <h4 class="premium-fees" style="display: none">
                        {{ trans('content.premiumsummary.free') }} <br><span class="premium-price"> 30 </span> <span class="premium-currency"> AED </span> <span data-i18n="premium.per">  {{ trans('content.premiumsubscribe.permonth') }} </span></h4>
                </div>
                <div class="col-md-9 ">
                    <h2 style="margin: 0 0 15px 0" data-i18n="account.subscribe_step_one.title">{{ trans('content.premiumsubscribe.title') }}</h2>

                    <p style="font-size: 16pt" data-i18n="account.subscribe_step_one.country_title"> {{ trans('content.premiumsubscribe.country_title') }}</p>

                    <ul class="nav nav-justified subscribe_nav">

                        <li><a data-toggle="tooltip" data-placement="top" title="UAE" style="background: transparent;" href="#" class="setOperator" data-currency="AED" data-currencytext="18" data-operatorcode="971" data-provider="Etisalat,Du" data-logo="/images/gateways/ae.png">
                                <img class="img-rounded" src="/images/gateways/ae.png"></a></li>

                        <li><a data-toggle="tooltip" data-placement="top" title="KSA" style="background: transparent;" href="#" class="setOperator" data-currency="SAR" data-currencytext="18" data-operatorcode="966" data-provider="Zain,Mobily,STC" data-logo="/images/gateways/sa.png">
                                <img class="img-rounded" src="/images/gateways/sa.png"></a></li>

                        <li><a  data-toggle="tooltip" data-placement="top" title="Egypt" style="background: transparent;" href="#" class="setOperator" data-currency="EGP" data-currencytext="45" data-operatorcode="20" data-provider="Vodafone,Orange" data-logo="/images/gateways/eg.png">
                                <img class="img-rounded" src="/images/gateways/eg.png"></a></li>

                            <li><a data-toggle="tooltip" data-placement="top" title="Palestine" style="background: transparent;" href="#" class="setOperator" data-currency="ILS" data-currencytext="18" data-operatorcode="97" data-provider="Jawwal,Watanyia" data-logo="/images/gateways/ep.png">
                                <img class="img-rounded" src="/images/gateways/ep.png"></a></li>


                        <li><a data-toggle="tooltip" data-placement="top" title="Jordan" style="background: transparent;" href="#" class="setOperator" data-currency="JOD" data-currencytext="3.4" data-operatorcode="962" data-provider="Zain,Orange,Umniah" data-logo="/images/gateways/jo.png">
                                <img class="img-rounded" src="/images/gateways/jo.png"></a></li>


                        <li><a data-toggle="tooltip" data-placement="top" title="Qatar" style="background: transparent;" href="#" class="setOperator" data-currency="QAR" data-currencytext="18" data-operatorcode="974" data-provider="Ooredoo" data-logo="/images/gateways/qa.png">
                                <img class="img-rounded" src="/images/gateways/qa.png"></a></li>


                        <li><a data-toggle="tooltip" data-placement="top" title="Kuwait" style="background: transparent;" href="#" class="setOperator" data-currency="KWD" data-currencytext="1.5" data-operatorcode="965" data-provider="Viva,Ooredoo" data-logo="/images/gateways/kw.png">
                                <img class="img-rounded" src="/images/gateways/kw.png"></a></li>


                        <li><a data-toggle="tooltip" data-placement="top" title="Bahrain" style="background: transparent;" href="#" class="setOperator" data-currency="BHD" data-currencytext="1.85" data-operatorcode="973" data-provider="Viva,Zain" data-logo="/images/gateways/bh.png">
                                <img class="img-rounded" src="/images/gateways/bh.png"></a></li>

                        <li><a data-toggle="tooltip" data-placement="top" title="Iraq" style="background: transparent;" href="#" class="setOperator" data-currency="IQD" data-currencytext="7800" data-operatorcode="964" data-provider="Zain,Asia" data-logo="/images/gateways/iraq.png">
                                <img class="img-rounded" src="/images/gateways/iraq.png"></a></li>

                        <li><a data-toggle="tooltip" data-placement="top" title="Tunisia" style="background: transparent;" href="#" class="setOperator" data-currency="TND" data-currencytext="11" data-operatorcode="216" data-provider="Orange" data-logo="images/gateways/tn.png">
                                <img class="img-rounded" src="/images/gateways/tn.png"></a></li>

                        <li><a data-toggle="tooltip" data-placement="top" title="Morocco" style="background: transparent;" href="#" class="setOperator" data-currency="MAD" data-currencytext="48.85" data-operatorcode="212" data-provider="Orange" data-logo="images/gateways/ma.png">
                                <img class="img-rounded" src="/images/gateways/ma.png"></a></li>
                    </ul>

                    <div id="operators_area" style="display: none">

                        <p style="font-size: 16pt" data-i18n="account.subscribe_step_one.sub_title">{{ trans('content.premiumsubscribe.sub_title') }}</p>
                        <ul class="nav nav-justified subscribe_nav">
                        </ul>
                    </div>
                    <br>
                    <div class="provider_board" style="display: none">
                        <h2 data-i18n="account.subscribe_step_one.provider_title">{{ trans('content.premiumsubscribe.provider_title') }}</h2>
                        <div class="row">

                            <div class="col-md-9 col-lg-7">
                                <div class="form-group">
                                    <label class="col-md-3 col-lg-2" for="customerNumber"><img class="img-responsive" style="height: 40px" id="provider_logo" src="/images/gateways/Mobily.png"></label>
                                    <div class="input-group col-md-9 col-lg-8" style="height: 40px; direction: ltr">
                                        <span class="input-group-addon" style="direction: ltr; font-size: 18pt; font-weight: bold">
                                            <input style="max-width: 60px; background: 0; border: 0" type="text" readonly="readonly" name="countryCode" value="9665" id="countryCode">
                                        </span>
                                        <input id="customerNumber" style="height: 40px" name="customerNumber" class="form-control" type="text">
                                        <input id="provider_name" type="hidden" value="">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="alert alert-dismissible reg_error" role="alert" style="display: none">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span class="glyphicon glyphicon-info-sign"></span> <span class="message"></span>
                        </div>
                        <p class="sub-text" data-i18n="account.subscribe_step_one.description_2">{{ trans('content.premiumsubscribe.description_2') }} </p><br>

                        <p class="sub-text" data-i18n="account.subscribe_step_one.description_0"><u>{{ trans('content.premiumsubscribe.description_0') }}</u></p>
                        <p class="sub-text" data-i18n="account.subscribe_step_one.description_0_0">- {{ trans('content.premiumsubscribe.description_0_0') }} </p>
                        <p class="sub-text" id="description_5" data-i18n="account.subscribe_step_one.description_5">- {!! trans('content.premiumsubscribe.description_5') !!} </p>
                        <p class="sub-text" data-i18n="account.subscribe_step_one.description_3">- {{ trans('content.premiumsubscribe.description_3') }} </p>
                        <p class="sub-text" data-i18n="account.subscribe_step_one.description_4">- {{ trans('content.premiumsubscribe.description_4') }} </p>
                        <p class="sub-text" data-i18n="account.subscribe_step_one.description_1">- {!! trans('content.premiumsubscribe.description_6') !!}</p>
                        <p class="sub-text" data-i18n="account.subscribe_step_one.description_1">- {!! trans('content.premiumsubscribe.description_1') !!}</p>
                        <a href="#" class="btn subscribe_btn subscribe_process" data-i18n="account.subscribe_step_one.process_btn">{{ trans('content.premiumsubscribe.process_btn') }}</a>
                        <a href="#" class="btn btn-warning subscribe_exit" data-i18n="account.subscribe_step_one.cancel_btn">{{ trans('content.premiumsubscribe.cancel_btn') }}</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('include.inner_footer')

    <script>
        $(".premium-wrapper").backstretch("http://admin.mangomolo.com/analytics/uploads/71/football-league-bg5.jpg", {centeredX: true, centeredY: true, fade: true});

    </script>
</div>
@endsection
<!-- MAIN CONTAINER [END] -->
