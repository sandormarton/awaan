<link rel="stylesheet" type="text/css" href="{{ asset("/css/bootstrap.min.css")}}" />
<link rel="stylesheet" type="text/css" href="{{asset("/css/ionicons.min.css")}}" />

<script type="text/javascript" src="{{asset("/js/jquery.min.js")}}"></script>
<script type="text/javascript" src="{{asset("/js/bootstrap.min.js")}}"></script>

<style>
    #main-content {
        margin-top: 10px ;
    }
    .thumbnail a:hover{
        text-decoration: none;
        color: #ce0000;
    }
    .thumbnail h4:hover{
        color: #ce0000;
    }
    .video-image{
        max-height: 142px;
        background-repeat: no-repeat;
        background-size: cover;
        width: 250px !important;
        height: 130px !important;
    }
    .show-cont{
        float: right !important;
        text-align: center;
        direction: rtl;
    }
    .show-title{
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .thumbnail .caption{
        padding: 9px 1px;
    }
</style>

<div id="main-content" class="container">
    <div class="row">
        @foreach($videos -> results as $item)
            <?php
                $url = route('video', [$item->id, \App\Helpers\Functions::cleanurl($item->title_ar)]);
                $img = config('mangoapi.mangodcn').$item->img;
            ?>
            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3 show-cont">
                <div class="thumbnail">
                    <a href="{{$url}}" target="_blank">
                        <img class="video-image" style="background-image: url({{$img}});">
                        <div class="caption">
                            <h4 class="show-title">{{$item->title_ar}}</h4>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

