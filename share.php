<?php
session_start();

$id = $_GET['id'];
$config_log_path = $_SERVER['DOCUMENT_ROOT'].'/facebook.txt';

if(isset($_GET['debug'])){
    echo @file_get_contents("http://admin.mangomolo.com/analytics/index.php/share?id={$id}");
    return false;
}

//https://developers.facebook.com/docs/sharing/webmasters/crawler
$pattern = '/(FacebookExternalHit|Facebot)/i';

$twitter_pattern = '/(Twitterbot)/i';
$GoogleBotPattern = '/(GoogleBot|Google)/i';

$agent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_ENCODED);


if(preg_match($pattern,$agent)) {
    //Facebook User-Agent
    //$current = $agent . "\n";
    //file_put_contents($config_log_path, $current, FILE_APPEND);

    //$url = explode("/", $_GET['id']);//dcndigital.ae/share.php?id=show/205098/larry-king-now-29-01-2014/245969/8047
    //if(count($url) >= 3){
    echo @file_get_contents("http://admin.mangomolo.com/analytics/index.php/share?id={$id}");
    //}

}elseif (preg_match("/twitterbot/i", $_SERVER['HTTP_USER_AGENT'])){
    echo @file_get_contents("http://admin.mangomolo.com/analytics/index.php/share/twitter?id={$id}");

}elseif (preg_match($GoogleBotPattern,$agent)){
    echo @file_get_contents("http://admin.mangomolo.com/analytics/index.php/share/google?id={$id}");

}else{
    if($id > 0){
        $build = @file_get_contents("http://admin.mangomolo.com/analytics/index.php/share/build?id={$id}");
        echo '<script>location.replace("'.$build.'");</script>';

//        $current = $_SESSION['HTTP_REFERER'] . "\n";
//        file_put_contents($config_log_path, $current, FILE_APPEND);
    }else{
        echo '<script>location.replace("http://awaan.ae/#/");</script>';
    }
}