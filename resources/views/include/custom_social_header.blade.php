<?php
$current_title = str_replace('"', '', $current_title);
$current_title = str_limit($current_title,160);

$current_description = str_replace('"', '', $current_description);
$current_description = str_limit($current_description,160);

if(empty($current_description)){
    $current_description = $current_title;
}
if(!isset($keywords) || empty($keywords)){
    $keywords = $current_description;
}
?>
<meta property="og:site_name" content="http://awaan.ae/"/>
<meta property="og:type" content="article" />
<meta property="og:title" content="<?=$current_title?>"/>
<meta property="og:url" content="<?=urldecode(\URL::current())?>" />
<meta property="og:description" content="{{$current_description}}"/>
@if(isset($current_image) && !empty($current_image))
    <meta property="og:image" content="{{$current_image}}" />
@else
    <meta property="og:image" content="{{asset("images/logo-2.png")}}" />
@endif

<meta name="twitter:site" content="@OnAwaan" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?=$current_title?>" />
<meta name="twitter:description" content="{{$current_description}}" />
<meta name="twitter:text:description" content="{{$current_description}}">
@if(isset($current_image) && !empty($current_image))
    <meta name="twitter:image" content="{{$current_image}}" />
@else
    <meta name="twitter:image" content="{{asset("images/logo-2.png")}}" />
@endif

<meta name="keywords" content="<?=str_replace('"', '', $keywords)?>" />
<meta name="description" content="{{$current_description}}">