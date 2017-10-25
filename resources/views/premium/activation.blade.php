@extends('layouts.master_inner')
@section('title', trans('content.pagetitle.premium.activation'))

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
        <div class="account-all-page-container">

            <div class="col-md-12 account-list-container">
                <h3 class="title-container"><span data-i18n="account.subscribe_step_two.header"></span></h3>
                <div class="row account">
                    <div class="col-md-3">
                        <img src="/images/dmi_premium.jpg" class="img-responsive" >
                    </div>
                    <div class="col-md-9 text-right">
                        <h2 style="margin: 0 0 15px 0" data-i18n="account.subscribe_step_two.title">{{ trans('content.premiumactivation.title') }} </h2>
                        <p class="sub-text" data-i18n="account.subscribe_step_two.description_1">
                            {{ trans('content.premiumactivation.description_1') }}
                        </p>
                        <p class="sub-text subscribe_step_two">

                        </p>

                        <br>
                        <div class="provider_board">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group col-md-9" style="height: 40px; direction: ltr">
                                            <input id="PinCode" style="height: 40px; width:150px" name="pinCode" class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-dismissible reg_error" role="alert" style="display: none">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <span class="glyphicon glyphicon-info-sign"></span> <span class="message"></span>
                            </div>
                            <a href="#" class="btn subscribe_btn subscribe-btn"  data-i18n="account.subscribe_step_two.process_btn">{{ trans('content.premiumactivation.process_btn') }} </a>

                            <a href="#" class="btn subscribe_btn resend-code" data-i18n="account.resend_btn" style="margin-right: 15px; margin-left: 15px">{{ trans('content.premiumactivation.resend_btn') }} </a>
                                <a href="#" class="btn subscribe_btn subscribe-cancel"  data-i18n="account.cancel_btn"> {{ trans('content.premiumactivation.cancel_btn') }} </a>

                        </div>
                    </div>
                </div>
            </div>

            <div id="confirm" style="display:none">
                <div class="container" style="min-width:300px; padding: 5px; max-width:500px">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info-circle"></i> <span data-i18n="account.subscribe.cancellation.title">Subscription Cancellation</span></h3>
                                <span class="clearfix"></span>
                            </div>
                            <div class="panel-body" data-i18n="account.subscribe.cancellation.message" style="color: black">
                                Are you sure you want to start over the subscription process?
                            </div>
                            <div class="panel-footer">
                                <div class="row" style="padding: 10px;">
                                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="cancel_ok" data-i18n="account.subscribe.cancellation.yes">Yes I'm Sure</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-warning" id="no_cancel" data-i18n="account.subscribe.cancellation.no">Undo</button>
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
        $(document).ready(function () {
            $(".premium-wrapper").backstretch("http://admin.mangomolo.com/analytics/uploads/71/football-league-bg4.jpg", {centeredX: true, centeredY: true, fade: true});

            resend_pincode("{{$msisdn}}");
            subscribe_cancellation(); //
            //sdfsdfsdf
        });

    </script>
</div>
@endsection
<!-- MAIN CONTAINER [END] -->
