@extends('layouts.master')
@section('title',  trans('content.pagetitle.categories'))
<!--This defines a home  section which gets displayed via "yield" -->
@section('social_header_meta')
    @include('include.custom_social_header',[
        'current_title' => trans('content.pagetitle.categories'),
        'current_description' => trans('content.pagetitle.categories'),
    ])
@endsection
@section('main-content')
    <h1 style="display: none;">{{trans('content.pagetitle.categories')}}</h1>
    <h2 style="display: none;">{{trans('content.pagetitle.categories')}}</h2>
    <h3 style="display: none;">{{trans('content.pagetitle.categories')}}</h3>
<!-- MAIN CONTAINER [START] -->
    <div class="category-list-wrapper">
        <div class="container">
            <h4 class="content-title">{{ trans('content.whole.categories')}}</h4>
            <div class="row categories-main">
                <?php $i =0;?>
                @foreach($categories  as $item)
                    @if(!empty($item->title_ar))
                        <?php
                        if(isset($item->icon)) {
                            $img = asset("images/cat-icon/".$item->id.".png");
                        }
                        if(Session::get('lang') == 'en'){
                            $title = $item->title_en;
                        }else{
                            $title = $item->title_ar;
                        }
                        ?>
                            <div class="col-md-15 col-sm-4 col-xs-6">
                                <a href="{{URL::to("show/allprograms/{$item->id}/".\App\Helpers\Functions::cleanurl($title))}}">
                                    <div class="category-div" data-cat-color="{{$item->id}}">
                                        <span class="kh-ellipsis">{{$title}}</span>
                                    </div>
                                </a>
                            </div>
                            <?php $i++; ?>
                    @endif
                @endforeach

            </div>

        </div>
    </div>
@endsection
<!-- MAIN CONTAINER [END] -->
