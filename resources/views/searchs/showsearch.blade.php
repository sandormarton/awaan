<div class="shows-list-wrapper dcnawaansearch-wrapper" id="shows-search">

    <div class="row searchcategory-items-wrapper">
        @foreach($shows as $item)
        <?php
        $img = config('mangoapi.mangodcn').$item->cover;
        $url = "";
        if($item->is_radio == "1"){
            $url = URL::to("radio/show/{$item->ch_id}/{$item->id}/".\App\Helpers\Functions::cleanurl($item->title_ar));
        }else{
            $url = route('show', [$item->id, ($item->title_ar)]);
        }
        ?>
            <?php
            if(Session::get('lang') == 'en'){
                $title = $item->title_en;
            }else{
                $title = $item->title_ar;
            }
            ?>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 shows-video-col">
            <a href="{{$url}}">
                <p style="display: none">{{$title}}</p>
                <div class="img-div scaleZoomImg">
                {{--<img alt="{{$title}}" src="{{$img}}" class="img-responsive center-block" />--}}
                    <div class="embed-responsive-item image-div lazy-image-handler" data-src="{{$img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                </div>
            </a>
            <div class="content">
                <a href="{{$url}}" class="title-link kh-ellipsis">{{$title}}</a>
            </div>

        </div>
        @endforeach


    </div>
</div>
