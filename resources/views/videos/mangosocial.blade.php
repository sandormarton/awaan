
<?php
//$current_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$baseurl = url('/');
$current_url = $baseurl.'/video/'.$videoid.'/'. \App\Helpers\Functions::cleanurl($videotitle) ;
?>
<iframe id="i" title="Mango social" align="center" frameborder="0" scrolling="no" allowtransparency="true" style=" width: 300px; height: 260px; margin: 0 auto; display: table;" src="//social.mangomolo.com/public/?client_id=<?=config('mangoapi.apikey')?>&amp;video_id={{$videoid}}&amp;channel_id=52&amp;h=400&amp;w=100%&amp;type=plus&amp;current=<?=$current_url;?>&amp;twitter=<?=$current_url;?>&amp;title={{$videotitle}}&amp;via=OnAwaan"></iframe>