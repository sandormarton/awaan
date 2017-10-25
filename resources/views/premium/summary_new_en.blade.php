@extends('layouts.master_inner')
@section('title', trans('content.pagetitle.premium.premium'))
<!--This defines a home  section which gets displayed via "yield" -->

@section('premium')
	<!-- MAIN CONTAINER [START] -->
	@include('show_innerright',['categories'=>$categories])


	<div class="innerpage-leftbar">

		<div class="mobile-menu visible-xs">
			<a href="{!! route('/') !!}"><img class="mobile-logo-g" src=" {{ asset("/images/logo-2.png")}}" title="AWAAN" alt="AWAAN" /></a>
			<button id='trigger' class="btn btn-mobile-menu"><i class="ion-navicon-round"></i></button>
		</div>
		<div class="premium-wrapper drama-list-wrapper">
			<div class="account-all-page-container developer7007-subscribe-new-page">

				<div class="col-md-12 account-list-container">
					<h3 class="title-container"><span data-i18n="account.title">Awaan Gold Package</span><a class="btn back-btn" href="http://www.awaan.ae/gold">{{trans('content.premiumsubscribe.backbutton')}}</a></h3>
					<div id="developer7007-subscribe-text-wrapper" class="row account developer7007-subscribe-text-wrapper">
						<div class="col-md-12">

							<div class="row subscribe-new-content-box">
								<div class="col-lg-2 col-md-3 subscribe-new-content-image">
									<a href="#">
										<img class="img-responsive img-circle center-block" src="http://awaan.ae/images/awaan-gold.png" alt="">
									</a>
								</div>
								<div class="col-lg-10 col-md-9 subscribe-new-content-text">
									<h4 class="media-heading">Awaan Gold Package</h4>
									<div class="row">
										<div class="col-lg-8 col-md-6 subscribe-new-content-text1">
											Contains all the parts of the historical series Hareem Al Sultan, in addition to the latest Gulf

											series (Dubai London Dubai, Bent w Shayeb, Yaman kont Habebe and more)
										</div>
										<div class="col-lg-4 col-md-6 subscribe-new-content-text2">
											{{--<h4 class="media-heading hidden-xs hidden-sm">البرامج المفضلة</h4>--}}
                                            <?php  //if (!empty($channel_favshows['dubai'])){ ?>
											<div id="subscribe-new-content-carousel-1" class="subscribe-new-content-carousel flexslider">
												<ul class="slides">
													<li class="image-box">
														<img class="img-responsive center-block" src="http://admango.cdn.mangomolo.com/analytics/uploads/71/images/tvshow/7/78fbb7c5451dadf773490df600c326c0-2.jpg" />
													</li>
													<li class="image-box">
														<img class="img-responsive center-block" src="http://admango.cdn.mangomolo.com/analytics/uploads/71/DubaiLondonDubai_P.jpg" />
													</li>
													<li class="image-box">
														<img class="img-responsive center-block" src="http://admango.cdn.mangomolo.com/analytics/uploads/71/BintwShaib_P1.jpg" />
													</li>
													<li class="image-box">
														<img class="img-responsive center-block" src="http://admango.cdn.mangomolo.com/analytics/uploads/71/images/tvshow/c/c156fb5618fd4691e5caa2195ab9af87.jpg" />
													</li>
												</ul>
											</div>
                                            <?php //} ?>
										</div>
									</div>
								</div>
							</div>


							<div class="row subscribe-new-content-box">
								<div class="col-lg-2 col-md-3 subscribe-new-content-image">
									<a href="#">
										<img class="img-responsive img-circle center-block" src="http://admin.mangomolo.com/analytics/uploads/71/icons/live/aloula-transparent.png" alt="">
									</a>
								</div>
								<div class="col-lg-10 col-md-9 subscribe-new-content-text">
									<h4 class="media-heading">SEEVII Al Oula</h4>
									<div class="row">
										<div class="col-lg-8 col-md-6 subscribe-new-content-text1">
											Offers a selection of the latest television series, and enables you to keep better track of the top

											Arab drama productions this year with a selection of high-quality serials from Egypt, Syria, the

											Gulf, Jordan and Lebanon.
										</div>
										<div class="col-lg-4 col-md-6 subscribe-new-content-text2">
											@if(!empty($channel_favshows['seeviprem']))
											<div id="subscribe-new-content-carousel-2" class="subscribe-new-content-carousel flexslider">
												<ul class="slides">
													@foreach($channel_favshows['seeviprem'] as $item)

													<li class="image-box">
														<img class="img-responsive center-block" src="{{$item->img}}" />
													</li>

													@endforeach

												</ul>
											</div>
											@endif
                                            <?php//}?>
										</div>
									</div>
								</div>
							</div>

							<div class="row subscribe-new-content-box">
								<div class="col-lg-2 col-md-3 subscribe-new-content-image">
									<a href="#">
										<img class="img-responsive img-circle center-block" src="http://admin.mangomolo.com/analytics/uploads/71/icons/live/dramatransparent.png" alt="">
									</a>
								</div>
								<div class="col-lg-10 col-md-9 subscribe-new-content-text">
									<h4 class="media-heading">SEEVII Drama</h4>
									<div class="row">
										<div class="col-lg-8 col-md-6 subscribe-new-content-text1">
											It is a distinctive entertainment channel that enables Arab viewers the chance to follow their

											favorite shows without commercial breaks. The channel contains a variety of high quality Arab

											series and programs from Egypt, the Gulf and Syria.
										</div>
										<div class="col-lg-4 col-md-6 subscribe-new-content-text2">
											@if(!empty($channel_favshows['seevidrama']))
											<div id="subscribe-new-content-carousel-4" class="subscribe-new-content-carousel flexslider">
												<ul class="slides">
													@foreach($channel_favshows['seevidrama'] as $item)

													<li class="image-box">
														<img class="img-responsive center-block" src="{{$item->img}}" />
													</li>

													@endforeach

												</ul>
											</div>
											@endif
										</div>
									</div>
								</div>
							</div>


							<div class="row subscribe-new-content-box">
								<div class="col-lg-2 col-md-3 subscribe-new-content-image">
									<a href="#">
										<img class="img-responsive img-circle center-block" src="http://admin.mangomolo.com/analytics/uploads/71/icons/live/shamiya-transparent.png" alt="">
									</a>
								</div>
								<div class="col-lg-10 col-md-9 subscribe-new-content-text">
									<h4 class="media-heading">SEEVII Shameya</h4>
									<div class="row">
										<div class="col-lg-8 col-md-6 subscribe-new-content-text1">
											A channel addressed especially for Syrian drama fans, as it offers elite Syrian TV productions

											that are being produced annually. It also allow  you to follow up on all programs without

											commercial breaks and offers a comprehensive entertainment content varies between drama,

											comedy and <historical class=""></historical>
										</div>
										<div class="col-lg-4 col-md-6 subscribe-new-content-text2">
											@if(!empty($channel_favshows['seevikanb']))
											<div id="subscribe-new-content-carousel-4" class="subscribe-new-content-carousel flexslider">
												<ul class="slides">
													@foreach($channel_favshows['seevikanb'] as $item)

													<li class="image-box">
														<img class="img-responsive center-block" src="{{$item->img}}" />
													</li>

													@endforeach
												</ul>
											</div>
											@endif
										</div>
									</div>
								</div>
							</div>


							<div class="row subscribe-new-content-box">
								<div class="col-lg-2 col-md-3 subscribe-new-content-image">
									<a href="#">
										<img class="img-responsive img-circle center-block" src="http://admin.mangomolo.com/analytics/uploads/71/icons/live/belinktransparent.png" alt="">
									</a>
								</div>
								<div class="col-lg-10 col-md-9 subscribe-new-content-text">
									<h4 class="media-heading">Seevii Beelink </h4>
									<div class="row">
										<div class="col-lg-8 col-md-6 subscribe-new-content-text1">
											A channel that offers the best TV series in the Arab world, and soon it will showcase the most

											important dubbed Turkish show.
										</div>
										<div class="col-lg-4 col-md-6 subscribe-new-content-text2">
											@if(!empty($channel_favshows['seevibeelink']))
											<div id="subscribe-new-content-carousel-5" class="subscribe-new-content-carousel flexslider">
												<ul class="slides">
													@foreach($channel_favshows['seevibeelink'] as $item)

													<li class="image-box">
														<img class="img-responsive center-block" src="{{$item->img}}" />
													</li>

													@endforeach


												</ul>
											</div>
											@endif
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>

		</div>

		@include('include.inner_footer')
		<script>
            $(".premium-wrapper").backstretch("http://admin.mangomolo.com/analytics/uploads/71/football-league-bg5.jpg", {centeredX: true, centeredY: true, fade: true});
            subscribe_cancellation();

		</script>
	</div>
	@endsection
	<!-- MAIN CONTAINER [END] -->
