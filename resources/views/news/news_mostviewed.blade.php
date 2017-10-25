<div class="item">
    <?php $counter = 0;?>
    @foreach($news_mostviewed as $id=>$news)
    @break($counter == 24)
    <?php
    $news->news_date = Carbon\Carbon::parse($news->recorder_date)->format('d-m-Y');

    $img = config('mangoapi.mangodcn').$news->img;
    ?>
    <div class="news-player-extra-items-div">
        <div class="episode-img">
            <a href="{{URL::to('news/videos/'.$news->id.'/'.\App\Helpers\Functions::cleanurl($news->title_ar))}}" title="{{($news->title_ar)}}">
                <img src="{{$img}}" class="img-responsive" alt="{{$news->title_ar}}" />
                <span class="episode-hover"><i class="glyphicon glyphicon-chevron-up" style="color: #318dcc;"></i></span>
            </a>
        </div>
        <div class="episode-content">
            <p class="giveMeEllipsis">{{($news->title_ar)}}</p>
            <span>{{$news->news_date}}</span>
        </div>
    </div>
    <?php
    echo'</div><div class="item">';

    $counter++;
    ?>
    @endforeach

</div>
<script>
    $(function () {

        $('.owl-item cloned active').owlCarousel({
            margin: 10,
            loop: true,
            autoWidth: true,
                items: 5
        })

    });

</script>
