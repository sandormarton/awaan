<?php
/**
 * Created by PhpStorm.
 * User: Bo Krma
 * Date: 9/13/2017
 * Time: 1:22 PM
 */
?>
@foreach($content as $item)

    @if(!empty($item->title_ar))
        <?php
        if(isset($item->thumbnail)) {
            $img = config('mangoapi.mangodcn').$item->thumbnail;
        }
        elseif(isset($item->img)) {
            $img = config('mangoapi.mangodcn').$item->img;
        }
        ?>
        <?php
        if(Session::get('lang') == 'en'){
            $title = $item->title_en;
        }else{
            $title = $item->title_ar;
        }
        ?>
        <div class="col-md-3 col-sm-4 col-xs-6 shows-video-col">
            <?php
            if($catid == 208109 ){
                $url = URL::to("movie/{$item->id}/".\App\Helpers\Functions::cleanurl("{$title}"));
            }else{
                $url = URL::to("{$other_content['route']}/{$item->id}/".\App\Helpers\Functions::cleanurl("{$title}"));
            }
                    ?>
            <a href="{{$url}}">
                <p style="display: none">{{$title}}</p>
                <div class="img-div scaleZoomImg">
                    {{--<img alt="{{$item->title_ar}}" src="{{$img}}" class="img-responsive center-block" />--}}
                    <div class="embed-responsive-item image-div lazy-image-handler   @if($catid == 208109 ) aflam-image @endif" data-src="{{$img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                </div>
            </a>
            <div class="content">
                <a href="#" class="title-link">{{$title}}</a>
            </div>
        </div>
    @endif
@endforeach