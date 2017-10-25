<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/19/2017
 * Time: 3:18 PM
 */
?>
@if(isset($content) && isset($content->shows) && is_array($content->shows))
    @foreach($content->shows as $item)
        <?php
            if(Session::get('lang') == 'ar'){
                $title = $item ->  title_ar;
            }else{
                $title = $item -> title_en;
            }
        ?>
        {{--*/ $img = (!empty($item->thumbnail))?config('mangoapi.mangodcn').$item->thumbnail:asset("images/image-not-available.jpg");/*--}}
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="program-div scaleZoomImg">
                <a href="{{URL::to("radio/show/{$current_channel->id}/{$item->id}/".\App\Helpers\Functions::cleanurl((Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en))}}?">
{{--                    <img src="{{$img}}" class="img-responsive" alt="{{$title}}"/>--}}
                    <p style="display: none">{{(Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en}}</p>
                    <div class="embed-responsive-item image-div lazy-image-handler" data-src="{{$img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                </a>
                <div class="content-div radio">
                    <a href="{{URL::to("radio/show/{$current_channel->id}/{$item->id}/".\App\Helpers\Functions::cleanurl((Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en))}}" class="program-title">{{((Session::get('lang') == 'ar')?$item -> title_ar:$item -> title_en)}}</a>
                    @if(isset($item->show_times) && is_array($item->show_times) && count($item->show_times) > 0)
                        @foreach($item->show_times as $time)
                            <span class="timing-span">UAE - {{\App\Helpers\Functions::convertFormat($time->show_time)}}</span>
                            <span class="timing-span border">GMT - {{\App\Helpers\Functions::convertToGMTime($time->show_time)}}</span>
                            <p class="fequency">{{trans('content.radio.view')}} - {{trans('content.radio.'.$time->day)}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@endif
