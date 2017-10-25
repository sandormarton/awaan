    

	<?php
    $img = config('mangoapi.mangodcn').$item['img'];
    ?>
    <div class="col-md-3 col-sm-4 col-xs-6 favorite-video-col">
        <?php

        $uid = Session::get('user_info');
        if(Session::get('lang') == 'en'){
            $title = $item['title_en'];
            $url = route('video', [$item['id'], rawurlencode(\App\Helpers\Functions::cleanurl($item['title_en']))]);
        }else{
            $title = $item['title_ar'];
            $url = route('video', [$item['id'], rawurlencode(\App\Helpers\Functions::cleanurl($item['title_ar']))]);
        }
        ?>
        <a href="{{$url}}">
            <div class="img-div">
                <div class="embed-responsive-item image-div" style="background-image: url('{{$img}}');"></div>

                {{--<img src="{{$img}}" class="img-responsive center-block" />--}}
                <!--<div class="show-time-favoritevideopagelist">
                    <span>00:22:17</span>
                </div>-->
            </div>
        </a>
        <div class="content">
            <a href="{{$url}}" class="title-link kh-ellipsis2">{{$title}}</a>
            <a href="#" class="delete-link" data-channeluserid="<?=$uid->id?>"  data-lang="{{Session::get('lang')}}" data-id="{{$item['id']}}">Delete</a>
        </div>
    </div>