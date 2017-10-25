<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/18/2017
 * Time: 10:35 AM
 */
?>
{{--<div class="channel-list-wrapper">--}}


{{--</div>--}}
<ul class="nav navbar-nav">
    <li {!!(Route::is('radio'))?'class="active"':""!!}><a href="{{URL::to("radio/".$current_channel->id."/".\App\Helpers\Functions::cleanurl($current_channel->title_ar))}}">{{ trans('content.allshows.livestream') }}</a></li>
    <li {!!(Route::is('radio_shows'))?'class="active"':""!!}><a href="{{URL::to("radio/shows/".$current_channel->id."/".\App\Helpers\Functions::cleanurl($current_channel->title_ar))}}">{{ trans('content.allshows.shows') }}</a></li>
    <li {!!(Route::is('radio_catchup'))?'class="active"':""!!}><a href="{{URL::to("radio/catchup/".$current_channel->id."/".\App\Helpers\Functions::cleanurl($current_channel->title_ar))}}">Catch Up</a></li>
</ul>
