<div class="drama-list-wrapper dcnawaansearch-wrapper">
    <?php $num = count($shows);
    die('count: ' .$num);
    ?>

    <h3 class="module-title">{{$num}} {{ trans('content.videos_favorites_rows.videos') }} </h3>
    <div class="row">

        @foreach($videos  as $item)
        <?php
        $img = config('mangoapi.mangodcn').$item->img;
        ?>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
            <div class="drama-box">
                <?php
                $url = route('video', [$item->id, ($item->title_ar)]);
                ?>
                <a href="{{$url}}"><img src="{{$img}}" class="img-responsive center-block" title="{{$item->title_ar}}" alt="{{$item->title_ar}}" /></a>
                <div class="drama-content">
                    <a href="{{$url}}" class="drama-title"> {{str_limit($item->title_ar,18)}}</a>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>