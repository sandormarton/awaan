{{--<link rel="stylesheet" type="text/css" href="{{asset("/js/ilightbox/css/ilightbox.css")}}"/>--}}
<script src="{{asset("/js/jquery.maskedinput.min.js")}}" type="text/javascript"></script>
{{--<script src="{{asset("/js/jquery.infinitescroll.min.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{asset("/js/jquery.matchHeight-min.js")}}" type="text/javascript"></script>--}}
<script src="{{asset("/js/rating/jquery.rateyo.min.js")}}" type="text/javascript"></script>

<script src="https://apis.google.com/js/client.js"> </script>
<script src="http://player.mangomolo.com/public/js/player-events.js"></script>

<script>
    window.paceOptions = {
        //minTime: 2000,
        ghostTime: 500,
        //restartOnRequestAfter: true,
        restartOnPushState: false,
        ajax: false, // disabled
        document: false, // disabled
        eventLag: false // disabled
        //startOnPageLoad:false
    };
</script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>

@if(ends_with(Route::currentRouteAction(), 'Home@index'))
    <script>
        $(document).ready(function () {
            @if(isset($_GET['token']))
                $('#passwordChangeModal').modal('show');
            @endif

            {{--function hasIntro() {--}}
                {{--$.cookie('hasIntros', 'no', {expires: 7});--}}
            {{--}--}}

            {{--var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|BB10/i.test(navigator.userAgent) ? true : false;--}}
            {{--if ($.cookie('hasIntros') != 'no') {--}}
                {{--var options = {--}}
                    {{--message: $('<a href="http://ring2win.ae/"><img class="img-responsive center-block" src="{{asset("/images/win_modal_".Session::get('lang').".jpg")}}"/></a>'),--}}
                    {{--title: 'Ring2win',--}}
                    {{--buttons: [--}}
                        {{--{text: "Don't show this again", style: 'info', close: true, click: hasIntro}--}}
                    {{--]--}}
                {{--};--}}
                {{--//eModal.alert(options);--}}
            {{--}--}}
        });
    </script>
@endif

<!-- YAMLI CODE START -->
{{--<script type="text/javascript" src="http://api.yamli.com/js/yamli_api.js"></script>--}}
{{--<script type="text/javascript">--}}
    {{--if (typeof (Yamli) == "object" && Yamli.init({uiLanguage: "ar", startMode: "onOrUserDefault", zIndexBase: 10000})) {--}}

        {{--Yamli.yamlify('term', {settingsPlacement: 'hide', zIndexBase: 10000});--}}
    {{--}--}}
{{--</script>--}}
<!-- YAMLI CODE END -->

<script type="text/javascript">
    window.fbAsyncInit = function () {
        FB.init({
            appId: '554876877966815',
            cookie: true, // enable cookies to allow the server to access
            xfbml: true, // parse social plugins on this page
            version: 'v2.8' // use version 2.2
        });
    };
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript" src="{{asset("/js/ads2.js")}}"></script>

<!-- BEGIN EFFECTIVE MEASURE CODE -->
<!-- COPYRIGHT EFFECTIVE MEASURE -->
<script type="text/javascript">
    (function() {
        var em = document.createElement('script'); em.type = 'text/javascript'; em.async = true;
        em.src = ('https:' == document.location.protocol ? 'https://me-ssl' : 'http://me-cdn') + '.effectivemeasure.net/em.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(em, s);
    })();
</script>
{{--<noscript>--}}
    {{--<img src="https://me.effectivemeasure.net/em_image" alt="" style="position:absolute; left:-5px;" />--}}
{{--</noscript>--}}
<!--END EFFECTIVE MEASURE CODE -->

@yield('additional_scripts')
