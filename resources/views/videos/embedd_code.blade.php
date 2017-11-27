<div class="embed-responsive embed-responsive-16by9">
	<?php
		$id = Request::segment(2);
		$google_doubleclick = false;
		$ads = false;
		$companion = 0;

		if($id > 0){

			if(isset($show->premium) and $show->premium != 1){
				$apiobj = new \App\Providers\ApiRequest();
				$video_ad = $apiobj->getVideoAd($id);
				$ads = (isset($video_ad->preroll[0])) ? $video_ad->preroll[0] : false;
			}
			if(isset($ads) and $ads != false){
				//$ads = end($ads);
				if($ads->channel_type == 'all' and $ads->ad_type== 'double_click'  and $ads->companion == 1){
					$google_doubleclick = str_replace("correlator=","correlator=".time(),$ads->google_doubleclick);
					$google_doubleclick = urlencode($google_doubleclick);
					$companion = 1;
				}else{
					$video_ad = $apiobj->getSuggested(0, $id, 'verify');
//					if(is_array($video_ad)){
//						$video_ad = end($video_ad);
//						if(isset($show->cat_id) && $show->cat_id == 199235 && isset($video_ad->google_doubleclick_mid)){
//							$google_doubleclick1 = str_replace("correlator=","correlator=".time(),$video_ad->google_doubleclick);
//							$google_doubleclick2 = str_replace("correlator=","correlator=".time(),$video_ad->google_doubleclick_mid);
//							$google_doubleclick = urlencode($google_doubleclick1 ."||".$google_doubleclick2);
//						}else{
//							$google_doubleclick = str_replace("correlator=","correlator=".time(),$video_ad->google_doubleclick);
//							$google_doubleclick = urlencode($google_doubleclick);
//						}
//
//					}
                    if(is_array($video_ad)){
                        $video_ad = end($video_ad);
                        $google_doubleclick = "";
                        if(isset($show->cat_id) && isset($video_ad->google_doubleclick_mid) && !empty($video_ad->google_doubleclick_mid)){

                            if(is_object($video_ad->google_doubleclick_mid)){
                                $google_doubleclick2 = [];
                                foreach ($video_ad->google_doubleclick_mid as $idx => $tag){
                                    $google_doubleclick2[] = "{$tag}#{$idx}";
                                }
                                $google_doubleclick2 = array_filter($google_doubleclick2);
                                $google_doubleclick2 = implode(",", $google_doubleclick2);

								$video_ad->google_doubleclick = str_replace("correlator=","correlator=".time(),$video_ad->google_doubleclick);
								$google_doubleclick = urlencode($video_ad->google_doubleclick ."||".$google_doubleclick2);
                            }

                        }else{
                            if(isset($video_ad->google_doubleclick) && !empty($video_ad->google_doubleclick)){
                                $video_ad->google_doubleclick = str_replace("correlator=","correlator=".time(),$video_ad->google_doubleclick);
                                $google_doubleclick = urlencode($video_ad->google_doubleclick);
							}
                        }
                    }
				}
				//
			}

		}
		$detect = new \App\Helpers\Mobile_Detect();
		$jwplayer = 7;
		if($detect->version('Safari') <= 7){
			$jwplayer = 6;
		}
	?>
{{--	<iframe class="embed-responsive-item" id="video_embedd" src="{{$embeddcode}}&channel_userid={{$channel_userid}}&dfp={{$google_doubleclick}}&companion={{$companion}}&jwplayer={{$jwplayer}}&stretching=uniform#t={{$offset}}" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe>--}}
	<iframe title="{{$content->title_ar}}" class="embed-responsive-item" id="video_embedd" src="{{$embeddcode}}&channel_userid={{$channel_userid}}&vmap=awaan&jwplayer=7&stretching=uniform#t={{$offset}}" allowfullscreen="allowfullscreen" style="border: 0; overflow: hidden"></iframe>
</div>
