<?php
$img = config('mangoapi.mangodcn').$news->img;
?>
<div class="item news-player-extra-items-div">
    <div class="episode-img">
        <a href="{{URL::to('news/videos/'.$news->id.'/'.\App\Helpers\Functions::cleanurl($news->title_ar))}}" title="{{$news->title_ar}}">
            <img src="{{$img}}" class="img-responsive" alt="{{$news->title_ar}}"/>
            <span class="episode-duration">0:39:26</span>
            <span class="episode-hover"><i style="color: #318dcc;" class="glyphicon glyphicon-chevron-up"></i></span>
        </a>
    </div>
    <div class="episode-content">
        <p class="giveMeEllipsis">{{str_limit($news->title_ar,30)}}</p>
        <span>{{$news->news_date}}</span>
    </div>
</div>
