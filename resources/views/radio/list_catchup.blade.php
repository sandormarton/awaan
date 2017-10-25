<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/18/2017
 * Time: 11:14 AM
 */
?>
@if(sizeof($catchup))
    @foreach($catchup as $item)
        @php
            $img = "";
            $img=(!empty($item->cat_thumbnail))
                ?config('mangoapi.mangodcn').$item->cat_thumbnail:$item->schedule_img;

            //try to add suffix.
            if($current_channel->id == "84" && empty($item->cat_thumbnail) && !\App\Helpers\Functions::isValidURL($img))
                $img = "http://www.dmi.ae/noordubai/".$img;

            $img = (\App\Helpers\Functions::isImageFile($img) and \App\Helpers\Functions::isValidURL($img))
            ? $img : asset("images/image-not-available.jpg");
        @endphp
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="program-div scaleZoomImg">
                <a href="#">
                    {{--<img src="{{$img}}" class="img-responsive" />--}}
                    <div class="embed-responsive-item image-div lazy-image-handler"  data-src="{{$img}}"  style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                </a>
                <div class="content-div radio">
                    <a href="#" class="program-title audio_media" data-id="{{$item->id}}" data-signature="{{$item->signature}}"><span><i class="fa fa-play-circle"></i></span>&nbsp; {{$item->title_en}}</a>                    <span class="timing-span">UAE - {{\App\Helpers\Functions::convertFormat($item->start_time)}}</span>
                    <span class="timing-span border">GMT - {{\App\Helpers\Functions::convertToGMTime($item->start_time)}}</span>
                </div>
            </div>
        </div>
    @endforeach
@else
    @if(isset($page) && $page == 1)
        <h3>{{ trans('content.whole.no_result_found') }}</h3>
    @endif
@endif
