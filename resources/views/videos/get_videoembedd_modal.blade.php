<div class="modal awaan-user-section-modal fade" id="copyEmbedModel" tabindex="-1" role="dialog">
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

                    <h3 class="popup-title">{{ trans('content.video.getemb') }}</h3>
                    <div class="form-wrapper">

                        {{--*/ $userid=0/*--}}
                        @if(Session::has('user'))
                        <?php
                        $userid = session('user')['id'];
                        ?>
                        @endif


                        <form class="fetchEmbedCode" method="post">
                            <fieldset>
                                <legend data-i18n="embed.ext">{{trans('content.video.embed.embedparam') }}</legend>
                                <p>
                                    <input type="hidden" value="//admin.mangomolo.com/analytics/index.php/customers/embed/video?id={{$vid}}&user_id=71&countries=Q0M=&w=100%&h=100%&filter=DENY&signature={{$videosignature}}" id="videoUrl">
                                    <label data-i18n="embed.width" for="videoWidth"> {{ trans('content.video.embed.width') }}</label>
                                    <input type="number" size="3" value="400" id="videoWidth">
                                    <label data-i18n="embed.height" for="videoHeight">{{trans('content.video.embed.height') }}</label>
                                    <input type="number" size="3" value="300" id="videoHeight">

                                    <label data-i18n="embed.auto" for="videoAutoPlay">{{ trans('content.video.embed.videoplay') }}</label>
                                    <input type="checkbox" value="1" class="autoplay" id="videoAutoPlay">

                                    <label for="videoResponsive"> {{trans('content.video.embed.responsive') }}</label>
                                    <input  data-responsive="responsive" type="checkbox" value="1" class="responsive" id="videoResponsive">

                                </p>
                            </fieldset>
                            <fieldset>
                                <legend>{{trans('content.video.embed.offset') }}</legend>
                                <div class="form-group">
                                    <input  class="responsive input-sm" type="text" id="offset" name="offset">
                                    <label for="offset" style="display: none;">offset</label>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend data-i18n="embed.result">{{trans('content.video.embed.result') }}</legend>
                                <div class="form-group">
                                    <label data-i18n="embed.embed_code" for="embedCode"> {{trans('content.video.embed.embedcode') }}  </label>
                                    <textarea id="embedCode" rows="5" class="form-control" style="text-align: left" readonly="true"></textarea>
                                </div>
                            </fieldset>
                            <p>
                                <input type="button" id="generatecode" value="{{trans('content.video.embed.generatecode')}}"  class="btn btn-info btn-block fetchEmbed">
                            </p>
                        </form>

                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>

</div>


<script>
    function secondsTimeSpanToHMS(s) {
        var h = Math.floor(s/3600); //Get whole hours
        s -= h*3600;
        var m = Math.floor(s/60); //Get remaining minutes
        s -= m*60;
        return h+":"+(m < 10 ? '0'+m : m)+":"+(s < 10 ? '0'+s : s); //zero padding on minutes and seconds
    }

    $(function () {
        $('#videoAutoPlay,#videoResponsive,#videoWidth,#videoHeight').on('change', function () {
            /*Trigger the button when  visible*/
            $('#generatecode:visible').trigger('click');

        });
        $('#copyEmbedModel').on('shown.bs.modal', function () {
            var offset_seconds = "{{$video->duration}}";
            var offset_limit = secondsTimeSpanToHMS(offset_seconds);

            $("#offset").mask("99:99:99");
            $("#offset").val(offset_limit);

            $('#embedCode').val('');
            $('#generatecode:visible').on('click', function () {

                $("#offset").on('keypress',function() {
                    $(this).css({ 'background': 'white' });
                });

                /*Get the iframe param */
                var width = $('#videoWidth').val();
                var height = $('#videoHeight').val();
                var videoautoplay = $('#videoAutoPlay').val();
                var autoplay = 'false';
                var offset = $('#offset').val();
                if($('#videoAutoPlay:checked').length > 0) {
                    autoplay = 'true'
                }
                width = width+'px';
                height = height+'px';
                if($('#videoResponsive:checked').length > 0) {
                    width = height = '100%';
                    // var height = '100%';
                }

                if(offset != '') {
                    var a = offset.split(':'); // split it at the colons
                    var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);

                    offset = '#t='+seconds;

                    if(seconds == offset_seconds){
                        offset = '';
                    }else if(seconds > offset_seconds){
                        $('#offset').css({ 'background': 'red' });
                        offset = '';
                    }
                    // var height = '100%';
                }

                var iframe = '<iframe title="Video" frameborder="0" scrolling="no" src="' + $('#videoUrl').val() + '&jwplayer=7&autoplay=' + autoplay + offset+'" allowtransparency="true" style="position: relative;  width: '+width+'; height: '+height+'"></iframe>';
                $('#embedCode').val(iframe);
            });


        });
    });


</script>