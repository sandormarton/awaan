<!-- 	 FOOTER WRAPPER [START]		-->
<style>
    .footer-wrapper-sticky {
        position: fixed;
        height: 100px;
        bottom: 0;
        right: 0;
        width: 100%;
        z-index: 9999;
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        -ms-transition: all 0.3s ease-in;
        -o-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
        background: #000000; padding: 15px 0; color: #cacaca; border-top: 1px solid #2bb6f3;
    }

    .site-main-container{
        padding-bottom: 100px
    }

</style>

<script>
    jQuery(document).ready(function () {


//        var setCommandBarPosition = function () {
//            var footerOffset = $(".footer-wrapper").offset().top,
//                scrollTop = $(window).scrollTop(),
//                windowHeight = $(window).height(),
//                commandBarHeight = $(".player").height(),
//                weOverlappedFooter = ((windowHeight + scrollTop - commandBarHeight) >= footerOffset);
//
//            if (weOverlappedFooter) {
//                jQuery('.footer-wrapper').removeClass('footer-wrapper-sticky');
//            } else {
//                jQuery('.footer-wrapper').addClass('footer-wrapper-sticky');
//            }
//        };
//
//        $(window).scroll(function () {
//            setCommandBarPosition();
//        });

//        jQuery(window).scroll(function () {
//            if ($(window).scrollTop() + $(window).height() >= $(document).height() -50) {
//                jQuery('.footer-wrapper').removeClass('footer-wrapper-sticky');
//                jQuery('.scrollup').fadeIn();
//
//            } else {
//                if(!jQuery('.footer-wrapper').hasClass('footer-wrapper-sticky')){
//                    jQuery('.footer-wrapper').addClass('footer-wrapper-sticky');
//                    jQuery('.scrollup').fadeIn();
//                }
//            }
//        });
    });
</script>

<footer class="footer-wrapper-sticky">
    <div class="container">

        <div class="row">
            {{--<div class="col-md-2 text-awaan-logo">--}}
                {{--<span>Awaan &copy; 2017</span>--}}
                {{--<a href="#"><i class="fa fa-facebook"></i></a>--}}
                {{--<a href="#"><i class="fa fa-twitter"></i></a><br>--}}
                {{--<span>{{ trans('content.whole.terms') }}</span>--}}
            {{--</div>--}}
            <div class="col-md-12 player" id="video_embed_player">
                {{--<iframe class="video_embedd"--}}
                        {{--src="http://player.mangomolo.com/dev/audio?id=172&user_id=71&countries=WyJBRCJd&zone=&filter=DENY&autoplay=false&signature=023559f7ecfee4818c64d52471daab0c"--}}
                        {{--allowfullscreen="allowfullscreen" style="border: 0; overflow: hidden; width: 100%"></iframe>--}}
            </div>
        </div>

    </div>

</footer>
<!-- 	 FOOTER WRAPPER [END]		-->

<!-- REGISTER MODAL [START] -->

@include('include.js_components')

<!-- REGISTER MODAL [END] -->
