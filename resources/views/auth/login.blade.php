<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/13/2017
 * Time: 12:14 PM
 */
?>
@extends('layouts.master')
@section('title', 'Video on Demand - AWAAN Login')
@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title'=>"Video on Demand - AWAAN Login",
        'current_description'=>"Video on Demand - AWAAN Login",
    ])
@endsection
@section('main-content')
    <!-- LOGIN WRAPPER [START]	-->
    <div class="login-wrapper">
        <div class="container">

            <div class="section login-container">
                <div class="col-lg-5 col-md-7 col-sm-9 center-col login-box-col">
                    <h2 class="title">{{ trans('content.loginmodal.signin') }}</h2>
                    <form id="my-login-form" method="POST">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="alert alert-danger alert-cont login_error" style="display: none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p id="error-message">Alert body ...</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="display: none" for="usernameinput">username</label>
                                    <input name="username" id="usernameinput" type="text" class="form-control" placeholder="{{ trans('content.loginmodal.username') }}" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="display: none" for="passwordinput">password</label>
                                    <input name="password" id="passwordinput" type="password" class="form-control" placeholder="{{ trans('content.loginmodal.password') }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="checkbox">
                                    <label>
                                        <input name="remember_me" type="checkbox"> {{ trans('content.loginmodal.rememberpassword') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <button type="submit" class="btn btn-block btn-awaanbluebtn btn-login">{{ trans('content.loginmodal.signin') }}</button>
                            </div>
                        </div>
                           <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    </form>

                    <div class="seperator"></div>

                    <div class="col-md-6 center-col">
                        <a href="{{URL::to("auth/reset")}}?"><h3 class="subtitle">{{ trans('content.loginmodal.forgotpassword') }}</h3></a>
                            <a href="{{URL::to("auth/register")}}?" class="btn btn-block btn-awaanblueborderbtn btn-forgotpass">{{ trans('content.loginmodal.register') }}</a>
                    </div>
                    <div class="seperator"></div>
                    <div class="col-md-6 center-col">
                        <a href="#" class="btn btn-block btn-fblogin fb_login">{{ trans('content.register.signinfb') }} <i class="fa fa-facebook"></i></a>
                    </div>
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