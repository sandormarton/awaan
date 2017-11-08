<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/13/2017
 * Time: 12:14 PM
 */
?>
@extends('layouts.master')
@section('title', 'Video on Demand - Reset password')
@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title'=>"Video on Demand - Reset password",
        'current_description'=>"Video on Demand - Reset password",
    ])
@endsection
@section('main-content')
    <!-- LOGIN WRAPPER [START]	-->
    <div class="login-wrapper">
        <div class="container">

            <div class="section login-container">
                <div class="col-lg-5 col-md-7 col-sm-9 center-col login-box-col">
                    <h2 class="title">{{ trans('content.loginmodal.forgotpassword') }}</h2>
                    <form id="change_password" class="change_password">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="alert alert-danger alert-cont login_error" style="display: none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p id="error-message">{{ trans('content.forgotmodal.changed_failed') }}</p>
                                </div>
                                <div class="alert alert-danger alert-cont login_success" style="display: none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p id="error-message">{{ trans('content.forgotmodal.changed_success') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <input name="token_code" id="token_code" type="hidden" class="token_code" value="{{$token}}" placeholder="{{ trans('content.forgotmodal.email') }}" required />
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="display: none" for="password_reset">password</label>
                                    <input name="password" id="password_reset" type="password" class="form-control password_reset" placeholder="{{ trans('content.forgotmodal.newpass') }}" required />
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="display: none" for="password_reset_confirm">re password</label>
                                    <input name="password_confirm" id="password_reset_confirm" type="password" class="form-control password_reset_confirm" placeholder="{{ trans('content.forgotmodal.newpassconfirm') }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-block btn-awaanbluebtn btn-reset2">{{ trans('content.loginmodal.resetPass') }}</button>
                            </div>
                        </div>
                    </form>

                    <div class="seperator"></div>
                </div>
            </div>

        </div><!-- CONTAINER [END]	-->
    </div>
    <!-- LOGIN WRAPPER [END]	-->
@endsection

@section("additional_scripts")
    <script src="{{asset('/js/login.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready( function() {
            $("#my-login-form").submit(function(e) {
                $(".alert-cont").hide();
                $.ajax({
                    type: "POST",
                    url: "{{Request::url()}}",
                    data: $("#my-login-form").serialize(), // serializes the form's elements.
                    dataType: 'json',
                    success: function(data) {
                        if(data.hasOwnProperty("error")){
                            $("#error-message").text(data.error);
                            $(".alert-cont").show();
                        }else{
                            window.location.replace("{{URL::to("/")}}");
                        }
                    }
                });
                e.preventDefault(); // avoid to execute the actual submit of the form.
            });
        });
    </script>
@endsection