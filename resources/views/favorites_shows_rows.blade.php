<div class="favorite-shows-list-wrapper">
    <div class="container">
        <h3 class="module-title">{{ trans('content.shows_favorites.favshows') }}</h3>
        <div class="row">
            @foreach($shows  as $item)
                <?php
                $img = config('mangoapi.mangodcn').$item['cover'];
                $uid = Session::get('user_info');
                if(Session::get('lang') == 'en'){
                    $title = $item['title_en'];
                    $url = route('show', [$item['id'], rawurlencode(App\Helpers\Functions::cleanurl($item['title_en']))]);
                }else{
                    $title = $item['title_ar'];
                    $url = route('show', [$item['id'], rawurlencode(App\Helpers\Functions::cleanurl($item['title_ar']))]);
                }
                ?>
            <div class="col-md-3 col-sm-4 col-xs-6 favorite-shows-col">
                <a href="{{$url}}">
                    <div class="img-div scaleZoomImg">
                    	<div class="embed-responsive-item image-div lazy-image-handler" data-src="{{$img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                        {{--<img src="{{$img}}" class="img-responsive center-block" />--}}
                    </div>
                </a>
                <div class="content">
                    <a href="{{$url}}" class="title-link kh-ellipsis2">{{$title}}</a>
                    <a href="#" class="delete-link" data-channeluserid="<?=$uid->id?>"    data-lang="{{Session::get('lang')}}" data-id="{{$item['id']}}">Delete</a>
                </div>
            </div>
            @endforeach

        </div><!-- ROW [END]	-->
    </div><!-- CONTAINER [END]	-->
</div>