
<link rel="stylesheet" type="text/css" href="{{ asset("/css/bootstrap.min.css")}}" />
<link rel="stylesheet" type="text/css" href="{{asset("/css/owl.carousel.css")}}" />
<link rel="stylesheet" type="text/css" href="{{asset("/css/template.css")}}" />
<link rel="stylesheet" type="text/css" href="{{asset("/css/ionicons.min.css")}}" />

<script type="text/javascript" src="{{asset("/js/jquery.min.js")}}"></script>
<script type="text/javascript" src="{{asset("/js/owl.carousel.min.js")}}"></script>

<div class="innerpage-leftbar">

	<div class="livebroadcast-wrapper">

		<div class="col-lg-9 col-md-8 livebroadcast-player-container">
			<div class="livebroadcast-channel-list">
				<div id="livebroadcast-channel-list-ul" class="livebroadcast-channel-list-ul program-div-items">
					<div class="item video-list-div">
						@foreach($channels_list as $index => $info)
							@if($index > 0 && $index %2 == 0)
					</div> <div class="item video-list-div">
						@endif
						<div class="channelbox @if($info->id == Request::segment(2)) active @endif center-block" style="max-width: 180px">
							<a href="@if($info->premuim == 1) {{URL::to('gold')}} @else {{URL::to("live_frame/{$info->id}/{$info->title_en}")}}  @endif">
								<img src="http://admin.mangomolo.com/analytics/{{$info->live_icon}}" class="img-responsive img-circle center-block" title="{{$info->title_en}}" alt="{{$info->title_en}}" /></a>
							@if($info->premuim == 1)
								<span class="channel-type">Premium</span>
							@endif
						</div>
						@endforeach
					</div>
				</div>
			</div>

			<div class="livebroadcast-player-wrapper">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="http://admin.mangomolo.com/analytics/index.php/customers/embed/index?id={{base64_encode($channel->user_id)}}&channelid={{base64_encode($channel->id)}}&countries=Q0M=&w=100%&h=100%&filter=DENY&signature={{$channel->signature}}&jwplayer=7&vmap=awaan"  allowtransparency="true" allowfullscreen="true"></iframe>
				</div>
			</div>

		</div>

	</div>
</div>

<script>
	jQuery(document).ready(function () {
		jQuery('#livebroadcast-channel-list-ul').owlCarousel({
			navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
			rtl: true,
			loop: true,
			margin: 0,
			nav: true,
			responsive: {
				0: {
					items: 2
				},
				470: {
					items: 3
				},
				767: {
					items: 3
				},
				991: {
					items: 5
				},
				1200: {
					items: 5
				}
			}
		});
	});
</script>
