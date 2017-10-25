<?php
$img = config('mangoapi.mangodcn').$news->img;
//$news_date = \Carbon\Carbon::parse($news->recorder_date)->format('D-M-m-Y');
?>
<div class="col-md-12 col-sm-12 col-xs-6">
    <div class="item news-playlist-div">
        <a href="#" title="{{$news->title_ar}}">
            <img src="{{$img}}" class="img-responsive" alt="{{$news->title_ar}}" />
        </a>
        <div class="news-playlist-hover">
            <a href="{{URL::to('news/videos/'.$news->id.'/'.\App\Helpers\Functions::cleanurl($news->title_ar))}}" data-title="{{$news->title_ar}}" title="{{$news->title_ar}}" id='newsvideo_{{$news->id}}' data-date="{{$news->news_date}}" data-embedd='{{$news->embed}}'><i class="ion-play"></i>{{ trans('content.live') }}</a>
        </div>
        <div class="news-playlist-content giveMeEllipsis">
            <h2>{{str_limit($news->title_ar,40)}}</h2>
            <span>{{$news->news_date}}</span>
        </div>
    </div>
</div>