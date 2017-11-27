@extends('layouts.master')
<?php
if(Session::get('lang') == 'en'){
    $title = $content->title_en;
}else{
    $title = $content->title_ar;
}
?>
@section('title',substr( $title, 0, 64))
@section('social_header_meta')
@include('include.social_header',['social_meta'=>$content,'meta'=>$content->ch_meta])

@endsection
        <!--This defines a home  section which gets displayed via "yield" -->

@section('main-content')
<h1 style="display: none">Awaan</h1>
<h2 style="display: none">Awaan</h2>
<h3 style="display: none">Awaan</h3>
    <!-- VIDEO WRAPPER [START]	-->
    <div class="video-wrapper">
        <div class="container">
            <div class="video-container">
                @if($content->geo_deny==0)
                <div class="embed-responsive embed-responsive-16by9">
                            @include('videos.embedd_code',['embeddcode'=> $content->embed,'show' => $content, 'channel_userid' => $channel_userid, 'offset' => $offset])
                </div>
                @else
                <div class="embed-responsive embed-responsive-16by9" style="background: white;color: black;font-size: 24px;margin: 0 auto;text-align: center;padding-top: 100px;">
                    {{ trans('content.whole.non_available') }}
                </div>
                @endif
            </div>
            <div class="video-content-wrapper">
                <?php
                if(Session::get('lang') == 'ar'){
                    $title = $content->title_ar;
                    if(!isset($title) || empty($title)){
                        $title = $content->title_en;
                    }
                    if(isset($currentseasons->shows_parent) and !empty($currentseasons->shows_parent) and isset($currentseasons->shows_parent[0]) and !empty($currentseasons->shows_parent[0]) and isset($currentseasons->shows_parent[0]->title_ar) and !empty($currentseasons->shows_parent[0]->title_ar)){
                        $cat = $currentseasons->shows_parent[0]->title_ar;
                        $cat_id_return = $currentseasons->shows_parent[0]->id;
                    }
                }
                else{
                    $title = $content->title_en;
                    if(!isset($title) || empty($title)){
                        $title = $content->title_ar;
                    }
                    if(isset($currentseasons->shows_parent) and !empty($currentseasons->shows_parent) and isset($currentseasons->shows_parent[0]) and !empty($currentseasons->shows_parent[0]) and isset($currentseasons->shows_parent[0]->title_en) and !empty($currentseasons->shows_parent[0]->title_en)){
                        $cat = $currentseasons->shows_parent[0]->title_en;
                        $cat_id_return = $currentseasons->shows_parent[0]->id;
                    }
                }
                ?>
                <div class="row">
                    <div class="col-md-9 col-sm-8 video-detail-div">
                        <h3 class="video-title">{{$title}}</h3>
                        <div class="btns-div">
                            @if(Session::has('user_info'))
                                <?php
                                $uid = Session::get('user_info');
                                ?>
                                    @if(empty($content->video_faved_id))
                                        <a  class="btn btn-favourite not-active-fav" data-channeluserid="<?=$uid->id?>" data-lang="{{Session::get('lang')}}" data-id="{{$vid}}"><img src="{{asset('images/icon-fav.png')}}" alt="favourite" /></a>
                                    @else
                                        <a  class="btn btn-favourite active-fav" data-channeluserid="<?=$uid->id?>" data-lang="{{Session::get('lang')}}" data-id="{{$vid}}"><img src="{{asset('images/icon-fav-active.png')}}" alt="favourite" /></a>
                                    @endif
                                    <a class="btn btn-embaded get_offset"  data-toggle="modal" data-target="#dd" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{asset('images/share-icon.png')}}" alt="embed" /></a>
                                    <a class="btn btn-embaded" data-toggle="modal" data-target="#copyEmbedModel"
                                       role="button" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{asset('images/icon-embaded.png')}}" alt="{{ trans('content.video.getemb') }}" />
                                    </a>
                            @else
                                <a href="<?=URL::to('auth/login')?>" class="btn btn-favourite"><img src="{{asset('images/icon-fav.png')}}" alt="favourite" /></a>
                                <a href="<?=URL::to('auth/login')?>?" class="btn btn-embaded"><img src="{{asset('images/share-icon.png')}}" alt="share" /></a>
                                <a href="<?=URL::to('auth/login')?>?" class="btn btn-embaded"><img src="{{asset('images/icon-embaded.png')}}" alt="embed" /></a>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 sm-detail-div">
                        <div class="sm-buttons-div">
                            <a class="hidden-lg visible-sm visible-xs hidden-md" href="whatsapp://send?text={{$shareurl}}" data-action="share/whatsapp/share"><img src="{{asset('images/icon-whatsapp.png')}}"  alt="share on whatsapp"/></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{$shareurl}}" data-share-url="{{($shareurl)}}" data-share-type="facebook" target="_blank"><img src="{{asset('images/icon-fblike.png')}}"  alt="share on facebook"/></a>
                            <a href="https://twitter.com/intent/tweet?url={{$shareurl}}&via=OnAwaan" data-share-url="{{($shareurl)}}" data-share-type="twitter" target="_blank"><img src="{{asset('images/icon-twtweet.png')}}"  alt="Tweet"/></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9 more-episodes-div">
                        @if(!empty($currentseasons) && isset($currentseasons->videos) && is_array($currentseasons->videos) && sizeof($currentseasons->videos) > 0)
                            <div class="title-section">
                                <h3>{{ trans('content.whole.more_episode2') }}</h3>
                                <a href="{{URL::to('show/allprograms/'.$cat_id_return.'/'. $cat )}}" class="btn btn-awaanbluebtn btn-viewall">{{ trans('content.whole.return_to_category') }}</a>
                            </div>
                            <div class="content-div">
                                <div class="row" id="related-episode-container">
                                    <?php
                                    $video_hover['desc'] = $video_hover['category'] = '' ?>
                                    @if(!empty($currentseasons) && isset($currentseasons->videos) && is_array($currentseasons->videos) && sizeof($currentseasons->videos) > 0)
                                        @foreach($currentseasons->videos as $item)
                                            @if(Session::get('lang') == 'ar')
                                                <?php
                                                if (isset($item->description_ar) && !empty($item->description_ar)) {
                                                    $video_hover['desc'] = $item->description_ar;
                                                }
                                                        if (isset($item->cat_ar) && !empty($item->cat_ar)) {
                                                            $cat_name = $item->cat_ar;
                                                        }else{
                                                            $cat_name ='';
                                                        }

                                                $video_hover['videotitle'] = $item->title_ar;

                                                //  $video_hover['category']=$currentseasons->shows_parent[0]->title_ar;
                                                ?>
                                                @if(isset($currentseasons->shows_parent[0]->title_ar))
                                                    <?php  $video_hover['category'] = $currentseasons->shows_parent[0]->title_ar?>
                                                @endif
                                                <?php
                                                    $url = URL::to('video/'.$item->id.'/'.rawurlencode(\App\Helpers\Functions::cleanurl($item->title_ar)));
                                                    $url2 = URL::to('video/'.$item->id.'/'.\App\Helpers\Functions::cleanurl($item->title_ar));
                                                    $title = $item->title_ar;
                                                    ?>
                                            @else
                                                <?php $video_hover['videotitle'] = $item->title_en;
                                                $video_hover['desc'] = (isset($item->description_en) && !empty($item->description_en)) ? $item->description_en : false;
                                                    if (isset($item->cat_en) && !empty($item->cat_en)) {
                                                        $cat_name = $item->cat_en;
                                                    }else{
                                                        $cat_name ='';
                                                    }
                                                //  $video_hover['category']=$currentseasons->shows_parent[0]->title_en;
                                                ?>
                                                @if(isset($currentseasons->shows_parent[0]->title_en))
                                                    <?php $video_hover['category'] = $currentseasons->shows_parent[0]->title_en?>
                                                @endif
                                                    <?php
                                                    $url = URL::to('video/'.$item->id.'/'.rawurlencode(\App\Helpers\Functions::cleanurl($item->title_en)));
                                                    $url2 = URL::to('video/'.$item->id.'/'.\App\Helpers\Functions::cleanurl($item->title_en));
                                                    $title = $item->title_en;
                                                    ?>
                                            @endif
                                            <?php
                                            //  $url = route('video', [$item->id, $item->title_ar]);
                                            $img = config('mangoapi.mangodcn') . $item->img;
                                            ?>

                                                <div class="col-md-4 col-sm-4 col-xs-6 video-col" data-toggle="popover" data-trigger="hover" data-placement="top" title="{{$cat}}" data-content="<?php echo $title . '&#10;'. $item -> recorder_date ?>">
                                                    <a href="{{$url2}}?">
                                                        <p style="display: none">{{$title}}</p>
                                                        <div class="img-div">
                                                            {{--<img src="{{$img}}" class="img-responsive center-block" />--}}
                                                            <div class="embed-responsive-item image-div lazy-image-handler" data-src="{{$img}}"  style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                                        </div>
                                                    </a>
                                                    <div class="content">
                                                        <a href="#" class="title-link">{{$title}}</a>
                                                    </div>
                                                </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="load-more-div">
                                <a href="#" class="btn btn-awaanbluebtn btn-viewall" id="loadmore"  data-category-id="" data-category-offset="2">{{ trans('content.whole.show_more') }}</a>
                            </div>
                        @endif
                        @if(isset($videoDetailedAflam->related) && !empty($videoDetailedAflam->related) && count($videoDetailedAflam->related) > 0)
                                <div class="title-section">
                                    <h3>{{ trans('content.whole.related_movies') }}</h3>
                                </div>
                                <div class="content-div">
                                    <div class="row" id="related-episode-container">
                                        <?php
                                        $video_hover['desc'] = $video_hover['category'] = '' ?>
                                            @foreach($videoDetailedAflam->related as $item)
                                                @if(Session::get('lang') == 'ar')
                                                    <?php
                                                    $video_hover['videotitle'] = $item->title_ar;
                                                    //  $video_hover['category']=$currentseasons->shows_parent[0]->title_ar;
                                                    ?>
                                                    <?php
                                                    $url = URL::to('video/'.$item->id.'/'.rawurlencode(\App\Helpers\Functions::cleanurl($item->title_ar)));
                                                    $url2 = URL::to('video/'.$item->id.'/'.\App\Helpers\Functions::cleanurl($item->title_ar));
                                                    $title = $item->title_ar;
                                                    ?>
                                                @else
                                                    <?php $video_hover['videotitle'] = $item->title_en;
                                                    //  $video_hover['category']=$currentseasons->shows_parent[0]->title_en;
                                                    ?>
                                                    <?php
                                                    $url = URL::to('video/'.$item->id.'/'.rawurlencode(\App\Helpers\Functions::cleanurl($item->title_en)));
                                                    $url2 = URL::to('video/'.$item->id.'/'.\App\Helpers\Functions::cleanurl($item->title_en));
                                                    $title = $item->title_en;
                                                    ?>
                                                @endif
                                                <?php
                                                //  $url = route('video', [$item->id, $item->title_ar]);
                                                $img = config('mangoapi.mangodcn') . $item->img;
                                                ?>

                                                <div class="col-md-3 col-sm-3 col-xs-6 video-col">
                                                    <a href="{{$url2}}?">
                                                        <p style="display: none">{{$title}}</p>
                                                        <div class="img-div">
                                                            {{--<img src="{{$img}}" class="img-responsive center-block" />--}}
                                                            <div class="embed-responsive-item image-div lazy-image-handler aflam-image2" data-src="{{$img}}"  style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                                        </div>
                                                    </a>
                                                    <div class="content">
                                                        <a href="#" class="title-link">{{$title}}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                    </div>
                                </div>

                        @endif

                    </div>
                    <div class="col-md-3 sm-detail-div">
                        <div class="mpu-wrapper">
                            @include('videos.mpu_video')
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- CONTAINER [END]	-->
    </div>

    <div class="modal fade" id="offset_modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #2e2e2e">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="title-embed">{{trans('content.whole.embed')}}</div>
                    <div class="form-group">
                        <label for="offset_url" class="hidden">offset url</label>
                        <textarea id="offset_url" title="Embed URL" class="offset_url well text-left"
                                  style="width: 100%" readonly></textarea>
                    </div>
                    <div style="width: 100%;">
                        <div class="title-copy">{{trans('content.whole.embed_copy')}}</div>
                        <div class="form-group btn-group-time">
                            <label for="offset_inside" class="label-start">{{trans('content.video.startat')}} </label>
                            <input  class="input-sm" type="text" id="offset_inside" name="offset"
                                    style=" font-size:10pt; max-width:75px">
                            <button type="button" class="btn btn-awaanbluebtn"
                                    id='generateurl'>{{trans('content.video.getoffseturl')}}</button>
                            <button type="button"
                                    class="btn btn-awaanbluebtn share_url_copy">{{trans('content.video.selectall')}} </button>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-default"--}}
                            {{--data-dismiss="modal">{{trans('content.video.close')}}</button>--}}
                    {{--<button type="button"--}}
                            {{--class="btn btn-default share_url_copy">{{trans('content.video.selectall')}} </button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>



    <!-- VIDEO WRAPPER [END]	-->
    @include('videos.get_videoembedd_modal',['embed'=>$content->embed,'vid'=>$content->id,'video'=>$content,'videosignature'=>$videosignature])
@endsection
@section("additional_scripts")
    <script  type="text/javascript">
        function secondsTimeSpanToHMS(s) {
            var h = Math.floor(s / 3600); //Get whole hours
            s -= h * 3600;
            var m = Math.floor(s / 60); //Get remaining minutes
            s -= m * 60;
            return h + ":" + (m < 10 ? '0' + m : m) + ":" + (s < 10 ? '0' + s : s); //zero padding on minutes and seconds
        }
        jQuery(document).ready( function() {

            $('#generateurl').on('click', function () {
//                offset_attr.css({'background': 'white'});

                if (offset_attr) {
                    var offset_val = offset_attr.val();

                    var a = offset_val.split(':'); // split it at the colons
                    var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);

                    if (seconds > offset_seconds) {
                        offset_attr.css({'background': 'red'});
                    } else {

                        var offset_video_url = window.location.href.split('?')[0];

                        $(".offset_url").html(offset_video_url + "?t=" + seconds);


                    }

                    // var height = '100%';
                }
            });
            var offset_seconds = "{{$content->duration}}";
            console.log('offset second' + offset_seconds);

            var offset_limit = secondsTimeSpanToHMS(offset_seconds);
            console.log('offset_limit' + offset_limit);
            var offset_attr = $("#offset_inside");
            offset_attr.mask("99:99:99");
            offset_attr.val(offset_limit);

            jQuery('.btn-favourite').click(function (e) {
            console.log('add');
            var htmltext = '';
            if(jQuery(this).hasClass('active-fav')) {
            jQuery(this).find('img').attr('src','{{asset('images/icon-fav.png')}}');
            jQuery(this).removeClass('active-fav');

            } else {
                jQuery(this).find('img').attr('src','{{asset('images/icon-fav-active.png')}}');
            jQuery(this).addClass('active-fav');
            }
            jQuery.post("//admin.mangomolo.com/analytics/index.php/plus/favor", {
            faved_id: jQuery(this).data('id'),
            channel_userid: jQuery(this).data('channeluserid'),
            user_id: 71
            }).done(function (data) {
                console.log(data);
            });
            });

            $(".get_offset").on('click', function () {
                $('#offset_modal').modal('show');
                $('#offset_modal').on('shown.bs.modal', function () {
                    $(".share_url_copy").click(function () {
                        $('.offset_url').focus().select();
                    });
                });


            });

            var offset = 1;
            jQuery('body').on('click','#loadmore', function(e) {
                console.log('offset' + offset);
                jQuery.ajax({
                    type: "GET",
                    url: "{{URL::to("video/".Request::segment(2)."/".Request::segment(3))}}",
                    data: {
                        p: offset,
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
                        // $('#loader-icon').hide();
                    },
                    success: function(data){
                        console.log('count: ' +data['count']);
                        if(data['count'] >= 6){
                            console.log('inside');
                            jQuery('#related-episode-container').append(data['html']);
                            offset = Number(offset) + 1;
                        }else{
                            console.log('not inside');
                            jQuery('#related-episode-container').append(data['html']);
                            jQuery('#loadmore').css('display','none');
                        }
                        setTimeout(function() {
                            $("body").getNiceScroll().resize();
                        }, 1000);
                        jQuery('[data-toggle="popover"]').popover();
                    },
                    error: function(){}
                });
                return false;
            });

        });

    </script>
@endsection

