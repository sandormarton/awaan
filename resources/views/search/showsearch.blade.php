<div class="drama-list-wrapper dcnawaansearch-wrapper">
    <?php $num = count($shows)?>
    <h3 class="module-title">{{$num}} {{ trans('content.whole.programs') }} </h3>
    <div class="row ">

        @foreach($shows  as $item)
        <?php
        $img = config('mangoapi.mangodcn').$item->cover;
        ?>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
            <div class="drama-box">
                <?php
                $url = route('show', [$item->id, ($item->title_ar)]);
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