<?php
/*
 * Copyright © 2016 DOTCOM Offshore, All Rights Reserved
 *
 * [This is the page ID ]
 * $id: login_modal.php
 * Created:        @wissamsabbagh    Apr 17, 2016 | 12:40:39 AM
 * Last Update:    @wissamsabbagh    Apr 17, 2016 | 12:40:39 AM
 */
?>
<div class="modal awaan-user-section-modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="ion-close-round"></i><span class="hidden">Close</span></span></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-10 col-md-10 col-sm-11 col-xs-12 login-wrapper">
                    <div class="site-logo" style="text-align: center">
                        <a href="#">
                            @if(ends_with(Route::currentRouteAction(), 'Premium@index'))
                                <img src="/images/awaan-gold-pop-up.png" alt="Login to AWAAN" class="img-responsive center-block" />
                            @else
                                <img src="/images/logo.png" alt="Login to AWAAN" class="img-responsive center-block" />
                            @endif
                        </a>
                    </div>
                    <h2 class="popup-title"><span style="color: #FFF !important;">{{ trans('content.loginmodal.signin') }}</span></h2>
                    <div class="form-wrapper">
                        <div class="alert alert-danger alert-dismissible login_error" role="alert" style="display: none">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            <span data-i18n="login.invalid">{{ trans('content.loginmodal.invalid') }}</span>
                        </div>
                        <form class="login_form">
                            <div class="form-group">
                                <label for="emailInput" style="display: none;">{{ trans('content.loginmodal.username') }}</label>
                                <input id="emailInput" type="text" class="form-control user_name" name="email" title="{{ trans('content.loginmodal.username') }}" placeholder="{{ trans('content.loginmodal.username') }}" />
                            </div>
                            <div class="form-group">
                                <label for="passwordInput" style="display: none;">{{ trans('content.loginmodal.password') }}</label>
                                <input id="passwordInput" type="password" class="form-control user_pass" name="password" title="{{ trans('content.loginmodal.password') }}" placeholder="{{ trans('content.loginmodal.password') }}" />
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" title="{{ trans('content.loginmodal.rememberpassword') }}"> {{ trans('content.loginmodal.rememberpassword') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="checkbox">
                                        <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#passwordModal">{{ trans('content.loginmodal.forgotpassword') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-block btn-green">{{ trans('content.loginmodal.signin') }}</button>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <a href="#" class="btn btn-block btn-grey" 
                                           data-dismiss="modal" data-toggle="modal" data-target="#registerModal">{{ trans('content.loginmodal.register') }}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="extra-links">
                                    <a href="#" class="btn btn-block btn-facebook fb_login"><i class="ion-social-facebook">
                                
                                </i> {{ trans('content.loginmodal.signinfb') }}</a>
<!--                            <a href="#" class="btn btn-block btn-twitter"><i class="ion-social-twitter"></i> الدخول عبر تويتر</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>


<div class="modal awaan-user-section-modal fade" id="passwordModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="ion-close-round"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-10 col-md-10 col-sm-11 col-xs-12 login-wrapper">
                    <div class="site-logo">
                        <a href="#"><img src="/images/logo.png" alt="AWAAN" class="img-responsive center-block" /></a>
                    </div>
                    <h2 class="popup-title">{{ trans('content.forgotmodal.title') }}</h2>
                    <div class="form-wrapper">
                        <div class="alert alert-success alert-dismissible reset_success" role="alert" style="display: none">
                            <span class="glyphicon glyphicon-info-sign"></span><span> {{ trans('content.forgotmodal.success') }}</span>
                        </div>
                        <div class="alert alert-danger alert-dismissible reset_error" role="alert" style="display: none">
                            <span class="glyphicon glyphicon-info-sign"></span><span> {{ trans('content.forgotmodal.failed') }}</span>
                        </div>
                        <form class="reset_password">
                            <div class="form-group">
                                <label for="inputreset_email" style="display: none;">{{ trans('content.forgotmodal.email') }}</label>
                                <input id="inputreset_email" type="text" class="form-control reset_email" name="email" placeholder="{{ trans('content.forgotmodal.email') }}" />
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-block btn-green">{{ trans('content.forgotmodal.send') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($_GET['token']))
<div class="modal awaan-user-section-modal fade" id="passwordChangeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="ion-close-round"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-10 col-md-10 col-sm-11 col-xs-12 login-wrapper">
                    <div class="site-logo">
                        <a href="#"><img src="/images/logo.png" alt="AWAAN" class="img-responsive center-block" />
                        </a>
                    </div>
                    <h2 class="popup-title">{{ trans('content.forgotmodal.newtitle') }}</h2>
                    <div class="form-wrapper">
                        <div class="alert alert-success alert-dismissible reset_success" role="alert" style="display: none">
                            <span class="glyphicon glyphicon-info-sign"></span><span> {{ trans('content.forgotmodal.changed_success') }}</span>
                        </div>

                        <div class="alert alert-danger alert-dismissible reset_error" role="alert" style="display: none">
                            <span class="glyphicon glyphicon-info-sign"></span><span> {{ trans('content.forgotmodal.changed_failed') }}</span>
                        </div>
                        <form class="change_password">
                            <div class="form-group">
                                <label for="inputpassword_reset" style="display: none;"></label>
                                <input id="inputpassword_reset" type="text" class="form-control password_reset" name="password" placeholder="{{ trans('content.forgotmodal.newpass') }}" />
                            </div>
                            <div class="form-group">
                                <label for="inputpassword_reset_confirm" style="display: none;"></label>
                                <input id="inputpassword_reset_confirm" type="text" class="form-control password_reset_confirm" name="password_confirm" placeholder="{{ trans('content.forgotmodal.newpassconfirm') }}" />
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <input type="hidden" class="token_code" name="token_code" value="{{$_GET['token']}}">
                                        <button type="submit" class="btn btn-block btn-green">{{ trans('content.forgotmodal.newpassbtn') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif