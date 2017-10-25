<div class="modal awaan-user-section-modal awaan-user-section-register-modal fade" id="registerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="ion-close-round"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 register-wrapper">
                    <div class="site-logo" style="text-align: center;">
                        <a href="#"><img src="/images/logo.png" alt="AWAAN" class="img-responsive center-block" />
                            @if(ends_with(Route::currentRouteAction(), 'Premium@index'))
                                <span style="color:gold;">GOLD</span>
                            @endif
                        </a>
                    </div>
                    <div class="form-wrapper">
                        <div class="alert alert-dismissible reg_error" role="alert" style="display: none">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span class="glyphicon glyphicon-info-sign"></span> <span class="message"></span>
                        </div>
                        <form class="register_form">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname" style="display: none;">firstname</label>
                                        <input type="text" class="form-control" title="{{ trans('content.register.first_name') }}" placeholder="{{ trans('content.register.first_name') }}" name="firstname" id="firstname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname" style="display: none;">lastname</label>
                                        <input type="text" class="form-control" title="{{ trans('content.register.last_name') }}" placeholder="{{ trans('content.register.last_name') }}" name="lastname" id="lastname">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" style="display: none;">email</label>
                                        <input type="email" class="form-control" title="{{ trans('content.register.email') }}" placeholder="{{ trans('content.register.email') }}"  name="email" id="email" data-validation-matches-message="Must match email address entered above"  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="username" style="display: none;">username</label>
                                        <input type="text" class="form-control" title="{{ trans('content.register.username') }}" placeholder="{{ trans('content.register.username') }}" name="username" id="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" style="display: none;">password</label>
                                        <input type="password" class="form-control" title=" {{ trans('content.register.password') }}" placeholder=" {{ trans('content.register.password') }}" name="password" id="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile_phone" style="display: none;">mobile phone</label>
                                        <input type="text" class="form-control" title=" {{ trans('content.register.mobile') }}" placeholder=" {{ trans('content.register.mobile') }}" name="mobile" id="mobile_phone">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="Gender" style="display: none;">Gender</label>
                                        <select id="Gender" title="Gender" class="form-control">
                                            <option value="">-Gender-</option>
                                            <option value="male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="birth_year" style="display: none;">birth year</label>
                                        <select title="{{ trans('content.register.birth_year') }}" class="form-control" name="birthday" id="birth_year">
                                            <option value="">{{ trans('content.register.birth_year') }} </option>
                                            @for($year = date('Y'); $year > date('Y')-100; $year--)
                                                <option value="{{$year}}">{{$year}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="country" style="display: none;">country</label>
                                        <select title="{{ trans('content.register.country') }}" class="form-control" name="country" id="country">
                                            <option value="">{{ trans('content.register.country') }} </option>
                                            <option value="AF">Afghanistan</option> <option value="AL">Albania</option> <option value="DZ">Algeria</option> <option value="AS">American Samoa</option> <option value="AD">Andorra</option> <option value="AO">Angola</option> <option value="AI">Anguilla</option> <option value="AQ">Antarctica</option> <option value="AG">Antigua and Barbuda</option> <option value="AR">Argentina</option> <option value="AM">Armenia</option> <option value="AW">Aruba</option> <option value="AU">Australia</option> <option value="AT">Austria</option> <option value="AZ">Azerbaijan</option> <option value="BS">Bahamas</option> <option value="BH">Bahrain</option> <option value="BD">Bangladesh</option> <option value="BB">Barbados</option> <option value="BY">Belarus</option> <option value="BE">Belgium</option> <option value="BZ">Belize</option> <option value="BJ">Benin</option> <option value="BM">Bermuda</option> <option value="BT">Bhutan</option> <option value="BO">Bolivia</option> <option value="BA">Bosnia and Herzegovina</option> <option value="BW">Botswana</option> <option value="BV">Bouvet Island</option> <option value="BR">Brazil</option> <option value="IO">British Indian Ocean Territory</option> <option value="BN">Brunei Darussalam</option> <option value="BG">Bulgaria</option> <option value="BF">Burkina Faso</option> <option value="BI">Burundi</option> <option value="KH">Cambodia</option> <option value="CM">Cameroon</option> <option value="CA">Canada</option> <option value="CV">Cape Verde</option> <option value="KY">Cayman Islands</option> <option value="CF">Central African Republic</option> <option value="TD">Chad</option> <option value="CL">Chile</option> <option value="CN">China</option> <option value="CX">Christmas Island</option> <option value="CC">Cocos (Keeling) Islands</option> <option value="CO">Colombia</option> <option value="KM">Comoros</option> <option value="CG">Congo</option> <option value="CD">Congo, the Democratic Republic of the</option> <option value="CK">Cook Islands</option> <option value="CR">Costa Rica</option> <option value="CI">Cote d'Ivoire</option> <option value="HR">Croatia</option> <option value="CU">Cuba</option> <option value="CY">Cyprus</option> <option value="CZ">Czech Republic</option> <option value="DK">Denmark</option> <option value="DJ">Djibouti</option> <option value="DM">Dominica</option> <option value="DO">Dominican Republic</option> <option value="TL">Timor-Leste</option> <option value="EC">Ecuador</option> <option value="EG">Egypt</option> <option value="SV">El Salvador</option> <option value="GQ">Equatorial Guinea</option> <option value="ER">Eritrea</option> <option value="EE">Estonia</option> <option value="ET">Ethiopia</option> <option value="FK">Falkland Islands (Malvinas)</option> <option value="FO">Faroe Islands</option> <option value="FJ">Fiji</option> <option value="FI">Finland</option> <option value="FR">France</option> <option value="AX">Aland Islands</option> <option value="GF">French Guiana</option> <option value="PF">French Polynesia</option> <option value="TF">French Southern Territories</option> <option value="GA">Gabon</option> <option value="GM">Gambia</option> <option value="GE">Georgia</option> <option value="DE">Germany</option> <option value="GH">Ghana</option> <option value="GI">Gibraltar</option> <option value="GR">Greece</option> <option value="GL">Greenland</option> <option value="GD">Grenada</option> <option value="GP">Guadeloupe</option> <option value="GU">Guam</option> <option value="GT">Guatemala</option> <option value="GN">Guinea</option> <option value="GW">Guinea-Bissau</option> <option value="GY">Guyana</option> <option value="HT">Haiti</option> <option value="HM">Heard Island and McDonald Islands</option> <option value="VA">Holy See (Vatican City State)</option> <option value="HN">Honduras</option> <option value="HK">Hong Kong</option> <option value="HU">Hungary</option> <option value="IS">Iceland</option> <option value="IN">India</option> <option value="ID">Indonesia</option> <option value="IR">Iran, Islamic Republic of</option> <option value="IQ">Iraq</option> <option value="IE">Ireland</option> <option value="IT">Italy</option> <option value="JM">Jamaica</option> <option value="JP">Japan</option> <option value="JO">Jordan</option> <option value="KZ">Kazakhstan</option> <option value="KE">Kenya</option> <option value="KI">Kiribati</option> <option value="KP">Korea, Democratic People's Republic of</option> <option value="KR">Korea, Republic of</option> <option value="KW">Kuwait</option> <option value="KG">Kyrgyzstan</option> <option value="LA">Lao People's Democratic Republic</option> <option value="LV">Latvia</option> <option value="LB">Lebanon</option> <option value="LS">Lesotho</option> <option value="LR">Liberia</option> <option value="LY">Libyan Arab Jamahiriya</option> <option value="LI">Liechtenstein</option> <option value="LT">Lithuania</option> <option value="LU">Luxembourg</option> <option value="MO">Macao</option> <option value="MK">Macedonia</option> <option value="MG">Madagascar</option> <option value="MW">Malawi</option> <option value="MY">Malaysia</option> <option value="MV">Maldives</option> <option value="ML">Mali</option> <option value="MT">Malta</option> <option value="MH">Marshall Islands</option> <option value="MQ">Martinique</option> <option value="MR">Mauritania</option> <option value="MU">Mauritius</option> <option value="YT">Mayotte</option> <option value="MX">Mexico</option> <option value="FM">Micronesia, Federated States of</option> <option value="MD">Moldova, Republic of</option> <option value="MC">Monaco</option> <option value="MN">Mongolia</option> <option value="MS">Montserrat</option> <option value="MA">Morocco</option> <option value="MZ">Mozambique</option> <option value="MM">Myanmar</option> <option value="NA">Namibia</option> <option value="NR">Nauru</option> <option value="NP">Nepal</option> <option value="NL">Netherlands</option> <option value="AN">Netherlands Antilles</option> <option value="NC">New Caledonia</option> <option value="NZ">New Zealand</option> <option value="NI">Nicaragua</option> <option value="NE">Niger</option> <option value="NG">Nigeria</option> <option value="NU">Niue</option> <option value="NF">Norfolk Island</option> <option value="MP">Northern Mariana Islands</option> <option value="NO">Norway</option> <option value="OM">Oman</option> <option value="PK">Pakistan</option> <option value="PW">Palau</option> <option value="PA">Panama</option> <option value="PG">Papua New Guinea</option> <option value="PY">Paraguay</option> <option value="PE">Peru</option> <option value="PH">Philippines</option> <option value="PN">Pitcairn</option> <option value="PL">Poland</option> <option value="PT">Portugal</option> <option value="PR">Puerto Rico</option> <option value="QA">Qatar</option> <option value="RE">Reunion</option> <option value="RO">Romania</option> <option value="RU">Russian Federation</option> <option value="RW">Rwanda</option> <option value="KN">Saint Kitts and Nevis</option> <option value="LC">Saint LUCIA</option> <option value="VC">Saint Vincent and the Grenadines</option> <option value="WS">Samoa</option> <option value="SM">San Marino</option> <option value="ST">Sao Tome and Principe</option> <option value="SA">Saudi Arabia</option> <option value="SN">Senegal</option> <option value="SC">Seychelles</option> <option value="SL">Sierra Leone</option> <option value="SG">Singapore</option> <option value="SK">Slovakia</option> <option value="SI">Slovenia</option> <option value="SB">Solomon Islands</option> <option value="SO">Somalia</option> <option value="ZA">South Africa</option> <option value="GS">South Georgia and the South Sandwich Islands</option> <option value="ES">Spain</option> <option value="LK">Sri Lanka</option> <option value="SH">Saint Helena</option> <option value="PM">Saint Pierre and Miquelon</option> <option value="SD">Sudan</option> <option value="SR">Suriname</option> <option value="SJ">Svalbard and Jan Mayen</option> <option value="SZ">Swaziland</option> <option value="SE">Sweden</option> <option value="CH">Switzerland</option> <option value="SY">Syrian Arab Republic</option> <option value="TW">Taiwan</option> <option value="TJ">Tajikistan</option> <option value="TZ">Tanzania, United Republic of</option> <option value="TH">Thailand</option> <option value="TG">Togo</option> <option value="TK">Tokelau</option> <option value="TO">Tonga</option> <option value="TT">Trinidad and Tobago</option> <option value="TN">Tunisia</option> <option value="TR">Turkey</option> <option value="TM">Turkmenistan</option> <option value="TC">Turks and Caicos Islands</option> <option value="TV">Tuvalu</option> <option value="UG">Uganda</option> <option value="UA">Ukraine</option> <option selected="selected" value="AE">United Arab Emirates</option> <option value="GB">United Kingdom</option> <option value="US">United States</option> <option value="UM">United States Minor Outlying Islands</option> <option value="UY">Uruguay</option> <option value="UZ">Uzbekistan</option> <option value="VU">Vanuatu</option> <option value="VE">Venezuela</option> <option value="VN">Vietnam</option> <option value="VG">Virgin Islands, British</option> <option value="VI">Virgin Islands, U.S.</option> <option value="WF">Wallis and Futuna</option> <option value="EH">Western Sahara</option> <option value="YE">Yemen</option> <option value="RS">Serbia</option> <option value="ZM">Zambia</option> <option value="ZW">Zimbabwe</option> <option value="GG">Guernsey</option> <option value="IM">Isle of Man</option> <option value="JE">Jersey</option> <option value="ME">Montenegro</option> <option value="PS">Palestinian Territory</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="city" style="display: none;">city</label>
                                        <input type="text" class="form-control" title="{{ trans('content.register.city') }}" placeholder="{{ trans('content.register.city') }}" name="city" id="city" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ebcaptchainput" style="display: none;">captcha</label>
                                      <input type="text" class="form-control captchax" id="ebcaptchainput" name="ebcaptchainput" placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-green">{{ trans('content.register.register') }} </button>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="register-submit"></div>
                                    <div class="checkbox text-center">
                                        <label>
                                            <input type="checkbox" name="terms_conditions" title="This is a required field" id="terms_conditions" required>
                                            <span data-i18n="register.agree">   {{ trans('content.register.agree') }}   </span>
                                            <a href="http://www.dmi.gov.ae/privacy.asp?pgTitle=terms&ChannelID=10&lang=ar"  title="opens in a new window" target="_blank">
                                                <span data-i18n="register.term">{{ trans('content.register.term') }}  </span>
                                            </a>
                                            <span data-i18n="register.and">{{ trans('content.register.and') }}</span>
                                            <a href="http://www.dmi.gov.ae/privacy.asp?pgTitle=privacy&ChannelID=10&lang=ar" title="opens in a new window" target="_blank">
                                            	<span>{{ trans('content.register.privacypolicy') }} </span>
                                            </a>
                                             <!--<a href="http://www.dmi.gov.ae/static.asp?pgTitle=terms&ChannelID=10&lang=ar" target="_blank">
                                                <span data-i18n="register.term">{{ trans('content.register.term') }}  </span>
                                            </a>
                                            <span data-i18n="register.and">{{ trans('content.register.and') }}</span>
                                            <a href="http://www.dmi.gov.ae/static.asp?pgTitle=privacy&ChannelID=10&lang=ar" target="_blank">
                                            	<span>{{ trans('content.register.privacypolicy') }} </span>
                                            </a> -->
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="71">
                        </form>
                        <div class="extra-links">
                            <a href="#" class="btn btn-block btn-facebook fb_login"><i class="ion-social-facebook"></i> {{ trans('content.register.signinfb') }}  </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>








