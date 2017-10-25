{{--<a class="leaderboard-collapse-btn" role="button" data-toggle="collapse" href="#leaderboardCollapse" aria-expanded="false" aria-controls="leaderboardCollapse">[x] {{trans('home.close_ad')}}</a>--}}
<div id="leaderboardCollapse" class="collapse in leaderboard-wrapper text-center mpu-editable">
    <?php
    $apiobj = new \App\Providers\ApiRequest();
    if(ends_with(Route::currentRouteAction(), 'Shows@index')){
        $id = Request::segment(2);
        $ads = $apiobj->getAds($id, 0, 'verify');
    }elseif(ends_with(Route::currentRouteAction(), 'Video@watch')){
        $id = Request::segment(2);
        $ads = $apiobj->getAds(0, $id, 'verify');
    }else{
        $ads = $apiobj->getAds(0, 0);
    }

    if(isset($ads) and $ads != false){
        $ads = end($ads);
        if($ads->channel_type == 'all' and $ads->ad_type== 'double_click'  and $ads->companion == 1){
            $google_doubleclick = str_replace("correlator=","correlator=".time(),$ads->google_doubleclick);
            $google_doubleclick = urlencode($google_doubleclick);
            echo '<iframe src="http://admin.mangomolo.com/analytics/index.php/dfp?size=300&url='.$google_doubleclick.'" width="278" height="250" scrolling="no" frameborder="0" style="border: 0;"></iframe>';
        }else{
            echo $ads->google_doubleclick300;
        }
    }
    ?>

</div>
