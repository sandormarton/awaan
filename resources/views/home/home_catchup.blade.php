<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/13/2017
 * Time: 10:48 AM
 */
?>
<div id="catchup-carousel" class="owl-carousel data-carousel catchup-carousel">
    @if(isset($catchup_items) && is_array($catchup_items))
        @foreach($catchup_items as $item)
            <?php
                if(isset($item->channel_title) && !empty($item->channel_title)){
                    $channel_title = $item->channel_title;
                }else{
                    $channel_title = 'Channel';
                }
            ?>
            {{--*/ $img = $item->catchup_img;/*--}}
            {{--*/ $live_icon = config('mangoapi.mangodcn').$item->live_icon;/*--}}
            {{--*/ $img_encoded = base64_encode($item->catchup_img);/*--}}
            {{--*/ $img1 = URL::to("/getImg/$img_encoded"); /*--}}
            <div class="item">
                <a href="{{URL::to("catchup/{$item->channel_id}/".\App\Helpers\Functions::cleanurl($channel_title) ."/" . $item->id)}}">
                    <div class="data-image">
                    	<div class="embed-responsive-item img-div" style="background-image: url('{{$img}}');"></div>
                        <!--<img src="{{$img}}" />-->
                        <div class="overlay"></div>
                    </div>
                    <div class="media data-title">
                        <div class="media-left channel-logo">
                            <img class="media-object" src="{{$live_icon}}" alt="{{$item->channel_title}}">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading program-title">{{$item->title_ar}}</h4>
                            <span class="program-time">{{\App\Helpers\Functions::convertFormat($item->first_start)}}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    @endif
</div>
