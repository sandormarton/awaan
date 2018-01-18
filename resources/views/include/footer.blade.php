<!-- 	 FOOTER WRAPPER [START]		-->
<footer class="footer-wrapper">
    <div class="container">

        <div class="row">
            <div class="col-md-6 col-sm-6 text-awaan-logo">
                <img src="{{asset('images/logo.png')}}" alt="awaan logo" class="img-responsive center-block" /><a class="terms-footer"  target="_blank" href="http://www.dmi.gov.ae/privacy.asp?pgTitle=terms&ChannelID=10&lang=ar">{{ trans('content.whole.terms') }}</a><a class="footer-app-href" href="/app">{{ trans('content.app.apps') }}</a>
            </div>
            <div class="col-md-6 col-sm-6 text-awaan-sm">
                <span>Awaan &copy; 2017</span>
                <a href="https://www.facebook.com/OnAwaan/" target="_blank"><h4 style="display: none">facebook page</h4><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/OnAwaan" target="_blank"><h4 style="display: none">twitter page</h4><i class="fa fa-twitter"></i></a>
            </div>
        </div>

    </div>

</footer>
<!-- 	 FOOTER WRAPPER [END]		-->

<!-- REGISTER MODAL [START] -->

@include('include.js_components')

<!-- REGISTER MODAL [END] -->