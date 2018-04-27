@extends('layouts.master_inner')
@section('title', trans('competition.title'))
<!--This defines a home  section which gets displayed via "yield" -->

@section('allshows')
@include('show_innerright',['categories'=> $categories])

<div class="innerpage-leftbar">

    <!--<a class="leaderboard-collapse-btn" role="button" data-toggle="collapse" href="#leaderboardCollapse" aria-expanded="false" aria-controls="leaderboardCollapse">[x] Close Advertisement</a>
    <div id="leaderboardCollapse" class="collapse in leaderboard-wrapper">
        <img src="images/leaderboard-ad.jpg" class="img-responsive center-block" />\
    </div>-->

    <div class="mobile-menu visible-xs">
    	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" title="AWAAN" alt="AWAAN" /></a>
        <button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
    </div>

    <div class="gitext_competition-wrapper">

        <div class="col-lg-9 col-md-12 gitext_competition-container">

            <div class="row gitext_competition-top-div">
                <div class="col-md-5">
                    <div class="gitex-logo-div">
                        <img src="{{URL::to("images/gitex/gitex-logo.png")}}" class="img-responsive center-block" />
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row trophy-div">
                        <div class="col-md-4 col-sm-4">
                            <div class="gitex-trophy-img">
                                <img src="{{URL::to("images/gitex/icon-blue-trophy.png")}}" class="img-responsive center-block" />
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="trophy-description">
                                {{ trans('competition.trophy_description') }}‎
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gitext_competition-bottom-div">
                <div class="col-md-5">
                    <div class="competition-data">

                        <div class="competition-date-div">
                            <h2>{{ trans('competition.title') }}‎</h2>
                            <h4>
                                {{date("d . m . Y")}}
                            </h4>
                        </div>

                        <div class="competition-quotes">
                            <h4>{{ trans('competition.subscribe1') }}‎</h4>
                            <h3>{{ trans('competition.subscribe2') }} </h3>
                            <h2>{{ trans('competition.subscribe3') }}</h2>
                        </div>

                        <div class="app-div">
                            <p>{{ trans('competition.app_download') }}</p>
                            <br/>
                            <p>
                                <a href="https://play.google.com/store/apps/details?id=com.dotcomlb.dcn&hl=en" title="Google Play" target="_blank"  rel="noopener noreferrer"><img src="{{URL::to("images/gitex/icon-google-play.png")}}" class="img-responsivecenter-block" /></a>
                            </p>
                            <p>
                                <a href="https://itunes.apple.com/lb/app/awaan/id641607453?mt=8" title="Apple App Store" target="_blank"  rel="noopener noreferrer"><img src="{{URL::to("images/gitex/icon-apple-store.png")}}" class="img-responsivecenter-block" /></a>
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-md-7">
                    <div class="competition-form-div">
                        <div class="alert alert-success alert-dismissible reset_success" role="alert" style="display: none">
                            <span class="glyphicon glyphicon-info-sign"></span>&nbsp;<span class="success_message"> تم الاشتراك</span>
                        </div>

                        <div class="alert alert-danger alert-dismissible reset_error" role="alert" style="display: none">
                            <span class="glyphicon glyphicon-info-sign"></span>&nbsp;<span class="error_message"> جميع الحقول مطلوبة</span>
                        </div>

                        <form id="competition-form" method="POST" data-toggle="validator" class="competition-form">
                            <div class="form-group has-feedback">
                                <label for="name">{{ trans('competition.form.full_name') }}</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="email">{{ trans('competition.form.email') }}</label>
                                <input type="email" class="form-control" pattern="([a-zA-Z0-9_.]{1,})((@[a-zA-Z]{2,})[\\\.]([a-zA-Z]{2}|[a-zA-Z]{3}))"  id="email" name="email" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="mobile">{{ trans('competition.form.mobile_number') }} <span><strong>{{ trans('competition.form.mobile_label') }}  </strong>{{ trans('competition.form.mobile_note') }}</span></label>
                                <input type="number" min="11" class="form-control" id="mobile" name="mobile_number" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="country">{{ trans('competition.form.country') }}</label>
                                <select class="form-control" name="country" id="country" required>
                                    <option value="" readonly="true">{{ trans('competition.form.country') }}</option>
                                    <option value="AF">Afghanistan</option> <option value="AL">Albania</option> <option value="DZ">Algeria</option> <option value="AS">American Samoa</option> <option value="AD">Andorra</option> <option value="AO">Angola</option> <option value="AI">Anguilla</option> <option value="AQ">Antarctica</option> <option value="AG">Antigua and Barbuda</option> <option value="AR">Argentina</option> <option value="AM">Armenia</option> <option value="AW">Aruba</option> <option value="AU">Australia</option> <option value="AT">Austria</option> <option value="AZ">Azerbaijan</option> <option value="BS">Bahamas</option> <option value="BH">Bahrain</option> <option value="BD">Bangladesh</option> <option value="BB">Barbados</option> <option value="BY">Belarus</option> <option value="BE">Belgium</option> <option value="BZ">Belize</option> <option value="BJ">Benin</option> <option value="BM">Bermuda</option> <option value="BT">Bhutan</option> <option value="BO">Bolivia</option> <option value="BA">Bosnia and Herzegovina</option> <option value="BW">Botswana</option> <option value="BV">Bouvet Island</option> <option value="BR">Brazil</option> <option value="IO">British Indian Ocean Territory</option> <option value="BN">Brunei Darussalam</option> <option value="BG">Bulgaria</option> <option value="BF">Burkina Faso</option> <option value="BI">Burundi</option> <option value="KH">Cambodia</option> <option value="CM">Cameroon</option> <option value="CA">Canada</option> <option value="CV">Cape Verde</option> <option value="KY">Cayman Islands</option> <option value="CF">Central African Republic</option> <option value="TD">Chad</option> <option value="CL">Chile</option> <option value="CN">China</option> <option value="CX">Christmas Island</option> <option value="CC">Cocos (Keeling) Islands</option> <option value="CO">Colombia</option> <option value="KM">Comoros</option> <option value="CG">Congo</option> <option value="CD">Congo, the Democratic Republic of the</option> <option value="CK">Cook Islands</option> <option value="CR">Costa Rica</option> <option value="CI">Cote d'Ivoire</option> <option value="HR">Croatia</option> <option value="CU">Cuba</option> <option value="CY">Cyprus</option> <option value="CZ">Czech Republic</option> <option value="DK">Denmark</option> <option value="DJ">Djibouti</option> <option value="DM">Dominica</option> <option value="DO">Dominican Republic</option> <option value="TL">Timor-Leste</option> <option value="EC">Ecuador</option> <option value="EG">Egypt</option> <option value="SV">El Salvador</option> <option value="GQ">Equatorial Guinea</option> <option value="ER">Eritrea</option> <option value="EE">Estonia</option> <option value="ET">Ethiopia</option> <option value="FK">Falkland Islands (Malvinas)</option> <option value="FO">Faroe Islands</option> <option value="FJ">Fiji</option> <option value="FI">Finland</option> <option value="FR">France</option> <option value="AX">Aland Islands</option> <option value="GF">French Guiana</option> <option value="PF">French Polynesia</option> <option value="TF">French Southern Territories</option> <option value="GA">Gabon</option> <option value="GM">Gambia</option> <option value="GE">Georgia</option> <option value="DE">Germany</option> <option value="GH">Ghana</option> <option value="GI">Gibraltar</option> <option value="GR">Greece</option> <option value="GL">Greenland</option> <option value="GD">Grenada</option> <option value="GP">Guadeloupe</option> <option value="GU">Guam</option> <option value="GT">Guatemala</option> <option value="GN">Guinea</option> <option value="GW">Guinea-Bissau</option> <option value="GY">Guyana</option> <option value="HT">Haiti</option> <option value="HM">Heard Island and McDonald Islands</option> <option value="VA">Holy See (Vatican City State)</option> <option value="HN">Honduras</option> <option value="HK">Hong Kong</option> <option value="HU">Hungary</option> <option value="IS">Iceland</option> <option value="IN">India</option> <option value="ID">Indonesia</option> <option value="IR">Iran, Islamic Republic of</option> <option value="IQ">Iraq</option> <option value="IE">Ireland</option> <option value="IT">Italy</option> <option value="JM">Jamaica</option> <option value="JP">Japan</option> <option value="JO">Jordan</option> <option value="KZ">Kazakhstan</option> <option value="KE">Kenya</option> <option value="KI">Kiribati</option> <option value="KP">Korea, Democratic People's Republic of</option> <option value="KR">Korea, Republic of</option> <option value="KW">Kuwait</option> <option value="KG">Kyrgyzstan</option> <option value="LA">Lao People's Democratic Republic</option> <option value="LV">Latvia</option> <option value="LB">Lebanon</option> <option value="LS">Lesotho</option> <option value="LR">Liberia</option> <option value="LY">Libyan Arab Jamahiriya</option> <option value="LI">Liechtenstein</option> <option value="LT">Lithuania</option> <option value="LU">Luxembourg</option> <option value="MO">Macao</option> <option value="MK">Macedonia</option> <option value="MG">Madagascar</option> <option value="MW">Malawi</option> <option value="MY">Malaysia</option> <option value="MV">Maldives</option> <option value="ML">Mali</option> <option value="MT">Malta</option> <option value="MH">Marshall Islands</option> <option value="MQ">Martinique</option> <option value="MR">Mauritania</option> <option value="MU">Mauritius</option> <option value="YT">Mayotte</option> <option value="MX">Mexico</option> <option value="FM">Micronesia, Federated States of</option> <option value="MD">Moldova, Republic of</option> <option value="MC">Monaco</option> <option value="MN">Mongolia</option> <option value="MS">Montserrat</option> <option value="MA">Morocco</option> <option value="MZ">Mozambique</option> <option value="MM">Myanmar</option> <option value="NA">Namibia</option> <option value="NR">Nauru</option> <option value="NP">Nepal</option> <option value="NL">Netherlands</option> <option value="AN">Netherlands Antilles</option> <option value="NC">New Caledonia</option> <option value="NZ">New Zealand</option> <option value="NI">Nicaragua</option> <option value="NE">Niger</option> <option value="NG">Nigeria</option> <option value="NU">Niue</option> <option value="NF">Norfolk Island</option> <option value="MP">Northern Mariana Islands</option> <option value="NO">Norway</option> <option value="OM">Oman</option> <option value="PK">Pakistan</option> <option value="PW">Palau</option> <option value="PA">Panama</option> <option value="PG">Papua New Guinea</option> <option value="PY">Paraguay</option> <option value="PE">Peru</option> <option value="PH">Philippines</option> <option value="PN">Pitcairn</option> <option value="PL">Poland</option> <option value="PT">Portugal</option> <option value="PR">Puerto Rico</option> <option value="QA">Qatar</option> <option value="RE">Reunion</option> <option value="RO">Romania</option> <option value="RU">Russian Federation</option> <option value="RW">Rwanda</option> <option value="KN">Saint Kitts and Nevis</option> <option value="LC">Saint LUCIA</option> <option value="VC">Saint Vincent and the Grenadines</option> <option value="WS">Samoa</option> <option value="SM">San Marino</option> <option value="ST">Sao Tome and Principe</option> <option value="SA">Saudi Arabia</option> <option value="SN">Senegal</option> <option value="SC">Seychelles</option> <option value="SL">Sierra Leone</option> <option value="SG">Singapore</option> <option value="SK">Slovakia</option> <option value="SI">Slovenia</option> <option value="SB">Solomon Islands</option> <option value="SO">Somalia</option> <option value="ZA">South Africa</option> <option value="GS">South Georgia and the South Sandwich Islands</option> <option value="ES">Spain</option> <option value="LK">Sri Lanka</option> <option value="SH">Saint Helena</option> <option value="PM">Saint Pierre and Miquelon</option> <option value="SD">Sudan</option> <option value="SR">Suriname</option> <option value="SJ">Svalbard and Jan Mayen</option> <option value="SZ">Swaziland</option> <option value="SE">Sweden</option> <option value="CH">Switzerland</option> <option value="SY">Syrian Arab Republic</option> <option value="TW">Taiwan</option> <option value="TJ">Tajikistan</option> <option value="TZ">Tanzania, United Republic of</option> <option value="TH">Thailand</option> <option value="TG">Togo</option> <option value="TK">Tokelau</option> <option value="TO">Tonga</option> <option value="TT">Trinidad and Tobago</option> <option value="TN">Tunisia</option> <option value="TR">Turkey</option> <option value="TM">Turkmenistan</option> <option value="TC">Turks and Caicos Islands</option> <option value="TV">Tuvalu</option> <option value="UG">Uganda</option> <option value="UA">Ukraine</option> <option value="AE">United Arab Emirates</option> <option value="GB">United Kingdom</option> <option value="US">United States</option> <option value="UM">United States Minor Outlying Islands</option> <option value="UY">Uruguay</option> <option value="UZ">Uzbekistan</option> <option value="VU">Vanuatu</option> <option value="VE">Venezuela</option> <option value="VN">Vietnam</option> <option value="VG">Virgin Islands, British</option> <option value="VI">Virgin Islands, U.S.</option> <option value="WF">Wallis and Futuna</option> <option value="EH">Western Sahara</option> <option value="YE">Yemen</option> <option value="RS">Serbia</option> <option value="ZM">Zambia</option> <option value="ZW">Zimbabwe</option> <option value="GG">Guernsey</option> <option value="IM">Isle of Man</option> <option value="JE">Jersey</option> <option value="ME">Montenegro</option> <option value="PS">Palestinian Territory</option>
                                </select>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="exampleInputEmail1">{{ trans('competition.select_answer') }}</label>
                                <select class="form-control" name="select_answer" id="select_answer" required>
                                    <option value="" readonly="true">{{ trans('competition.select_answer') }}</option>
                                    <option value="Home">{{ trans('competition.answers.home') }}</option>
                                    <option value="Catchup">{{ trans('competition.answers.catchup') }}</option>
                                    <option value="Live">{{ trans('competition.answers.live') }}</option>
                                    <option value="Schedule">{{ trans('competition.answers.schedule') }}</option>
                                    <option value="Shows">{{ trans('competition.answers.shows') }}</option>
                                    <option value="Search">{{ trans('competition.answers.search') }}</option>
                                </select>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-5 col-sm-6">
                                    <button type="submit" class="btn btn-lg btn-submit">{{ trans('competition.submit') }}</button>
                                </div>
                                <div class="col-lg-6 col-md-7 col-sm-6	">
                                    <div class="note">
                                        {{ trans('competition.terms') }}‎
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>

    @include('include.inner_footer')

    <script>
        jQuery(document).ready(function () {

            $("#competition-form").submit(function (e) {

                e.preventDefault();

                $(this).find(":submit").prop("disabled", true);

                $.post('/gitex', $(this).serialize(), function (content) {

                    if(content != '' && !$.isEmptyObject(content)) {

                        if(content.errors == 0) {
                            $(".reset_success").fadeIn().show();
                            $(".reset_success").find('.success_message').html('{{ trans('competition.errors.success') }}');
                        }else if(content.errors == 1){
                            $(".reset_error ").fadeIn().show();
                            $(".reset_error").find('.error_message').html('{{ trans('competition.errors.required') }}');
                        }else if(content.errors == 2){
                            $(".reset_error ").fadeIn().show();
                            $(".reset_error").find('.error_message').html('{{ trans('competition.errors.exists') }}');
                        }else{
                            $(".reset_error ").fadeIn().show();
                            $(".reset_error").find('.error_message').html('{{ trans('competition.errors.required') }}');
                        }
                        setTimeout(function () {
                            $(".reset_success").fadeOut();
                            $(".reset_error").fadeOut();
                        }, 5000);

                    } else {
                        $(".reset_error ").fadeIn().show();
                        setTimeout(function () {
                            $(".reset_error").fadeOut();
                        }, 5000);
                    }

                }, "json");

                $(this).find(":submit").prop("disabled", false);
            });

        });
    </script>
</div>

@endsection
