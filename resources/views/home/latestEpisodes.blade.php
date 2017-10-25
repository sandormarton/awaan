@extends('layouts.master')
@section('title', $page_title)

@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title' => $page_title,
        'current_description' => $page_title,
    ])
@endsection
<!--This defines a home  section which gets displayed via "yield" -->
@section('main-content')
    <h1 style="display: none;">{{trans('content.pagetitle.allprograms')}}</h1>
    <h2 style="display: none;">Awaan</h2>
    <h3 style="display: none;">Awaan</h3>
    <!-- MAIN CONTAINER [START] -->


    <!-- SHOWS LIST WRAPPER [START]	-->
    <div class="shows-list-wrapper">
        <div class="container">
            <h1 class="title">{{$page_title}}</h1>
            <div class="row" id="programs-container">
                @foreach($content as $item)
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
                            <a href="{{URL::to("video/{$item->id}/".\App\Helpers\Functions::cleanurl($title))}}">
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
            </div><!-- ROW [END]	-->

        </div><!-- CONTAINER [END]	-->
    </div>
    <!-- SHOWS LIST WRAPPER [END]	-->
@endsection
<!-- MAIN CONTAINER [END] -->
@section("additional_scripts")
    <script  type="text/javascript">
        jQuery(document).ready( function() {
            var language = '';
            var production_date = '';
            var order_type = '';
            var order = '';
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

                    },
                    error: function(){}
                });
                return false;
            });



            jQuery('body').on('click','.category-selector', function(e) {
                jQuery('#programs-container').html('');
                jQuery('#loadmore-cat').attr('data-category-offset',2);
                var cat_id = jQuery(this).attr('data-category-id');
                var cat_name = jQuery(this).attr('data-category-name');
                console.log('cat_id' + cat_id);
                jQuery('#loadmore-cat').attr('data-category-id',cat_id);
                jQuery('#cat_name').html(cat_name);
                console.log(cat_name);
                jQuery.ajax({
                    type: "GET",
                    url: "{{URL::to("show/allprograms")}}",
                    data: {
                        p: 1,
                        cat_id: cat_id,
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
                        // $('#loader-icon').hide();
                    },
                    success: function(data){
                        jQuery('#language-selector').html(data['lang_html']);
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

                    },
                    error: function(){}
                });
                return false;
            });

            jQuery('#language-selector').change(function() {
                jQuery('#programs-container').html('');
                language = jQuery(this).val();
                var cat_id = jQuery('#loadmore-cat').attr('data-category-id');
                console.log(production_date);
                console.log(language);
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
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
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

                    },
                    error: function(){}
                });
            });
            jQuery('#date-selector').change(function() {
                jQuery('#programs-container').html('');
                production_date = jQuery(this).val();
                var cat_id = jQuery('#loadmore-cat').attr('data-category-id');
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
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
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
                    },
                    error: function(){}
                });
            });

            jQuery('#type-selector').change(function() {
                jQuery('#programs-container').html('');
                order_type = jQuery(this).val();
                order = jQuery(this).find('option:selected').attr('data-order');
                console.log(order);
                var cat_id = jQuery('#loadmore-cat').attr('data-category-id');
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
                    },
                    beforeSend: function(){
                        // $('#loader-icon').show();
                    },
                    complete: function(){
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
                    },
                    error: function(){}
                });
            });

        });
    </script>
@endsection
