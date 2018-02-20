<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 2/19/2018
 * Time: 11:16 AM
 */
?>
<div class="shows-list-wrapper dcnawaansearch-wrapper" id="radio-search" style="display: none;">

    <div class="row">

        @foreach($audios  as $item)
            <?php
            $img = config('mangoapi.mangodcn').((!empty($item->img))?$item->img:$item->cat_thumbnail);
            //URL::to("radio/audio/{$current_channel->id}/{$item->id}/".\App\Helpers\Functions::cleanurl((Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en))
            $url = URL::to("radio/audio/{$item->ch_id}/{$item->id}/".\App\Helpers\Functions::cleanurl((Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en));
            ?>
            <?php
            if(Session::get('lang') == 'en'){
                $title = $item->title_en;
            }else{
                $title = $item->title_ar;
            }
            ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 shows-video-col">
                <a href="{{$url}}">
                    <p style="display: none">{{$title}}</p>
                    <div class="img-div scaleZoomImg">
                        {{--<img alt="{{$title}}" src="{{$img}}" class="img-responsive center-block" />--}}
                        <div class="embed-responsive-item image-div video lazy-image-handler" data-src="{{$img}}"  style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                    </div>
                </a>
                <div class="content">
                    <a href="{{$url}}" class="title-link kh-ellipsis">{{$title}}</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

