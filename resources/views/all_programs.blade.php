@extends('layouts.master')
@section('title',trans('content.pagetitle.allprograms'))
@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title' => trans('content.pagetitle.allprograms'),
        'current_description' => trans('content.pagetitle.allprograms'),
    ])
@endsection
<!--This defines a home  section which gets displayed via "yield" -->
@section('main-content')
    <h1 style="display: none;">{{trans('content.pagetitle.allprograms')}}</h1>
    <h2 style="display: none;">{{trans('content.pagetitle.allprograms')}}</h2>
<!-- MAIN CONTAINER [START] -->
    <!--  SHOWS CAROUSEL SECTION	[START]	-->
    <div class="showscategory-carouellist-wrapper">
        <div class="container">

            <div class="showscategory-carouellist-section">
                <div class="title-section">
                    <h3>{{trans('content.whole.programs')}}</h3>
                    <label for="language-selector" style="display: none">language selector</label>
                    <select class="form-control sortcategory-dropdown" id="language-selector">
                        <option>{{trans('content.whole.language')}}</option>
                        @if(isset($content->all_language) and !empty($content->all_language))
                            @foreach($content->all_language  as $item)
                                <option value="{{$item}}">{{trans('content.languanges.'.$item)}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label for="date-selector" style="display: none">date selector</label>
                    <select class="form-control sortcategory-dropdown" id="date-selector">
                        <option>{{trans('content.whole.order_date')}}</option>
                        @if(isset($content->available_years) and !empty($content->available_years))
                            @foreach($content->available_years  as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        @endif
                    </select>
                    {{--<select class="form-control sortcategory-dropdown last-dropdown" id="type-selector">--}}
                        {{--<option value="desc">{{trans('content.whole.order_date_desc')}}</option>--}}
                        {{--<option value="asc">{{trans('content.whole.order_date_asc')}}</option>--}}
                        {{--<option value="desc" data-order="alpha">{{trans('content.whole.order_alpha_desc')}}</option>--}}
                        {{--<option value="asc" data-order="alpha">{{trans('content.whole.order_alpha_asc')}}</option>--}}
                    {{--</select>--}}
                    <label for="category-selector-drop" style="display: none">category selector drop</label>
                    <select class="form-control sortcategory-dropdown last-dropdown" id="category-selector-drop">
                        <option value="-1" data-category-name="{{trans('content.whole.all_shows')}}">{{trans('content.whole.category')}}</option>
                        <?php $i =0;?>
                        @if(isset($categories) and !empty($categories))
                            @foreach($categories  as $item)
                                <?php
                                if(Session::get('lang') == 'en'){
                                    $title = $item->title_en;
                                }else{
                                    $title = $item->title_ar;
                                }
                                ?>
                                @if(!empty($title))
                                    <option value="{{$item->id}}" data-category-name="{{$title}}">{{$title}}</option>
                                    <?php $i++; ?>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    <label for="channel-selector" style="display: none">channel selector</label>
                    <select class="form-control sortcategory-dropdown last-dropdown" id="channel-selector">
                        <option value="none" data-id="0">{{trans('content.whole.all_channels')}}</option>
                        @foreach($channels  as $item)
                            <?php
                            if(Session::get('lang') == 'ar'){
                                $title = $item->title_ar;
                            }else{
                                $title = $item->title_en;
                            }
                            ?>
                            @if(!empty($title) and $item->premuim != 1 and $item->id != 25)
                                    <option value="{{$title}}" data-id="{{$item->id}}">{{$title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="showscategory-carouel-section">
                <div id="showscategory-carousel" class="owl-carousel showscategory-carousel">
                    <div class="item">
                        <a href="#" class="category-selector" data-category-id="-1" data-category-name="{{trans('content.whole.all_shows')}}">
                            <div class="showscategory-sama-div" data-cat-color="-1">
                                <span class="kh-ellipsis">{{trans('content.whole.all_shows')}}</span>
                            </div>
                        </a>
                    </div>
                    <?php $i =0;?>
                    @if(isset($categories) and !empty($categories))
                        @foreach($categories  as $item)
                            <?php
                                if(Session::get('lang') == 'en'){
                                    $title = $item->title_en;
                                }else{
                                    $title = $item->title_ar;
                                }
                             ?>
                            @if(!empty($title))
                                <?php
                                if(isset($item->icon)) {
//                                    $img = config('mangoapi.mangodcn').$item->icon;
                                    $img = asset("images/cat-icon/".$item->id.".png");
                                }
                                ?>
                                    <div class="item">
                                        <a href="#" class="category-selector" data-category-id="{{$item->id}}" data-category-name="{{$title}}">
                                            <div class="showscategory-sama-div" data-cat-color="{{$item->id}}">
                                                <span class="kh-ellipsis">{{$title}}</span>
                                            </div>
                                        </a>
                                    </div>
                                <?php $i++; ?>
                            @endif
                        @endforeach
                    @endif

                    {{--<div class="item">--}}
                        {{--<a href="{{URL::to("relatedshows/{$item->id}/".\App\Helpers\Functions::cleanurl($item->title_ar))}}">--}}
                            {{--<div style="background: {{$color_array[$i]}};" class="showscategory-sama-div" onMouseOver="this.style.background='url({{$img}})'" onMouseOut="this.style.background=' {{$color_array[$i]}}'">--}}
                                {{--<span>{{str_limit($item->title_ar,18)}}</span>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}

                </div>

            </div>


        </div>
    </div>
    <!--  SHOWS CAROUSEL SECTION	[END]	-->


    <!-- SHOWS LIST WRAPPER [START]	-->
    <div class="shows-list-wrapper">
        <div class="container">
            <?php
            if(Session::get('lang') == 'en'){
                $cat_title = $cat_name->title_en;
            }else{
                $cat_title = $cat_name->title_ar;
            }
            ?>
            <h3 id="cat_name_back" style="display: none">{{$cat_title}}</h3>
            <h3 id="channel_name_back" style="display: none"></h3>
            <h3 id="cat_name">{{$cat_title}}</h3>
            <div class="row" id="programs-container">
                @if($catid != 208109)
                @foreach($content->shows as $item)
                    <?php
                    if(Session::get('lang') == 'en'){
                        $title = $item->title_en;
                    }else{
                        $title = $item->title_ar;
                    }
                    ?>
                    @if(!empty($title))
                        <?php
                        if(isset($item->thumbnail)) {
                            $img = config('mangoapi.mangodcn').$item->thumbnail;
                        }
                        elseif(isset($item->img)) {
                            $img = config('mangoapi.mangodcn').$item->img;
                        }
                        ?>
                            <div class="col-md-3 col-sm-4 col-xs-6 shows-video-col">
                                <a href="{{URL::to("{$other_content['route']}/{$item->id}/".\App\Helpers\Functions::cleanurl("{$title}"))}}">
                                    <p style="display: none">{{$title}}</p>
                                    <div class="img-div scaleZoomImg">
                                        {{--<img alt="{{$title}}" src="{{$img}}" class="img-responsive center-block" />--}}
                                        <div class="embed-responsive-item image-div lazy-image-handler" data-src="{{$img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                    </div>
                                </a>
                                <div class="content">
                                    <a href="#" class="title-link">{{$title}}</a>
                                </div>
                            </div>
                    @endif
                @endforeach
                @else
                    @foreach($content->videos as $item)
                        <?php
                        if(Session::get('lang') == 'en'){
                            $title = $item->title_en;
                        }else{
                            $title = $item->title_ar;
                        }
                        ?>
                        @if(!empty($title))
                            <?php
                            if(isset($item->thumbnail)) {
                                $img = config('mangoapi.mangodcn').$item->thumbnail;
                            }
                            elseif(isset($item->img)) {
                                $img = config('mangoapi.mangodcn').$item->img;
                            }
                            ?>
                            <div class="col-md-3 col-sm-4 col-xs-6 shows-video-col">
                                <a href="{{URL::to("movie/{$item->id}/".\App\Helpers\Functions::cleanurl("{$title}"))}}">
                                    <p style="display: none">{{$title}}</p>
                                    <div class="img-div scaleZoomImg">
                                        {{--<img alt="{{$title}}" src="{{$img}}" class="img-responsive center-block" />--}}
                                        <div class="embed-responsive-item image-div lazy-image-handler aflam-image" data-src="{{$img}}" style="background-image: url('{{asset("images/ajax-loader.gif")}}');"></div>
                                    </div>
                                </a>
                                <div class="content">
                                    <a href="#" class="title-link">{{$title}}</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div><!-- ROW [END]	-->

            @if($catid != 208109)
                @if(count($content->shows) >= 16)
                    <div class="load-more-div">
                        <a href="#" class="btn btn-awaanbluebtn btn-viewall" id="loadmore-cat"  data-category-id="{{$cat_name->id}}" data-category-offset="2">{{ trans('content.whole.show_more') }}</a>
                    </div>
                @endif
            @else
                @if(count($content->videos) >= 16)
                    <div class="load-more-div">
                        <a href="#" class="btn btn-awaanbluebtn btn-viewall" id="loadmore-cat"  data-category-id="{{$cat_name->id}}" data-category-offset="2">{{ trans('content.whole.show_more') }}</a>
                    </div>
                @endif
            @endif

        </div><!-- CONTAINER [END]	-->
    </div>
    <!-- SHOWS LIST WRAPPER [END]	-->
@endsection
<!-- MAIN CONTAINER [END] -->
@section("additional_scripts")
    <script  type="text/javascript">
        jQuery(document).ready( function() {
            jQuery('#showscategory-carousel').owlCarousel({
                navText   : ['',''],
                dots      : false,
                rtl       : true,
                loop      : true,
                margin    : 2,
                nav       : true,
                responsive: {
                    0:{
                        items:1
                    },
                    400:{
                        items:2
                    },
                    767:{
                        items:3
                    },
                    991:{
                        items:5
                    },
                    1200:{
                        items:5
                    }
                }
            });
            var language = '';
            var production_date = '';
            var order_type = '';
            var order = '';
            var channel_id = 0;
            jQuery('body').on('click','#loadmore-cat', function(e) {
                var offset =jQuery(this).attr('data-category-offset');
                var cat_id =jQuery(this).attr('data-category-id');
                console.log('cat: ' +cat_id );
                console.log('offset: ' +offset );
                jQuery.ajax({
                    type: "GET",
                    url: "{{URL::to("show/allprograms")}}",
                    data: {
                        p: offset,
                        cat_id: cat_id,
                        language: language,
                        production_date: production_date,
                        order_type: order_type,
                        order: order,
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
                        // $('#loader-icon').hide();
                    },
                    success: function(data){
                       if(data['count'] >= 16){
                           jQuery('#programs-container').append(data['html']);
                           offset = Number(offset) + 1;
                           console.log('offset' + offset);
                           console.log('offset' + data['count']);
                           jQuery('#loadmore-cat').attr('data-category-offset',offset);
                       }else{
                           jQuery('#programs-container').append(data['html']);
                           jQuery('#loadmore-cat').css('display','none');
                       }
                        jQuery(".lazy-image-handler").Lazy({
                            onFinishedAll: function() {
                                jQuery(this).removeData("src");
                                jQuery(this).addClass("loaded");
                            }
                        });
                        setTimeout(function() {
                            $("body").getNiceScroll().resize();
                        }, 1000);

                    },
                    error: function(){}
                });
                return false;
            });

            jQuery('body').on('click','.category-selector', function(e) {
                jQuery('#loadmore-cat').css('display','inline-block');
                jQuery('#programs-container').html('');
                jQuery('#loadmore-cat').attr('data-category-offset',2);
                var cat_id = jQuery(this).attr('data-category-id');
                var cat_name = jQuery(this).attr('data-category-name');
                console.log('cat_id' + cat_id);
                jQuery('#loadmore-cat').attr('data-category-id',cat_id);
                jQuery('#cat_name').html(cat_name);
                jQuery('#cat_name_back').html(cat_name);
                if(jQuery('#channel_name_back').html() != '')
                    jQuery('#cat_name').html(jQuery('#cat_name_back').html() + ' - ' + jQuery('#channel_name_back').html());
                console.log(cat_name);
                jQuery.ajax({
                    type: "GET",
                    url: "{{URL::to("show/allprograms")}}",
                    data: {
                        p: 1,
                        cat_id: cat_id,
                        channel_id: channel_id
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
                        history.pushState({
                            cat_id: cat_id,
                            channel_id: channel_id,
                            cat_name: cat_name,
                            urlPath:'{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id
                        },"", '{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id);
                        // $('#loader-icon').hide();
                    },
                    success: function(data){
                        jQuery('#language-selector').html(data['lang_html']);
//                        jQuery('#channel-selector').html(data['channel_html']);
                        jQuery('#date-selector').html(data['date_html']);
                        console.log('lang' + data['lang_html']);
                        console.log('date_html' + data['date_html']);
                       if(data['count'] >= 16){
                           jQuery('#programs-container').html(data['html']);
                       }else{
                           jQuery('#programs-container').html(data['html']);
                           jQuery('#loadmore-cat').css('display','none');
                       }
                        jQuery(".lazy-image-handler").Lazy({
                            onFinishedAll: function() {
                                jQuery(this).removeData("src");
                                jQuery(this).addClass("loaded");
                            }
                        });
                        setTimeout(function() {
                            $("body").getNiceScroll().resize();
                        }, 1000);
                    },
                    error: function(){}
                });
                return false;
            });

            jQuery('#category-selector-drop').change(function() {
                jQuery('#loadmore-cat').css('display','inline-block');
                jQuery('#programs-container').html('');
                var cat_id = jQuery(this).val();
                jQuery('#loadmore-cat').attr('data-category-id',cat_id);
                var cat_name = jQuery(this).find('option:selected').attr('data-category-name');
                jQuery('#cat_name').html(cat_name);
                jQuery('#cat_name_back').html(cat_name);
                if(jQuery('#channel_name_back').html() != '')
                    jQuery('#cat_name').html(jQuery('#cat_name_back').html() + ' - ' + jQuery('#channel_name_back').html());
                jQuery.ajax({
                    type: "GET",
                    url: "{{URL::to("show/allprograms")}}",
                    data: {
                        p: 1,
                        cat_id: cat_id,
                        language: language,
                        production_date: production_date,
                        order_type: order_type,
                        order: order,
                        channel_id: channel_id
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
                        // $('#loader-icon').hide();
                        history.pushState({
                            cat_id: cat_id,
                            cat_name: cat_name,
                            language: language,
                            production_date: production_date,
                            order_type: order_type,
                            order: order,
                            channel_id: channel_id,
                            urlPath:'{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id
                        },"", '{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id);
                    },
                    success: function(data){
                        offset = 2;
                        jQuery('#loadmore-cat').attr('data-category-offset',offset);
                        if(data['count'] >= 16){
                            jQuery('#programs-container').html(data['html']);

                        }else{
                            jQuery('#programs-container').html(data['html']);
                            jQuery('#loadmore-cat').css('display','none');
                        }
                        jQuery(".lazy-image-handler").Lazy({
                            onFinishedAll: function() {
                                jQuery(this).removeData("src");
                                jQuery(this).addClass("loaded");
                            }
                        });
                        setTimeout(function() {
                            $("body").getNiceScroll().resize();
                        }, 1000);
                    },
                    error: function(){}
                });
            });

            jQuery('#language-selector').change(function() {
                jQuery('#loadmore-cat').css('display','inline-block');
                jQuery('#programs-container').html('');
                language = jQuery(this).val();
                if(language == 'اللغة')
                    language = '';
                console.log('languange : ' + language);
                var cat_id = jQuery('#loadmore-cat').attr('data-category-id');
                var cat_name = jQuery('#cat_name_back').html();
                console.log(' production_date '+production_date);
                console.log(' cat_id '+ cat_id);
                jQuery.ajax({
                    type: "GET",
                    url: "{{URL::to("show/allprograms")}}",
                    data: {
                        p: 1,
                        cat_id: cat_id,
                        language: language,
                        production_date: production_date,
                        order_type: order_type,
                        order: order,
                        channel_id: channel_id,
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
                        history.pushState({
                            cat_id: cat_id,
                            cat_name: cat_name,
                            language: language,
                            production_date: production_date,
                            order_type: order_type,
                            order: order,
                            channel_id: channel_id,
                            urlPath:'{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id
                        },"", '{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id);
                        // $('#loader-icon').hide();
                    },
                    success: function(data){
                        offset = 2;
                        jQuery('#loadmore-cat').attr('data-category-offset',offset);
                        if(data['count'] >= 16){
                            jQuery('#programs-container').html(data['html']);

                        }else{
                            jQuery('#programs-container').html(data['html']);
                            jQuery('#loadmore-cat').css('display','none');
                        }
                        jQuery(".lazy-image-handler").Lazy({
                            onFinishedAll: function() {
                                jQuery(this).removeData("src");
                                jQuery(this).addClass("loaded");
                            }
                        });
                        setTimeout(function() {
                            $("body").getNiceScroll().resize();
                        }, 1000);
                    },
                    error: function(){}
                });
            });
            jQuery('#date-selector').change(function() {
                jQuery('#loadmore-cat').css('display','inline-block');
                jQuery('#programs-container').html('');
                production_date = jQuery(this).val();
                var cat_id = jQuery('#loadmore-cat').attr('data-category-id');
                var cat_name = jQuery('#cat_name_back').html();
                jQuery.ajax({
                    type: "GET",
                    url: "{{URL::to("show/allprograms")}}",
                    data: {
                        p: 1,
                        cat_id: cat_id,
                        language: language,
                        production_date: production_date,
                        order_type: order_type,
                        order: order,
                        channel_id: channel_id,
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
                        history.pushState({
                            cat_id: cat_id,
                            cat_name: cat_name,
                            language: language,
                            production_date: production_date,
                            order_type: order_type,
                            order: order,
                            channel_id: channel_id,
                            urlPath:'{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id
                        },"", '{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id);
                        // $('#loader-icon').hide();
                    },
                    success: function(data){
                        console.log(data);
                        offset = 2;
                        jQuery('#loadmore-cat').attr('data-category-offset',offset);
                        if(data['count'] >= 16){
                            jQuery('#programs-container').html(data['html']);

                        }else{
                            jQuery('#programs-container').html(data['html']);
                            jQuery('#loadmore-cat').css('display','none');
                        }
                        jQuery(".lazy-image-handler").Lazy({
                            onFinishedAll: function() {
                                jQuery(this).removeData("src");
                                jQuery(this).addClass("loaded");
                            }
                        });
                        setTimeout(function() {
                            $("body").getNiceScroll().resize();
                        }, 1000);
                    },
                    error: function(){}
                });
            });

            jQuery('#type-selector').change(function() {
                jQuery('#loadmore-cat').css('display','inline-block');
                jQuery('#programs-container').html('');
                order_type = jQuery(this).val();
                order = jQuery(this).find('option:selected').attr('data-order');
                console.log(order);
                var cat_id = jQuery('#loadmore-cat').attr('data-category-id');
                var cat_name = jQuery('#cat_name_back').html();
                jQuery.ajax({
                    type: "GET",
                    url: "{{URL::to("show/allprograms")}}",
                    data: {
                        p: 1,
                        cat_id: cat_id,
                        language: language,
                        production_date: production_date,
                        order_type: order_type,
                        order: order,
                        channel_id: channel_id,
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
                        history.pushState({
                            cat_id: cat_id,
                            cat_name: cat_name,
                            language: language,
                            production_date: production_date,
                            order_type: order_type,
                            order: order,
                            channel_id: channel_id,
                            urlPath:'{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id
                        },"", '{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id);
                        // $('#loader-icon').hide();
                    },
                    success: function(data){
                        console.log(data);
                        offset = 2;
                        jQuery('#loadmore-cat').attr('data-category-offset',offset);
                        if(data['count'] >= 16){
                            jQuery('#programs-container').html(data['html']);
                        }else{
                            jQuery('#programs-container').html(data['html']);
                            jQuery('#loadmore-cat').css('display','none');
                        }
                        jQuery(".lazy-image-handler").Lazy({
                            onFinishedAll: function() {
                                jQuery(this).removeData("src");
                                jQuery(this).addClass("loaded");
                            }
                        });
                        setTimeout(function() {
                            $("body").getNiceScroll().resize();
                        }, 1000);
                    },
                    error: function(){}
                });
            });

            jQuery('#channel-selector').change(function() {
                jQuery('#loadmore-cat').css('display','inline-block');
                jQuery('#programs-container').html('');
                channel_id = jQuery(this).find('option:selected').attr('data-id');
                var channel_name = "";
                if(jQuery(this).val() == 'none')
                    jQuery('#cat_name').html(jQuery('#cat_name_back').html());
                else{
                    jQuery('#cat_name').html(jQuery('#cat_name_back').html() + ' - ' + jQuery(this).val());
                    jQuery('#channel_name_back').html(jQuery(this).val());
                    channel_name = jQuery(this).val();
                }

                console.log(channel_id);
                console.log(channel_name);
                console.log("ssss");
                var cat_id = jQuery('#loadmore-cat').attr('data-category-id');
                var cat_name = jQuery('#cat_name_back').html();
                jQuery.ajax({
                    type: "GET",
                    url: "{{URL::to("show/allprograms")}}",
                    data: {
                        p: 1,
                        cat_id: cat_id,
                        language: language,
                        production_date: production_date,
                        order_type: order_type,
                        order: order,
                        channel_id: channel_id,
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
                        history.pushState({
                            cat_id: cat_id,
                            cat_name: cat_name,
                            language: language,
                            production_date: production_date,
                            order_type: order_type,
                            order: order,
                            channel_id: channel_id,
                            channel_name: channel_name,
                            urlPath:'{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id
                        },"", '{{URL::to("show/allprograms")}}/'+cat_id+'/'+cat_name+'?p=1&channel_id='+channel_id);
                        // $('#loader-icon').hide();
                    },



                    success: function(data){
                        console.log(data);
                        offset = 2;
                        jQuery('#loadmore-cat').attr('data-category-offset',offset);
                        if(data['count'] >= 16){
                            jQuery('#programs-container').html(data['html']);
                        }else{
                            jQuery('#programs-container').html(data['html']);
                            jQuery('#loadmore-cat').css('display','none');
                        }
                        jQuery(".lazy-image-handler").Lazy({
                            onFinishedAll: function() {
                                jQuery(this).removeData("src");
                                jQuery(this).addClass("loaded");
                            }
                        });
                        setTimeout(function() {
                            $("body").getNiceScroll().resize();
                        }, 1000);
                    },
                    error: function(){}
                });
            });

        });

        window.addEventListener('popstate', function(e) {
            var old_data = e.state;
            console.log(old_data);
            var cat_id = '{{$cat_name->id}}';
            var cat_name = '{{$cat_name->title_ar}}';
            var channel_id = 0;
            var language = 0;
            var production_date = 0;
            var order_type = 0;
            var order = 0;
            var channel_name = "";

            if(old_data != null){
                cat_id = old_data.cat_id;
                cat_name = old_data.cat_name;
                channel_id = old_data.channel_id;

                if (typeof(old_data.language) !== 'undefined') language = old_data.language;
                if (typeof(old_data.production_date) !== 'undefined') production_date = old_data.production_date;
                if (typeof(old_data.order_type) !== 'undefined') order_type = old_data.order_type;
                if (typeof(old_data.order) !== 'undefined') order = old_data.order;
                if (typeof(old_data.channel_name) !== 'undefined') channel_name = old_data.channel_name;
            }
            jQuery('#loadmore-cat').css('display','inline-block');
            jQuery('#programs-container').html('');
            jQuery('#loadmore-cat').attr('data-category-offset',2);

            jQuery('#loadmore-cat').attr('data-category-id',cat_id);
            jQuery('#cat_name').html(cat_name);
            jQuery('#cat_name_back').html(cat_name);

            jQuery('#channel_name_back').html(channel_name);
            if(jQuery('#channel_name_back').html() != '')
                jQuery('#cat_name').html(jQuery('#cat_name_back').html() + ' - ' + jQuery('#channel_name_back').html());
            console.log(cat_name);
            jQuery.ajax({
                type: "GET",
                url: "{{URL::to("show/allprograms")}}",
                data: {
                    p: 1,
                    cat_id: cat_id,
                    channel_id: channel_id,
                    language: language,
                    production_date: production_date,
                    order_type: order_type,
                    order: order,
                },
                beforeSend: function(){
                    // $('#loader-icon').show();
                },
                complete: function(){
                },
                success: function(data){
                    jQuery('#language-selector').html(data['lang_html']);
//                        jQuery('#channel-selector').html(data['channel_html']);
                    jQuery('#date-selector').html(data['date_html']);
                    console.log('lang' + data['lang_html']);
                    console.log('date_html' + data['date_html']);
                    if(data['count'] >= 16){
                        jQuery('#programs-container').html(data['html']);
                    }else{
                        jQuery('#programs-container').html(data['html']);
                        jQuery('#loadmore-cat').css('display','none');
                    }
                    jQuery(".lazy-image-handler").Lazy({
                        onFinishedAll: function() {
                            jQuery(this).removeData("src");
                            jQuery(this).addClass("loaded");
                        }
                    });
                    setTimeout(function() {
                        $("body").getNiceScroll().resize();
                    }, 1000);
                },
                error: function(){}
            });
        });
    </script>
@endsection