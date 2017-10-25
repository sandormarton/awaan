<?php
$baseurl = url('/');
if(isset($shortenurl) && !empty($shortenurl)){
    $current_url = $shortenurl;
}else
    $current_url = route('video', [$content->id, \App\Helpers\Functions::cleanurl($content->title_ar)]);
//$current_url = $baseurl.'/video/'.$content->id.'/'.\App\Helpers\Functions::cleanurl($content->title_ar);
?>

<a class=" btn hidden-lg hidden-md hidden-sm" href="whatsapp://send?text={{$current_url}}!" data-action="share/whatsapp/share">
    <img src="{{ asset("images/whatsapp.png")}}" alt="whatsapp"/>
</a>

<a href="https://twitter.com/intent/tweet?url={{$current_url}}&via=OnAwaan" data-share-url="{{($current_url)}}" data-share-type="twitter" target="_blank" class="btn btn-info" style="background: #3399CC !important;border-color: #3399CC;color: white;padding: 2px 12px;margin: 10px;border-radius: 8px !important;">
    غرد<i class="fa fa-twitter"></i>
</a>

<a href="https://www.facebook.com/sharer/sharer.php?u={{$current_url}}" data-share-url="{{($current_url)}}" data-share-type="facebook" target="_blank" class="btn btn-info" style="background: #4267b2 !important;border-color: #4267b2;color: white;padding: 2px 12px;margin: 10px;border-radius: 8px !important;">
    Share <i class="fa fa-facebook"></i>
</a>