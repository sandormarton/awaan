
    <?php
    $video_hover['desc'] = $video_hover['category'] = '' ?>
    @if(!empty($currentseasons) && isset($currentseasons->videos) && is_array($currentseasons->videos) && sizeof($currentseasons->videos) > 0)
    @foreach($currentseasons->videos as $item)
    @if(Session::get('lang') == 'ar')
    <?php
    if(isset($currentseasons->shows_parent) and !empty($currentseasons->shows_parent) and isset($currentseasons->shows_parent[0]) and !empty($currentseasons->shows_parent[0]) and isset($currentseasons->shows_parent[0]->title_ar) and !empty($currentseasons->shows_parent[0]->title_ar)){
        $cat = $currentseasons->shows_parent[0]->title_ar;
    }
    if (isset($item->description_ar) && !empty($item->description_ar)) {
        $video_hover['desc'] = $item->description_ar;
    }
    $video_hover['videotitle'] = $item->title_ar;
    //  $video_hover['category']=$currentseasons->shows_parent[0]->title_ar;
    ?>
    @if(isset($currentseasons->shows_parent[0]->title_ar))
    <?php  $video_hover['category'] = $currentseasons->shows_parent[0]->title_ar?>
    @endif
    <?php
    $url = URL::to('video/'.$item->id.'/'.rawurlencode(\App\Helpers\Functions::cleanurl($item->title_ar)));
    $url2 = URL::to('video/'.$item->id.'/'.\App\Helpers\Functions::cleanurl($item->title_ar));
    $title = $item->title_ar;
    ?>
    @else
    <?php $video_hover['videotitle'] = $item->title_en;
    $video_hover['desc'] = (isset($item->description_en) && !empty($item->description_en)) ? $item->description_en : false;

    if(isset($currentseasons->shows_parent) and !empty($currentseasons->shows_parent) and isset($currentseasons->shows_parent[0]) and !empty($currentseasons->shows_parent[0]) and isset($currentseasons->shows_parent[0]->title_en) and !empty($currentseasons->shows_parent[0]->title_en)){
        $cat = $currentseasons->shows_parent[0]->title_en;
    }
    //  $video_hover['category']=$currentseasons->shows_parent[0]->title_en;
    ?>
    @if(isset($currentseasons->shows_parent[0]->title_en))
    <?php $video_hover['category'] = $currentseasons->shows_parent[0]->title_en?>
    @endif
    <?php
    $url = URL::to('video/'.$item->id.'/'.rawurlencode(\App\Helpers\Functions::cleanurl($item->title_en)));
    $url2 = URL::to('video/'.$item->id.'/'.\App\Helpers\Functions::cleanurl($item->title_en));
    $title = $item->title_en;
    ?>
    @endif
    <?php
    //  $url = route('video', [$item->id, $item->title_ar]);
    $img = config('mangoapi.mangodcn') . $item->img;
    ?>

    <div class="col-md-4 col-sm-4 col-xs-6 video-col" data-toggle="popover" data-trigger="hover" data-placement="top" title="{{$cat}}" data-content="<?php echo $title . '&#10;'. $item -> recorder_date ?>">
        <a href="{{$url2}}?">
            <div class="img-div">
                {{--<img src="{{$img}}" class="img-responsive center-block" />--}}
                <div class="embed-responsive-item image-div" style="background-image: url('{{$img}}');"></div>
            </div>
        </a>
        <div class="content">
            <a href="#" class="title-link">{{$title}}</a>
        </div>
    </div>
    @endforeach
    @endif
