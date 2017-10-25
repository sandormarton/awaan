@extends('layouts.master')
@section('title',  trans('content.pagetitle.channels'))
<!--This defines a home  section which gets displayed via "yield" -->

@section('home')
	<!-- MAIN CONTAINER [START] -->
	<div class="site-main-container">

		<!-- HEADER WRAPPER [START] -->
		@include('home.header')
		<!-- HEADER WRAPPER [END] -->

		<!-- BANNER WRAPPER [START] -->
		<div class="smarttvbanner-wrapper clearfix">

			<div id="Smarttvbanner-carousel" class="Smarttvbanner-carousel carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#Smarttvbanner-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#Smarttvbanner-carousel" data-slide-to="1"></li>
					<li data-target="#Smarttvbanner-carousel" data-slide-to="2"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="{{asset("images/smart-tv-banner-1.jpg")}}" class="slide-img img-responsive" title="smart-tv-banner" alt="smart-tv-banner">
						<div class="carousel-caption">
							<div class="caption-image" data-animation="animated flipInX">
								<img src="{{asset("images/logo-medium.png")}}" class="caption-img" title="AWAAN" alt="AWAAN" />
							</div>
							<div class="caption-content">
								<h4 data-animation="animated fadeInRight">Your favorite Channels & all the Latest Episodes</h4>
								<h2 data-animation="animated fadeInRight">FREE  Now on <a href="#">awaan.ae</a></h2>
							</div>
						</div>
					</div>
					<div class="item">
						<img src="{{asset("images/smart-tv-banner-2.jpg")}}" class="slide-img img-responsive" title="smart-tv-banner2" alt="smart-tv-banner2">
						<div class="carousel-caption">
							<div class="caption-image" data-animation="animated flipInX">
								<img src="{{asset("images/logo-medium.png")}}" class="caption-img" title="Awaan" alt="Awaan" />
							</div>
							<div class="caption-content">
								<h4 data-animation="animated fadeInRight">Your favorite Channels & all the Latest Episodes</h4>
								<h2 data-animation="animated fadeInRight">FREE  Now on <a href="#">awaan.ae</a></h2>
							</div>
						</div>
					</div>
					<div class="item">
						<img src="{{asset("images/smart-tv-banner-3.jpg")}}" class="slide-img img-responsive" title="smart-tv-banner3" alt="smart-tv-banner3">
						<div class="carousel-caption">
							<div class="caption-image" data-animation="animated flipInX">
								<img src="{{asset("images/logo-medium.png")}}" class="caption-img" title="Awaan" alt="Awaan" />
							</div>
							<div class="caption-content">
								<h4 data-animation="animated fadeInRight">Your favorite Channels & all the Latest Episodes</h4>
								<h2 data-animation="animated fadeInRight">FREE  Now on <a href="#">awaan.ae</a></h2>
							</div>
						</div>
					</div>
				</div>

				<!-- Controls -->
				<!--<a class="left carousel-control" href="#Smarttvbanner-carousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#Smarttvbanner-carousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>-->

			</div>

		</div>
		<!-- BANNER WRAPPER [END] -->


		<!-- CONTENT WRAPPER [START] -->
		<div class="content-wrapper">
			<div class="smarttv-content-wrapper">

				<div class="container">
					<div class="smarttv-content-cotnainer">

						<img src="{{asset("images/smart-samsung-tvs.png")}}" class="img-responsive center-block" title="smart-samsung-tvs" alt="smart-samsung-tvs" />
						<h4 class="smarttv-text">Awaan Video on Demand (VOD) gives you unlimited access to thousands of premium content from different categories such as entertainment, drama, news, etc..</h4>

					</div>
				</div>

			</div>
			<div class="smarttv-tvtype-wrapper">

				<div class="container">
					<div class="smarttv-tvtype-cotnainer">

						<img src="{{asset("images/logo-medium.png")}}" class="img-repsonsive" title="Awaan" alt="Awaan" />
						<h4 class="smarttv-tvtype-info">
							Enjoy watched live streaming, catchup, or VOD content from any smart device or smart tv and <br/>
							<span>for free.</span>
						</h4>
						<ul class="list-inline smarttv-tvtype-list">
							<li><a href="#"><img src="{{asset("images/smarttv-appletv.png")}}" class="img-responsive" title="smarttv-appletv" alt="smarttv-appletv" /></a></li>
							<li><a href="#"><img src="{{asset("images/smarttv-samsungtv.png")}}" class="img-responsive" title="smarttv-samsungtv" alt="smarttv-samsungtv" /></a></li>
							<li><a href="#"><img src="{{asset("images/smarttv-humaxtv.png")}}" class="img-responsive" title="smarttv-humaxtv" alt="smarttv-humaxtv" /></a></li>
							<li><a href="#"><img src="{{asset("images/smarttv-chromecasttv.png")}}" class="img-responsive" title="smarttv-chromecasttv" alt="smarttv-chromecasttv" /></a></li>
							<li><a href="#"><img src="{{asset("images/smarttv-iostv.png")}}" class="img-responsive" title="smarttv-iostv" alt="smarttv-iostv" /></a></li>
							<li class="border-no"><a href="#"><img src="{{asset("images/smarttv-androidtv.png")}}" class="img-responsive" title="smarttv-androidtv" alt="smarttv-androidtv" /></a></li>
						</ul>

					</div>
				</div>

			</div>
		</div>
		<!-- CONTENT WRAPPER [END] -->

	</div>

	<!-- LOGIN MODAL [START] -->
	@include('login_modal')
	<!-- LOGIN MODAL [END] -->

	<!-- REGISTER MODAL [START] -->
	@include('register_modal')

	<script>
        $('body').addClass('loaded');
	</script>
	
@endsection
<!-- MAIN CONTAINER [END] -->
