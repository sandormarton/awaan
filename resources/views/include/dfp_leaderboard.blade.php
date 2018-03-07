<div class="leaderboard-wrappper text-center collapse in" id="TopLeaderboardCollapse">
    <div class="container">
        <button class="btn btn-leaderboard-close pull-right" type="button" data-toggle="collapse" data-target="#TopLeaderboardCollapse" aria-expanded="false" aria-controls="TopLeaderboardCollapse">{{ trans('content.whole.close_add') }} [<i class="fa fa-times"></i>]</button>


        <?php
            $apiobj = new \App\Providers\ApiRequest();
            if(ends_with(Route::currentRouteAction(), 'Shows@index')){
                $id = Request::segment(2);
                $ads = $apiobj->getSuggested($id, 0, 'verify');
            }elseif(ends_with(Route::currentRouteAction(), 'Video@watch')){
                $id = Request::segment(2);
                $ads = $apiobj->getSuggested(0, $id, 'verify');
            }else{
                $ads = $apiobj->getAds(0, 0);
            }
            if(isset($ads)){
                $ads = end($ads);
                if($ads->channel_type == 'all' and $ads->ad_type== 'double_click'  and $ads->companion == 1){
                    $google_doubleclick = str_replace("correlator=","correlator=".time(),$ads->google_doubleclick);
                    $google_doubleclick = urlencode($google_doubleclick);
                    echo '<iframe src="http://admin.mangomolo.com/analytics/index.php/dfp?size=728&url='.$google_doubleclick.'" width="728" height="90" scrolling="no" frameborder="0" style="border: 0;"></iframe>';
                }else{
                    echo $ads->google_doubleclick728;
                }
            }
        ?>

        @if(
            ends_with(Route::currentRouteAction(), 'Home@index') ||
            ends_with(Route::currentRouteAction(), 'Shows@index') ||
            ends_with(Route::currentRouteAction(), 'Search@fullSearch') ||
            ends_with(Route::currentRouteAction(), 'News@GetRelatedNews') ||
            ends_with(Route::currentRouteAction(), 'Categories@index') ||
            ends_with(Route::currentRouteAction(), 'Premium@index') ||
            ends_with(Route::currentRouteAction(), 'Shows@GetAllShows') ||
            ends_with(Route::currentRouteAction(), 'Shows@FetchAllShows') ||
            ends_with(Route::currentRouteAction(), 'Categories@GetChannels') ||
            ends_with(Route::currentRouteAction(), 'News@index') ||
            ends_with(Route::currentRouteAction(), 'Categories@getChannelRelatedShows') ||
            ends_with(Route::currentRouteAction(), 'Series@CategorySeries')
        )
                <script type='text/javascript'>
                    googletag.cmd.push(function () {
                        googletag.pubads().refresh();
                    });
                </script>
        @endif
    </div>
</div>
