<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/26/2017
 * Time: 4:24 PM
 */
?>
@if(isset($content->audio) && is_array($content->audio) && count($content->audio) > 0)
    @foreach($content->audio as $item)
        <div class="program-list playing-program">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-xs-8 program-play-col">
                    <div class="play-div">
                        <button class="btn-play audio_media" data-id="{{$item->id}}" data-signature="{{$item->signature}}">play</button>
                    </div>
                    <div class="title-div">
                        {{$item->title_en}}
                    </div>
                    <div class="volume-control-div">
                        <span class="tooltip"></span> <!-- Tooltip -->
                        {{--<div id="slider"></div> --}}
                        {{--<span class="volume"></span> <!-- Volume -->--}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-4 program-summary-col">
                    <span class="program-min">{{date("i",$item->duration)}} Min</span>
                    <span class="program-hr">{{date("H",$item->duration)}} Hr</span>
                    {{--<span class="program-favourite"><i class="fa fa-heart"></i></span>--}}
                </div>
            </div>
        </div>
    @endforeach
@endif
