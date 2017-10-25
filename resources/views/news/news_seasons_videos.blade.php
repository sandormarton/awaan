<div class="row">
    @foreach($season_videos as $item)
    <?php
    $img = config('mangoapi.mangodcn').$item['img'];

//    $url = route('video', [$item['id'], $item['title_ar']]);
    ?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
        <div class="episode-box">
            <div class="episode-img">
                <a href="{{URL::to('video/'.$item['id'].'/'.\App\Helpers\Functions::cleanurl($item['title_ar']))}}" title="{{($item['title_ar'])}}"><img src="{{$img}}" data-src="{{$img}}" class="load-onscroll img-responsive" title="{{$item['title_ar']}}" alt="{{$item['title_ar']}}"/></a>
                <div class="episode-duration">{{gmdate("H:i:s", $item['duration'])}}</div>
                <div class="episode-hover"><a href="{{URL::to('video/'.$item['id'].'/'.\App\Helpers\Functions::cleanurl($item['title_ar']))}}"><i class="ion-play"></i></a><span class="hidden">Play</span></div>
            </div>
            <div class="episode-content giveMeEllipsis">
                <a href="{{URL::to('video/'.$item['id'].'/'.\App\Helpers\Functions::cleanurl($item['title_ar']))}}" title="{{($item['title_ar'])}}">{{($item['title_ar'])}}</a>
            </div>
        </div>
    </div>


    @endforeach
</div>

<script>
    jQuery(document).ready(function () {
        $(".load-onscroll").unveil(200, function () {
            $(this).load(function () {
                this.style.opacity = 1;
            });
        });

    });
</script>