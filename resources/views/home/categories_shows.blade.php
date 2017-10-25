<div id="cateogries-videos-list" class="content-module-video-list cateogries-videos-list">

    @foreach($categ_shows as $item)
    @if(@empty($item->cover))
    @continue
    @endif
    <div class="item video-list-div">
        <?php $img = config('mangoapi.mangodcn').$item->cover?>
        <div class="video-list-item">
            <div class="video-list-image" style="height:218px; width: 640px;  background: url('{{$img}}') no-repeat scroll 0 0 / cover ;  background-position:left top;">

            </div>
            <div class="video-list-content">
                <div class="video-details">
                    <label class="video-title"><a href="#">{{$item->title_ar}}</a></label>
                    <!--                <label class="video-category">no seasons</label>-->
                </div>
                <div class="video-show-likes">
                    <a class="share-btn" href="javascript:void(0)">
                        <i class="ion-android-share-alt"></i>
                    </a>
                    680
                </div>
            </div>
            <div class="overlay-bg"></div>
        </div>

    </div>
    @endforeach
</div>
