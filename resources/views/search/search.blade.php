@extends('layouts.master_inner')
@section('title', 'Welcome Awan')
<!--This defines a home  section which gets displayed via "yield" -->

@section('search')
<!-- MAIN CONTAINER [START] -->
@include('show_innerright')


<div class="innerpage-leftbar">

    <div class="mobile-menu visible-xs">
    	<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" title="AWAAN" alt="AWAAN" /></a>
        <button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
    </div>

    @if(sizeof($searchcotent->videos)>0)
    @include('search.videosearch',['videos'=>$searchcotent->videos])
    @endif
    <div class="clearfix"></div>
    @if(sizeof($searchcotent->shows)>0)
    @include('search.showsearch',['shows'=>$searchcotent->shows])
    @endif


    <!--    <div class="col-md-12 pagination-wrapper">
            <ul class="pagination">
                <li class="first">
                    <a href="#" aria-label="First">
                        <span aria-hidden="true">&laquo; First</span>
                    </a>
                </li>
                <li class="previous">
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&lsaquo;</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li class="active"><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li class="next">
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&rsaquo;</span>
                    </a>
                </li>
                <li class="last">
                    <a href="#" aria-label="Last">
                        <span aria-hidden="true">Last &raquo;</span>
                    </a>
                </li>
            </ul>
            <div class="pagination-result">
                <a href="#">عرض الكل <</a>
            </div>
        </div>-->


    @include('include.inner_footer')

</div>
@endsection
<!-- MAIN CONTAINER [END] -->
