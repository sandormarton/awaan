@extends('layouts.master')
@section('title', 'Video on Demand - AWAAN')

@section('home')

<!-- MAIN CONTAINER [START] -->
<div class="site-main-container">

    <!-- HEADER WRAPPER [START] -->
    @include('home.header')
    <!-- HEADER WRAPPER [END] -->

    <!-- BANNER WRAPPER [START] -->
    <div id="banner-container" class="banner-wrapper clearfix">

    </div>
    <!-- BANNER WRAPPER [END] -->

    
    
    <!--  HOME RAMADAN PROGRAMS SECTION WRAPPER [START]		-->
	<div class="container">
		<div class="row">
			
			<div class="ramadanprogramssection-wrapper">
				<div class="homeprograms-section series-programs-section">
					<div class="title-section">
						<h3 style="color: white;">آخر الإضافات</h3>
					</div>
					<div class="data-section">
						<div id="ramadan-carousel" class="owl-carousel data-carousel ramadan-carousel">
							
                            @{{#if ramadan_shows}}
                            @{{#each ramadan_shows}}
                            <div class="item">
                                <a href="video/@{{id}}/@{{title_en}}">
                                    <img src="http://admango.cdn.mangomolo.com/analytics/@{{img}}" />
                                </a>
                                <div class="ramadan-content-box">
                                    <a href="video/@{{id}}/@{{title_en}}" class="play-link giveMeEllipsis">
                                        @{{title_en}}  
                                    </a>
                                </div>
                            </div>
                            @{{/each}}
                            @{{/if}}
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<!--  HOME RAMADAN PROGRAMS SECTION WRAPPER [END]		-->
    
		

    <!-- CONTENT WRAPPER [START] -->
    <div class="content-wrapper">
        <div class="container">

            <div class="row programs-section-logos-wrapper hidden">
                @{{#each covers }}
                <a href="@{{ url }}" class="programs-section-logo col-md-4 col-sm-4 col-xs-4">
                    <img data-src="http://admango.cdn.mangomolo.com/analytics/@{{ img }}" class="load-onscroll img-responsive center-block" />
                </a>
                @{{/each}}
            </div>


            <div class="row content-container">
            
                <div class="selected-programs-wrapper">

                    @if(Session::has('user'))
                	<div class="program-div">
                        <h3 class="program-div-title">
                            <span class="title">واصل المشاهدة‎</span>
                            <span class="triangle"></span>
                        </h3>
                        <div id="resume-programs-list" class="resume-programs-list program-div-items">

                        </div>
                    </div>
                    @endif
                                   
                    <div class="program-div">
                        <h3 class="program-div-title">
                            <span class="title">{{trans('home.featuredShows')}}</span>
                            <span class="triangle"></span>
                        </h3>
                        <div id="selected-programs-list" class="selected-programs-list program-div-items">
                            @include('include.featured_shows_section')
                        </div>
                    </div>
                </div>

                <div class="categories-programs-wrapper">
                    <div class="program-div">
                        <h3 class="program-div-title">
                            <span class="title">{{trans('home.categories')}}</span>
                            <span class="triangle"></span>
                        </h3>
                        <div id="categories-programs-list" class="categories-programs-list program-div-items">
                            @include('home.home_categories')
                        </div>
                    </div>
                </div>

                <div class="dcn-live-wrapper">
                    <div class="col-lg-9 col-md-8 dcn-live-container">
                        @include('home.live_broadcast')
                    </div>
                </div>

                <div class="dcn-catch-up-wrapper">
                    @include('home.catchup')
                </div>

            </div>

        </div>
    </div>
    <!-- CONTENT WRAPPER [END] -->

</div>
<!-- MAIN CONTAINER [END] -->

<!-- SHARE Modal -->

<div class="shareModal" id="shareModal">
    <div class="shareModal-body">
        <label>Share</label>
        <ul class="footer-sm-ul">
            <li><a href="#" title="Facebook" class="share_fb" target="_blank"><img  src="images/icon-sm-facebook.png" title="Facebook" alt="Facebook" /></a></li>
            <li><a href="#" title="Twitter" class="share_twitter" target="_blank"><img src="images/icon-sm-twitter.png" title="Twitter" alt="Twitter" /></a></li>
            {{--<li><a href="#" title="Youtube" target="_blank"><img src="images/icon-sm-youtube.png" title="Youtube" alt="Youtube" /></a></li>--}}
        </ul>
    </div>
</div>

<!-- LOGIN MODAL [START] -->
@include('login_modal')
<!-- LOGIN MODAL [END] -->

<!-- REGISTER MODAL [START] -->
@include('register_modal')

<!-- REGISTER MODAL [END] -->

@endsection
