/**
 * Created by Hany on 4/22/2016.
 */
jQuery(document).ready(function($) {

    //checkGlobal();

    function statusChangeCallback(response) {
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if(response.status === 'connected') {
            // Logged into your app and Facebook.
            fbLogin();
        } else if(response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
        }
    }

    function checkLoginState() {
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    }

    function fbLogin() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me?fields=id,name,birthday,first_name,last_name,relationship_status,gender,email', function (response) {

            console.log(response);

            $.post('admin.mangomolo.com/analytics/index.php/plus/register', {
                username: response.first_name,
                firstname: response.first_name,
                lastname: response.last_name,
                email: $.isEmptyObject(response.email) ? response.id : response.email,
                //mobile:  ',
                gender: response.gender,
                birthday_full: response.birthday,
                user_id: 71,
                social_status: (typeof response.relationship_status != 'undefined') ? response.relationship_status : false,
                source: 'fb'
                        //country:  response,
                        //city:  response
            }, function (data) {

                console.log(data);

                if(data.error == 'exist') {
                    if(data.user.length != 0) {
                        //if(app.getAccessToken() == null){
                        //	app.session("user", data.user);
                        //	app.setAccessToken(token());
                        //}
                        $(document).find(".login_error").removeClass('alert-danger').addClass('alert-success');
                        $(document).find(".login_error").fadeIn().show();
                        $(document).find(".login_error").html('انت مسجل بالفعل , سيتم تسجيل الدخول');
                        $.when(sharedFunctions.requestAjax("POST", '/auth/login', {logged: 1, user: data.user[0]}, "seaons_episodes", "seaons_episodes", 1))
                                .done(function (refresh) {
                                    //$.cookie('user_token', data.user.id + ',' + data.user.email, { expires: 1, domain: 'dcndigital.ae' });
                                    //location.reload(true);
                                    window.location.replace("/");
                                }).fail(function () {
                            $(document).find(".login_error").fadeIn().show();
                            $(document).find(".login_error").html('لقد انتهت صلاحية الجلسة سوف يتم تحديث الصفحة');
                            location.reload(true);
                        });
                    } else {
                        $(document).find(".login_error").fadeIn().show();
                    }
                }

                if(typeof data.success != "undefined" && data.success == "yes" && data.error != 'exist') {
                    $(document).find(".login_error").slideUp();
                    $.when(sharedFunctions.requestAjax("POST", '/auth/login', {logged: 1, user: data.user[0]}, "seaons_episodes", "seaons_episodes", 1)).done(function (refresh) {
                        $(document).find(".login_error").removeClass('alert-danger').addClass('alert-success');
                        $(document).find(".login_error").fadeIn().show();
                        $(document).find(".login_error").html('تم تسجيل الدخول بنجاح');
                        //$.cookie('user_token', data.user.id + ',' + data.user.email, { expires: 1, domain: 'dcndigital.ae' });
                        location.reload(true);
                    }).fail(function () {
                        $(document).find(".login_error").fadeIn().show();
                        $(document).find(".login_error").html('لقد انتهت صلاحية الجلسة سوف يتم تحديث الصفحة');
                        location.reload(true);
                    });
                }

            }, "json");
        });
    }

    $(".fb_login").click(function (e) {
        //FB.init({
        //    appId      : '554876877966815',
        //    cookie     : true,  // enable cookies to allow the server to access
        //    xfbml      : true,  // parse social plugins on this page
        //    version    : 'v2.0' // use version 2.2
        //});
        FB.login(function (response) {
            if(response.authResponse)
            {
                checkLoginState();
            } else {
                console.log('Authorization failed.');
            }
        }, {scope: 'public_profile, user_birthday, user_friends, email, user_relationships'});
    });


    // $(".change_password").submit(function (e) {
    //
    //     e.preventDefault();
    //     // e.stopPropagation();
    //
    //     var password_reset = $(document).find('.password_reset').val();
    //     var password_confirm = $(document).find('.password_reset_confirm').val();
    //
    //     var token_code = $(document).find('.token_code').val();
    //
    //     if($.trim(password_reset) != $.trim(password_confirm)) {
    //         alert('Please Check Confirm Password');
    //         return false;
    //     }
    //     $.post('http://admin.mangomolo.com/analytics/index.php/plus/change_password',
    //             {user_id: 71, password: $.trim(password_reset), token: token_code}, function (content) {
    //
    //         if(content != '' && !$.isEmptyObject(content)) {
    //             $(".reset_success").fadeIn().show();
    //             setTimeout(function () {
    //                 $('#passwordChangeModal').modal('hide');
    //                 location.replace('/');
    //             }, 3000);
    //
    //         } else {
    //             $(".reset_error ").fadeIn().show();
    //
    //             //alert('your token has expired please submit another forgot password request!');
    //         }
    //
    //     }, "json");
    //
    // });

    $(".reset_password").submit(function (e) {

        e.preventDefault();
        // e.stopPropagation();

        $.post('admin.mangomolo.com/analytics/index.php/plus/reset_password',
                {user_id: 71, email: $(document).find(".reset_email").val()}
        , function (content) {

            if(content.length != 0 && !$.isEmptyObject(content.email)) {

                // $.post('http://beta.awaandev.mangomolo.com/reset', {email: content.email, hash: content.hash}, function (data) {
                $.post('awaan.ae/reset', {email: content.email, hash: content.hash}, function (data) {
                    console.log('ok');
                    $(".login_success").show();
                }, "json");
                /*the message added here bcauze mydcn/token return no response */
                $(".login_success").show();
                setTimeout(function () {
                    $(".login_success").fadeOut();
                    // $('#passwordModal').modal('hide');
                }, 3000);
            } else {
                $(".login_error").fadeIn().show();
                setTimeout(function () {
                    $(".login_error").fadeOut();
                }, 3000);
            }

        }, "json");
    });

    $(".change_password").submit(function (e) {

        e.preventDefault();
        // e.stopPropagation();
        var password_reset = $(document).find('.password_reset').val();
        var password_confirm = $(document).find('.password_reset_confirm').val();
        var token_code = $(document).find('.token_code').val();
        if($.trim(password_reset) != $.trim(password_confirm)) {
            alert('Please Check Confirm Password');
            return false;
        }
        $.post('admin.octivid.com/analytics/index.php/plus/change_password',
            {user_id: 71, password: $.trim(password_reset), token: token_code}, function (content) {
                //  console.log(content);
                // alert('Password Changed');
                if(content != '' && !$.isEmptyObject(content)) {
                    // $(".reset_success").fadeIn().show();
                    $(".login_success").fadeIn().show();
                    setTimeout(function () {
                        // $('#passwordChangeModal').modal('hide');
                        // location.replace('/');
                    }, 3000);

                } else {
                    $(".login_error").fadeIn().show();
                    alert('somthing went wrong');
                    //alert('your token has expired please submit another forgot password request!');
                }

            }, "json");

    });

    /**
     * Login
     */
    $(".login_form").submit(function (e) {

        e.preventDefault();
        e.stopPropagation();

        $.post('admin.mangomolo.com/analytics/index.php/plus/login', {user_id: 71, email: $(".login_form input[name=email]").val(), password: $("input[name=password]").val()})
                .done(function (content) {

                    content = $.parseJSON(content);

                    if(content.length > 0) {
                        if(content[0].id != false) {
                            $(document).find(".login_error").slideUp();

                            $.when(sharedFunctions.requestAjax("POST", '/auth/login', {logged: 1, user: content[0]}, "seaons_episodes", "seaons_episodes", 1)).done(function (refresh) {

                                $(document).find(".login_error").removeClass('alert-danger').addClass('alert-success');
                                $(document).find(".login_error").fadeIn().show();
                                $(document).find(".login_error").html('تم تسجيل الدخول بنجاح');

                                $.cookie('user_token', content[0].id + ',' + content[0].email, {expires: 1, domain: 'dcndigital.ae'});
                                location.reload(true);
                            }).fail(function () {
                                $(document).find(".login_error").fadeIn().show();
                                $(document).find(".login_error").html('لقد انتهت صلاحية الجلسة سوف يتم تحديث الصفحة');
                                location.reload(true);
                            });

                        }
                    } else {
                        $(document).find(".login_error").fadeIn().show();
                    }
                    //$.cookie('user_token', content[0].id + ',' + content[0].email, { expires: 1, domain: 'dcndigital.ae' });

                }, 'json');
    });

    var currYear = new Date().getFullYear(), option, i;
    for(i = 1900; i < currYear; i += 1) {
        option = $(document.createElement('option')).val(i).text(i);
        option.prop('selected', i === currYear - 1);
        $(document).find('#birth_year').append(option);
    }

    var randomNr1 = 0;
    var randomNr2 = 0;
    var totalNr = 0;
    var input = $('.register_form').find('#ebcaptchainput');
    var label = $('.register_form').find('#ebcaptchatext');

    randomNr1 = Math.floor(Math.random() * 10);
    randomNr2 = Math.floor(Math.random() * 10);
    totalNr = randomNr1 + randomNr2;

    var texti = randomNr1 + " + " + randomNr2;
    $(input).attr('placeholder', texti + ' = ?');

    $(input).keyup(function () {
        var nr = $(this).val();
        if(nr != totalNr)
        {
            $(this).empty();
            $(".reg_error .message").html("التحقق الأمني خاطىء");
            $(".reg_error").addClass("alert-danger").fadeIn().show();
            $(".register-submit").find('.loading').remove();
            return false;
        } else {
            $(".reg_error").hide();
        }
    });


    /**
     * Register
     */
    $(".register_form").submit(function (e) {

        e.preventDefault();
        e.stopPropagation();

        $(".register-submit").append("<div style='height: 50px; width:100%' class='loading'></div>");

        if($(".reg_error").is(":visible")) {
            $(".reg_error .message").html("خطأ في التسجيل يرجى التحقق من الحقول المطلوبة");
            $(".reg_error").addClass("alert-danger").fadeIn().show();
            $(".register-submit").find('.loading').remove();
            return false;
        }

        $.post('admin.mangomolo.com/analytics/index.php/plus/register', $('input[name!=ebcaptchainput]', '.register_form').serialize(), function (data) {

            if(typeof data.error != "undefined" && data.error == 'exist') {
                $(".reg_error .message").html("البريد الإلكتروني مستخدم بالفعل، يرجى استخدام بريد إلكتروني مختلف");
                $(".reg_error").addClass("alert-danger").fadeIn().show();
                $(".register-submit").find('.loading').remove();
                return false;
            }

            if(typeof data.success != "undefined" && data.success == "yes") {
                $(".register_form").slideUp();
                $(".reg_error .message").html("قد تم التسجيل بنجاح!");
                $(".reg_error").removeClass("alert-danger").addClass("alert-success").fadeIn().show();
                $(".register-submit").find('.loading').remove();
            }

        }, "json");

    });

    var checkGlobal = function () {
        $.cookie.raw = true;
        var user_token = $.cookie('user_token', unescape);
        if(typeof user_token !== 'undefined') {
            var user_list = user_token.split(',');
            if(!$.isEmptyObject(user_list[1])) {
                $.post(site_protocol + '/analytics/index.php/plus/external_login', {user_id: 71, email_id: $.base64('encode', user_list[1])})
                        .done(function (content) {
                            app.session("user", content);
                            app.session("oauth.token", token());
                        }, 'json');
            }
        } else {
            try {
                var user = app.session("user")[0];
                if(user != null) {
                    logged = null;
                    //user = null;
                    app.session("user", null);
                    app.session("premium", null);
                    app.session("oauth.token", null);

                    $.cookie('user_token', null, {domain: 'dcndigital.ae'});
                    $.removeCookie('user_token', {path: '/', domain: 'dcndigital.ae'});
                }
            } catch(e) {
//
            }
        }
    };

});
