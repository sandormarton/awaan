<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/26/2017
 * Time: 4:24 PM
 */
?>
@if(isset($audio_list) && is_array($audio_list) && count($audio_list) > 0)
    @foreach($audio_list as $item)
        <?php
            $img = "";
            $img=((!empty($content->cat->cover))?config('mangoapi.mangodcn').$content->cat->cover:asset("images/cover-not-available.jpg"));
            if(!empty($item->img)) $img = config('mangoapi.mangodcn').$item->img;
        ?>
        <div class="media">
            <div class="media-left">
                @if(isset($need_links) && $need_links == "yes")
                    <a href="{{URL::to("radio/audio/{$current_channel->id}/{$item->id}/".\App\Helpers\Functions::cleanurl((Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en))}}" data-id="{{$item->id}}" data-signature="{{$item->signature}}">
                @else
                    <a href="#" class="audio_media" onclick="return false;" data-id="{{$item->id}}" data-signature="{{$item->signature}}">
                @endif
                        <p style="display: none;">{{$item -> title_en}}</p>
                    <div class="media-object embed-responsive-item image-div lazy-image-handler" data-src="{{$img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');background-size: cover;
                            background-position: top center;
                            background-repeat: no-repeat;
                            height: 108px;
                            width: 192px;"></div>
                    <div class="overlay">
                        <img src="{{asset("images")}}/icon-play.png" alt="play icon" />
                    </div>
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">
                    @if(isset($need_links) && $need_links == "yes")
                        <a href="{{URL::to("radio/audio/{$current_channel->id}/{$item->id}/".\App\Helpers\Functions::cleanurl((Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en))}}" data-id="{{$item->id}}" data-signature="{{$item->signature}}">
                    @else
                        <a href="#" class="audio_media" onclick="return false;" data-id="{{$item->id}}" data-signature="{{$item->signature}}">
                    @endif
                        {{(Session::get('lang') == 'ar')?$item->title_ar:$item->title_en}}
                    </a>
                </h4>
                <p>{{(Session::get('lang') == 'ar')?$item->description_ar:$item->description_en}}</p>
            </div>
        </div>
    @endforeach
@endif
