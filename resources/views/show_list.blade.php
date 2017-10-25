<?php
/**
 * Created by PhpStorm.
 * User: Bo Krma
 * Date: 9/13/2017
 * Time: 1:22 PM
 */

?>
<?php $counter = 1;
$video_hover['desc']=$video_hover['category']='';
//            if(isset($currentshow->shows_parent) && is_array($currentshow->shows_parent) && $currentshow->shows_parent[0]){
//                (Session::get('lang') == 'ar') ? $video_hover['category']=$currentshow->shows_parent[0]->title_ar : $video_hover['category']=$currentshow->shows_parent[0]->title_en;
//            }
?>
@if (count($content->videos) > 0)
@foreach($content->videos as $item)
<?php
if(isset($item->description_ar) && !empty($item->description_ar) && (Session::get('lang') == 'ar') ){
    $video_hover['desc']=$item->description_ar;
}
?>
@if(Session::get('lang') == 'ar')
<?php
$video_hover['videotitle']= $item->title_ar;
?>

@else
<?php
$video_hover['videotitle']= $item->title_en;
if(isset($item->description_en) && !empty($item->description_en)){
    $video_hover['desc']=$item->description_en;
}
?>

@endif

<?php

$img = config('mangoapi.mangodcn').$item->img;
if($counter == 4) {

}
$url = route('video', [$item->id, \App\Helpers\Functions::cleanurl($item->title_ar)]);
$share_url = route('video', [$item->id, rawurlencode(\App\Helpers\Functions::cleanurl($item->title_ar))]);
?>
<div class="col-md-3 col-sm-4 col-xs-6 showpage-video-col">
    <a href="{{$url}}?">
        <div class="img-div scaleZoomImg">
            <!--<img src="{{$img}}" class="img-responsive center-block" />-->
            <div class="embed-responsive-item image-div lazy-image-handler  @if($catid == 208109 ) aflam-image @endif" style="background-image: url('{{$img}}');"></div>
            <div class="show-time-showpagelist">
                <span>{{gmdate("H:i:s", $item->duration)}}</span>
            </div>
        </div>
    </a>
    <div class="content">
        <a href="{{$url}}?" class="title-link">{{$item->title_ar}}</a>
    </div>
</div>
<?php $counter++?>
@endforeach
@endif
