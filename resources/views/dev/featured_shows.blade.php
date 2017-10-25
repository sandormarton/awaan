<?php $counterdiv = $counterdiv2 = 1;?>
@foreach ($header_content as $item)

<?php $img = config('mangoapi.mangodcn').$item['thumbnail']?>
<div class="item video-list-div">
    <?php
    if($counterdiv == 4) {
        echo '</div><div class="item video-list-div">';
        $counterdiv = $counterdiv2 = 1;
    }
    $counterdiv++;
    ?>
    <div class="video-list-item">
        <?php
        if($counterdiv2 == 2) {
            echo '</div>    <div class="video-list-item">';
            $counterdiv2 = 1;
        }
        $counterdiv2++;
        ?>
        <div class="video-list-image">

            <img src="{{$img}}"/>
        </div>
        <div class="video-list-content">
            <div class="video-details eng-text">
                <label class="video-title">
                    <?php
                    $url = route('show', [$item['id'], ($item['title_ar'])]);
                    ?>
                    <a href="{{$url}}"/>
                    {{$item['title_ar']}}
                    </a>
                </label>
                <label class="video-category">{{$item['cat_title']}}</label>

            </div>
            <div class="video-show-likes">
                <a class="share-btn" href="javascript:void(0)">
                    <i class="ion-android-share-alt"></i>
                </a>
                <!--                459-->
            </div>
        </div>
        <div class="overlay-bg"></div>

    </div>


</div>
@endforeach