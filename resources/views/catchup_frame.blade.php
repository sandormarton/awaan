
<link rel="stylesheet" type="text/css" href="{{ asset("/css/bootstrap.min.css")}}" />
<link rel="stylesheet" type="text/css" href="{{asset("/css/owl.carousel.css")}}" />
<link rel="stylesheet" type="text/css" href="{{asset("/css/template.css")}}" />
<link rel="stylesheet" type="text/css" href="{{asset("/css/ionicons.min.css")}}" />

<script type="text/javascript" src="{{asset("/js/jquery.min.js")}}"></script>
<script type="text/javascript" src="{{asset("/js/bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("/js/owl.carousel.min.js")}}"></script>


<div class="innerpage-leftbar">

	<div class="catchup-wrapper">
		<div class="col-lg-9 col-md-8 catchup-main-container">

			<div class="catchup-content-wrapper">
				<div class="clearfix">
					<div class="catchup-player-wrapper">
						<div class="embed-responsive embed-responsive-16by9">
							@if(!is_null($video) && $video->id)
								<iframe class="embed-responsive-item" id="video_player" src="http://admin.mangomolo.com/analytics/index.php/customers/embed/video?id={{$video->id}}&user_id={{$video->user_id}}&countries=Q0M=&w=100%&h=100%&filter=DENY&signature={{$video->signature}}" scrolling="no" allowtransparency allowfullscreen></iframe>
							@else
								<iframe class="embed-responsive-item" src="http://admin.mangomolo.com/analytics/index.php/customers/embed/index?id={{base64_encode($channel->user_id)}}&channelid={{base64_encode($channel->id)}}&countries=Q0M=&w=100%&h=100%&filter=DENY&signature={{$channel->signature}}&jwplayer=6" scrolling="no" allowtransparency allowfullscreen></iframe>
							@endif
						</div>
					</div>
					<div class="catchup-programs-wrapper">

						<div class="catchup-programs-container">

							<div class="catchup-programs-title-section">
								<h3 class="catchup-title text-right">{{$channel->title_ar}}</h3>
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li  class="@if(!is_null($tab) && $tab == 3)  active @endif" role="presentation"><a href="#nextonext" aria-controls="nextonext" role="tab" data-toggle="tab">{{date('d/m',strtotime("-2 days"))}}</a></li>
									<li  class="@if(!is_null($tab) && $tab == 2)  active @endif" role="presentation"><a href="#tomorrow" aria-controls="tomorrow" role="tab" data-toggle="tab">{{date('d/m',strtotime("-1 days"))}}</a></li>
									<li  class="@if(!is_null($tab) && $tab == 1)  active @endif" role="presentation" class="active"><a href="#today" aria-controls="today" role="tab" data-toggle="tab">Today</a></li>
								</ul>
							</div>

							<div class="tab-content">
								<div class="tab-pane fade @if(!is_null($tab) && $tab == 3) in active @endif" id="nextonext">
									<div class="catchup-programs-list-wrapper">
										<div id="catchup-programs-video-list-aftertomorrow" class="content-module-video-list catchup-programs-video-list">
											@foreach($catchup->b4yesterday as $item)
												{{--*/ $item->title_slug = \App\Helpers\Functions::cleanurl($item->title_ar) /*--}}
												{{--*/ $channel->title_en = \App\Helpers\Functions::cleanurl($channel->title_en) /*--}}
												<div class="item video-list-div">
													<div class="video-list-item">
														<div class="video-list-image">
															<a href="{{URL::to("catchup_frame/$channel->id/$channel->title_en/$item->id/$item->title_slug/3")}}"><img src="{{$item->catchup_img}}" class="img-responsive" title="{{$item->title_ar}}" alt="{{$item->title_ar}}"/></a>
														</div>
														<div class="video-list-content">
															<a href="{{URL::to("catchup_frame/$channel->id/$channel->title_en/$item->id/$item->title_slug/3")}}" class="video-list-title">{{str_limit($item->title_ar,20)}}</a>
															<label class="video-category">{{date("H:i", strtotime($item->start_time))}}</label>
														</div>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								</div>
								<div role="" class="tab-pane fade @if(!is_null($tab) && $tab == 2) in active @endif" id="tomorrow">
									<div class="catchup-programs-list-wrapper">
										<div id="catchup-programs-video-list-tomorrow" class="content-module-video-list catchup-programs-video-list">
											@foreach($catchup->yesterday as $item)
												{{--*/ $item->title_slug = \App\Helpers\Functions::cleanurl($item->title_ar) /*--}}
												{{--*/ $channel->title_en = \App\Helpers\Functions::cleanurl($channel->title_en) /*--}}
												<div class="item video-list-div">
													<div class="video-list-item">
														<div class="video-list-image">
															<a href="{{URL::to("catchup_frame/$channel->id/$channel->title_en/$item->id/$item->title_slug/2")}}"><img src="{{$item->catchup_img}}" class="img-responsive" title="{{$item->title_ar}}" alt="{{$item->title_ar}}"/></a>
														</div>
														<div class="video-list-content">
															<a href="{{URL::to("catchup_frame/$channel->id/$channel->title_en/$item->id/$item->title_slug/2")}}" class="video-list-title">{{str_limit($item->title_ar,20)}}</a>
															<label class="video-category">{{date("H:i", strtotime($item->start_time))}}</label>
														</div>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								</div>
								<div role="" class="tab-pane fade @if(!is_null($tab) && $tab == 1) in active main_tab @endif" id="today">
									<div class="catchup-programs-list-wrapper">
										<div id="catchup-programs-video-list-today" class="content-module-video-list catchup-programs-video-list">
											@foreach($catchup->today_catch as $item)
												{{--*/ $item->title_slug = \App\Helpers\Functions::cleanurl($item->title_ar) /*--}}
												{{--*/ $channel->title_en = \App\Helpers\Functions::cleanurl($channel->title_en) /*--}}
												<div class="item video-list-div">
													<div class="video-list-item">
														<div class="video-list-image">
															<a href="{{URL::to("catchup_frame/$channel->id/$channel->title_en/$item->id/$item->title_slug/1")}}"><img src="{{$item->catchup_img}}" class="img-responsive" title="{{$item->title_ar}}" alt="{{$item->title_ar}}"/></a>
														</div>
														<div class="video-list-content">
															<a href="{{URL::to("catchup_frame/$channel->id/$channel->title_en/$item->id/$item->title_slug/1")}}" class="video-list-title">{{str_limit($item->title_ar,20)}}</a>
															<label class="video-category">{{date("H:i", strtotime($item->start_time))}}</label>
														</div>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>

<script>
	jQuery(document).ready(function () {
//		jQuery('#catchup-channel-list-ul').owlCarousel({
//			navText: [ '<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>' ],
//			rtl:false,
//			loop:true,
//			margin:0,
//			nav:true,
//			responsive:{
//				0: {
//					items: 2
//				},
//				470: {
//					items: 3
//				},
//				767: {
//					items: 3
//				},
//				991: {
//					items: 5
//				},
//				2000: {
//					items: 5
//				}
//			}
//		});

		$('.tab-content .active').find('.catchup-programs-video-list').owlCarousel({
			navText: [ '<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>' ],
			rtl:false,
			loop:true,
			margin:20,
			nav:true,
			responsive:{
				0: {
					items: 1
				},
				470: {
					items: 2
				},
				767: {
					items: 2
				},
				991: {
					items: 3
				},
				2000: {
					items: 3
				}
			}
		});

		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			//$(e.target).find('.catchup-programs-video-list').data('owlCarousel').destroy();

			if($(e.target).attr('aria-controls') == 'today'){
				$('#catchup-programs-video-list-today').owlCarousel({
					navText: [ '<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>' ],
					rtl:false,
					loop:true,
					margin:20,
					nav:true,
					responsive:{
						0: {
							items: 1
						},
						470: {
							items: 2
						},
						767: {
							items: 2
						},
						991: {
							items: 3
						},
						2000: {
							items: 3
						}
					}
				});
			}
			if($(e.target).attr('aria-controls') == 'tomorrow'){
				$('#catchup-programs-video-list-tomorrow').owlCarousel({
					navText: [ '<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>' ],
					rtl:false,
					loop:true,
					margin:20,
					nav:true,
					responsive:{
						0: {
							items: 1
						},
						470: {
							items: 2
						},
						767: {
							items: 2
						},
						991: {
							items: 3
						},
						2000: {
							items: 3
						}
					}
				});
			}
			if($(e.target).attr('aria-controls') == 'nextonext') {
				$('#catchup-programs-video-list-aftertomorrow').owlCarousel({
					navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
					rtl: false,
					loop: true,
					margin: 20,
					nav: true,
					responsive: {
						0: {
							items: 1
						},
						470: {
							items: 2
						},
						767: {
							items: 2
						},
						991: {
							items: 3
						},
						2000: {
							items: 3
						}
					}
				});
			}

		});
	});
</script>