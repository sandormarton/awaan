<?php

//Get the site Base url
$baseurl = \URL::current();
$item_title = \App\Helpers\Functions::cleanurl($content->title_ar);

//if($videodetails['pagesource'] == 'programs') {
//    $url = base_url().'programs/shows/'.$this->cleanurl($videodetails['title_ar']).'/'.$videoid;
//}

$share_link = substr($baseurl, 0,strrpos($baseurl, '/')).'/'.$item_title;

if(empty($content->title_ar) && empty($content->id) && empty($content->description_ar)) {
    $videoid = $content->title_ar = $content->description_ar = null;
}
$content->description_ar = (!isset($content->description_ar)) ? $content->cat_description : $content->description_ar;
$desc = str_replace('"', '', $content->description_ar);
$desc = str_limit($desc,200);
$current_title = str_replace('"', '', $content->title_ar);
$current_title = str_limit($current_title,65);
?>

<meta property="og:site_name" content="http://awaan.ae/"/>
<meta property="og:type" content="article" />
<meta property="og:title" content="<?=$current_title?>"/>
<meta property="og:url" content="<?=$share_link?>" />
<meta property="og:description" content="<?=(!empty($desc))?$desc:$current_title?>"/>
@if(isset($content -> meta_image) && !empty($content -> meta_image))
    <meta property="og:image" content="{{$content -> meta_image}}" />
@else
    <meta property="og:image" content="http://admin.mangomolo.com/analytics/index.php/share/internal_image?id={{$content->id}}" />
@endif

<meta name="twitter:site" content="@OnAwaan" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?=$current_title?>" />
<meta name="twitter:description" content="<?=(!empty($desc))?$desc:$current_title?>" />
<meta name="twitter:text:description" content="<?=(!empty($desc))?$desc:$current_title?>">
@if(isset($content -> meta_image) && !empty($content -> meta_image))
    <meta name="twitter:image" content="{{$content -> meta_image}}" />
@else
<meta name="twitter:image" content="http://admin.mangomolo.com/analytics/index.php/share/internal_image?id={{$content->id}}&wowzaip=dmi.mangomolo.com&text=http://awaan.ae/" />
@endif
{{--*/ !empty($content->meta_keywords) ? $keywords=$content->meta_keywords : $keywords=$meta /*--}}

 <meta name="keywords" content="<?=str_replace('"', '', $keywords)?>" />
<meta name="description" content="<?=(!empty($desc))?$desc:$current_title?>">

@if(isset($content->parent_id))
<script type="text/javascript">
    {{--*/ isset($content->show_id) ? $showid=$content->show_id : $showid=$content->cat_id/*--}}
    var show_id = '{{$showid}}';
</script>
@endif
