<?php
/*
 * Copyright © 2016 DOTCOM Offshore, All Rights Reserved
 *
 * [This is the page ID ]
 * $id: Apis.php
 * Created:        @wissamsabbagh    Apr 18, 2016 | 1:19:02 PM
 * Last Update:    @wissamsabbagh    Apr 18, 2016 | 1:19:02 PM
 */

namespace App\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Illuminate\Support\Facades\Cache;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

/**
 * This class will request given external Api.
 *
 * @param string|null $url
 *
 * @return Response
 */
class ApiRequest {
    private $client = '';
    private $url = '';
    private $extraquery = '';
    private $userid = '';

    public function __construct(array $options = array()) {
        if(!empty($options[key($options)])) {

            /* change later to full object
              $request = new Request('PUT', 'http://httpbin.org/put');
             *              */
            $this->extraquery = '&'.http_build_query($options);
        }
 
       return $this->client = new Client(['base_uri' => config('mangoapi.base_uri')]);
//       return $this->client = new Client(['handler' => $stack, 'base_uri' => config('mangoapi.base_uri')]);
    }

    private function SetRequest() {
        return $request = $this->client->request('GET', $this->url);
    }

    private function PostRequest($data) {

        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, $this->url);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curlObj);
        curl_close($curlObj);

        return $response;
    }

    /**
     * This method will return Home Api.
     *
     * @param string|null $url
     * @scope called from config
     * @action called from  config
     *
     * @return Response
     */
    public function getHomeApiResponses($limit_shows = 16) {
        $this->url = 'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.homeaction').'&p=1&limit_fs=10&p_fv=1&limit_fv=9&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&limit_shows='.$limit_shows.'&p_shows=1p=1&limit_fv=6&need_live=yes&t';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
        //return json_decode($responses, true);
    }

    public function getCategShows() {
        $this->url = 'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.categoryshows').'&key='.config('mangoapi.apikey').''.$this->extraquery.'&user_id='.config('mangoapi.user_id').'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return json_decode($responses);
    }

    public function GetChannelLiveStream() {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.channellivestream').'&key='.config('mangoapi.apikey').''.$this->extraquery.'&user_id='.config('mangoapi.user_id').'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }

        return ($responses);
    }

    /**
     * Show Detail
     * Get Videos of first Season
     * @string limit_s set the limit of Awaan Season (Mosalsalat), if equal 0 return no season
     * @string p_s for the start page of Awaan Season (Mosalsalat)
     * @string limit_fs set the limit featured shows, if equal to 0 return no feature shows

     * $string cat_id : show ID
     * @string no_cat , if equal to one return empty no categories
     * @return bool
     */
    public function getShowDetailsBack() {//http://admin.mangomolo.com/analytics/index.php/nand?scope=awaan&action=showsPage&user_id=71&key=e2c420d928d4bf8ce0ff2ec1&p_ms=1&limit_ms=3&p_ts=1&limit_ts=3&limit_fv=5&p_fv=1&limit_fs=3&p_fs=1&limit_s=2&p_s=1&limit_lv=10&p_lv=1&p_s=1&limit_lv=1&p_lv=1&no_cat=0
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.showdetails2').'&key='.config('mangoapi.apikey').$this->extraquery.'&p_ms=1&limit_ms=3&p_ts=1&limit_ts=3&limit_fv=5&p_fv=1&limit_fs=10&p_fs=1&limit_s=4&p_s=1&limit_lv=10&p_lv=1&p_s=1&limit_lv=1&p_lv=1&no_cat=0&limit_sv=0&most_videos=true&channel_user_id='.
                Session::get('user')['id'].'&user_id='.config('mangoapi.user_id').'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return ($responses);
    }

    public function getShowDetails($id, $seasonid = 0)
    {
        $season = 0;
        $showid = $id;
        if (isset($id) && !empty($id)) {
            $showid = $id;
        }
        if (strpos($this -> extraquery, 'channel_userid') !== false) {
            $this->url = config('mangoapi.base_uri') . 'index.php/plus/show?show_id=' . $showid . '&key=' . config('mangoapi.apikey') . '&season=' . $seasonid . '&user_id=' . config('mangoapi.user_id').$this -> extraquery."&ss=".time();
//            dd($this->url);
            $responses = $this->GetResponse(array('url' => $this->url));
            return \GuzzleHttp\json_decode($responses);
        }else{
            $this->url = config('mangoapi.base_uri') . 'index.php/plus/show?show_id=' . $showid . '&key=' . config('mangoapi.apikey') . '&season=' . $seasonid . '&user_id=' . config('mangoapi.user_id').$this -> extraquery;
//            dd($this->url);
            $responses = $this->GetResponse(array('url' => $this->url));
            return \GuzzleHttp\json_decode($responses);
        }
    }

    public function getMovieDetails($id, $seasonid = 0)
    {
        $videoid = $id;
        if (isset($id) && !empty($id)) {
            $videoid = $id;
        }
            $this->url = config('mangoapi.base_uri') . 'index.php/nand?scope='.config('mangoapi.clientscope').'&action=VideoWithProgramInfo&video_id=' . $videoid . '&full_info=yes&key=' . config('mangoapi.apikey') .$this -> extraquery.'&user_id='.config('mangoapi.user_id').'&limit=4&ss=1';
//            dd($this->url);
            $responses = $this->GetResponse(array('url' => $this->url));
            return \GuzzleHttp\json_decode($responses);
    }

    /**
     * Vidoes of Seasons
     * @string season_id : season id
     * @return void
     */
    public function getVideosSeasons() {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.seasonsvideo').'&key='.config('mangoapi.apikey').$this->extraquery.'&user_id='.config('mangoapi.user_id').'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    /**
     *  Shows Page
     * @string limit_s set the limit of Awaan Season (Mosalsalat)
     * @string p_s for the start page of Awaan Season (Mosalsalat)
     * @string limit_lv set the limit latest video, if equal 0 return no latetst video
     * @string p_lv for the start page of latest video
     * @string limit_fs set the limit featured shows, if equal to 0 return no feature shows
     * @string limit_ms set the limit most viewed shows
     * @string p_ms for the start page of most viewd shows, if equal to 0 return no most viewed shows
     * @string limit_ts set the limit top shows, if equal to zero return no to views shows
     * @string p_ts for the start page of  top shows
     * @string no_cat , if equal to one return empty no categories
     * @string imit_tv, set the limit of the top rated videos

     * @return bool
     */
    public function GetShowPage() {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.showspage').'&key='.config('mangoapi.apikey').'&p_ms=1&limit_ms=10&p_ts=1&limit_ts=15&limit_fv=15&p_fv=1&limit_fs=5&p_fs=1&limit_s=15&p_s=1&limit_lv=10&p_lv=1&p_s=1&limit_lv=10&p_lv=1&no_cat=0&most_videos=true&limit_tv=10&user_id='.config('mangoapi.user_id').'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return ($responses);
    }

    public function GetSlides() {
        $this->url = config('mangoapi.base_uri')."index.php/nand/getSlides?user_id=".config('mangoapi.user_id')."".$this->extraquery."&key=".config('mangoapi.apikey');
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function GetAllShowPage() {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.showspage').'&key='.config('mangoapi.apikey').'&p_ms=1&limit_ms=0&p_ts=1&limit_ts=15&limit_fv=0&p_fv=1&limit_fs=0&p_fs=1&limit_s=0&p_s=1&limit_lv=200&p_lv=1&p_s=1&no_cat=0&most_videos=true&limit_tv=200&user_id='.config('mangoapi.user_id').'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return ($responses);
    }

    /**
     * Awaan Drama
     * @string limit_s set the limit of   Season  if equal 0 no Awaan Season will be
     * @string p_s for the start page of   Season
     * $get_shows if set to 1, all shows will be fecthed
     * @return bool
     */
    public function GetSeries($getshow = 0) {
        $fetchshows = '';
        if(!empty($getshow) && $getshow == 1) {
            $fetchshows = '&get_shows=1';
        }
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.drama').'&key='.config('mangoapi.apikey').''.$fetchshows.'&p_s=1&user_id='.config('mangoapi.user_id').'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return ($responses);
    }

    /**
     * Get All Category Details and their related Shows
     * $string cat_id category id
     * @string limit_shows , limit for category shows, if equal to -1 no shows will be fetched
     * @string p_shows, start page for category shows
     * @return void
     */
    public function GetCategoryShows() {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.categorydetailsandshows').$this->extraquery.'&key='.config('mangoapi.apikey').'&p_s=1&user_id='.config('mangoapi.user_id').'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return ($responses);
    }

    /**
     * Awaan Video Page
     * @video_id video ID
     * @string limit_s set the limit of  Season , if equal 0 return no season
     * @string p_s for the start page of  Season
     * @string limit_fs set the limit featured shows, if equal to 0 return no feature shows
     * @string no_cat , if equal to one return empty no categories
     * @return void
     */
//http://admin.mangomolo.com/analytics/index.php/nand?scope=awaan&action=AwaanVideoPage&user_id=71&key=e2c420d928d4bf8ce0ff2ec1&video_id=26704506&limit_s=-1&p_s=1&limit_fs=10&no_cat=1

    public function GetVideo() {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.awaanvideopage').$this->extraquery.'&key='.config('mangoapi.apikey').'&p_s=1&limit_s=10&limit_fs=15&no_cat=0&channel_user_id='.Session::get('user')['id'].'&user_id='.config('mangoapi.user_id').'';

        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return ($responses);
    }

    /**
     * Awaan News
     * @string limit  number of fetched news, Default is 20
     * @return void
     */
//http://admin.mangomolo.com/analytics/index.php/nand?scope=awaan&action=getAwaanNews&user_id=71&key=e2c420d928d4bf8ce0ff2ec1&limit=10
    /**
     * Awaan News , Most Viewed
     * @string limit  number of fetched news, Default is 20
     * @return void
     */
//http://admin.mangomolo.com/analytics/index.php/nand?scope=awaan&action=getAwaanNewsMostViewed&user_id=71&key=e2c420d928d4bf8ce0ff2ec1&limit=3
    /**
     * Search Videos, Shows , Season
     * @string text  , text to be search for
     * @string limit, limit for number of fetched video result, Default is 20
     * @return void
     */
    public function FullSearch() {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action=searchVideosShowsSeasons&key='.config('mangoapi.apikey').'&limit=50&text='.$this->extraquery.'&user_id='.config('mangoapi.user_id').'';

        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return ($responses);
    }

    public function ShortenURL($longurl) {
// Get API key from : http://code.google.com/apis/console/
        $apiKey = 'AIzaSyAJkFcuTRNC5YnZiCVeeYMD8Cr_q3DNN_M';
//need new api
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.$apiKey);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, json_encode(array("longUrl" => $longurl)));
        $response = curl_exec($curlObj);
// Change the response json string to object
        $json = json_decode($response);
        curl_close($curlObj);
        return (isset($json->id) and !empty($json->id)) ? $json->id : false;
    }

    public function ShortenURL1($longurl) {
// Get API key from : http://code.google.com/apis/console/
        $apiKey = 'AIzaSyAJkFcuTRNC5YnZiCVeeYMD8Cr_q3DNN_M';
//need new api
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.$apiKey);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, json_encode(array("longUrl" => $longurl)));
        $response = curl_exec($curlObj);
// Change the response json string to object
        $json = json_decode($response);
        curl_close($curlObj);
        dd($json);
        return (isset($json->id) and !empty($json->id)) ? $json->id : false;
    }

    public function getFavoritesShows() {

        $this->url = "http://admin.mangomolo.com/analytics/index.php/plus/favorites_shows?user_id=".config('mangoapi.user_id')."".$this->extraquery."&key=".config('mangoapi.apikey');

        if(!empty($this->url)) {
            $responses = json_decode(file_get_contents($this->url), true);
        }
        return ($responses);
    }
    public function getChannelSettings() {
        $this->url = config('mangoapi.base_uri').'index.php/plus/settings?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }
//http://admin.mangomolo.com/analytics/index.php/nand?scope=awaan&action=categories&user_id=71&key=e2c420d928d4bf8ce0ff2ec1

    public function getCategories() {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action=categories&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function GetResponse(array $options) {
        try {
            //echo $options['url'];
            $response = $this->SetRequest($options['url']);
            if($response->getStatusCode() == 200) {
                return $response->getBody()->getContents();
            } else {
                throw \GuzzleHttp\Promise\exception_for('Failed');
            }
        } catch (\Exception $e) {

            //Catch the guzzle connection errors over here.These errors are something
            // like the connection failed or some other network error
            //$response = json_encode((string)$e->getResponse()->getBody());
            return false;
        }

        /*$response = $this->SetRequest($options['url']);
        if($response->getStatusCode() == 200) {
            return $response->getBody()->getContents();
        }*/
    }

    /**
     * Get live channel details
     * @param $channel_id
     * @return mixed
     */
    public function channelDetails($channel_id, $user_id = false) {

        if($user_id == 105) {
            $q = '5300babde7a853b5afb57bcbad9d6de0&user_id=105';
        }
        elseif($user_id == 102) {
            $q = 'e11ea32c0aa107416c0faff6930c977a&user_id=102';
        }
        else {
            $q = config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id');
        }

        $this->url = config('mangoapi.base_uri').'index.php/plus/getchanneldetails?key='.$q.'&channel_id='.$channel_id.'&t=';

        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    /**
     * @param $channel_id
     * @return mixed
     */
    public function catchup($channel_id) {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope=awaan&action=ChannelCatchup&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&channel_id='.$channel_id;
        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }

    /**
     * @return mixed
     */
    public function liveChannels() {
        $this->url = config('mangoapi.base_uri').'index.php/plus/live_channels?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&json=true&t=1';
        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }

    public function liveChannelsMixed() {
        $this->url = config('mangoapi.base_uri').'index.php/plus/live_channels?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&mixed=true';
        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }

    public function liveChannelsWithStream() {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope=awaan&action=getChannels&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id');
        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }

    /**
     * @param $channel_id
     * @return mixed
     */
    public function liveNext($channel_id) {
        $this->url = config('mangoapi.base_uri').'index.php/plus/live_next?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&channel_id='.$channel_id.'&t='.(time());

        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }

    /**
     * @param $channel_id
     * @return mixed
     */
    public function live($channel_id) {
        $this->url = config('mangoapi.base_uri').'index.php/plus/live?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&next_limit=2&channel_id='.$channel_id;

        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }

    /**
     * @return mixed
     */
    public function categoriesList() {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope=awaan&action=categories&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id');
        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }

    /**
     * Premium
     * subscribeCheck
     * stdClass Object
      (
      [id] => 866
      [channel_userid] => 8406
      [transactionId] => 110957963
      [paymentTransactionStatusCode] => 10
      [subscriptionContractId] => 9176704
      [amountCharged] =>
      [currencyCode] => SAR
      [operatorCode] => 966
      [msisdn] => 966592300951
      [nextPaymentDate] =>
      [productCatalogName] =>
      [productId] =>
      [verified] => 1
      [status] => active
      [created_time] => 2016-04-25 13:42:25
      [updated_at] => 2016-04-26 11:39:24
      )
     * @param $channel_userid
     * @return mixed
     */
    public function subscribeCheck($channel_userid) {
        $this->url = config('mangoapi.base_uri').'index.php/plus/subscribe_check?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&channel_userid='.$channel_userid.'';

        if(!empty($this->url)) {
            $responses = json_decode(file_get_contents($this->url));
            return $responses;
        }
        return [];
    }

    public function tpaySubscribe($data) {
        $this->url = config('mangoapi.base_uri').'index.php/tpay';

        if(!empty($this->url)) {
            $responses = $this->PostRequest($data);
        }

        return \GuzzleHttp\json_decode($responses);
    }


    public function tpayDev($data) {
        $this->url = config('mangoapi.base_uri').'index.php/tpaydev';

        if(!empty($this->url)) {
            $responses = $this->PostRequest($data);
        }

        return \GuzzleHttp\json_decode($responses);
    }

    /**
     * Awaan News
     * @string limit  number of fetched news, Default is 20
     * @return void
     */
    /**
     * Awaan News , Most Viewed
     * @string limit  number of fetched news, Default is 20
     * @return void
     */
    public function GetNews($actiontype, $limit = 30) {
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.'.$actiontype.'').'&key='.config('mangoapi.apikey').'&limit='.$limit.'&user_id='.config('mangoapi.user_id').'';
        //echo $this->url;
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    /*

     * Get the videos of the news by category
     *
     *      */
    public function GetNewsByCategory($limit = 20,$page = 1) {

        if(!empty(Session::get('user')['id'])) {
            $this->userid = '&channel_user_id='.Session::get('user')['id'];
        }
        $this->url = config('mangoapi.base_uri').'index.php/nand?scope='.config('mangoapi.clientscope').'&action='.config('mangoapi.seasonvideos').'&key='.config('mangoapi.apikey').$this->userid.'&limit='.$limit.$this->extraquery.'&p='.$page.'&user_id='.config('mangoapi.user_id').'';

        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function getVideoDetails($video_id) {
        $this->url = config('mangoapi.base_uri').'index.php/plus/video?&id='.$video_id.'&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id');
        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }

    public function getRelatedChannelShow() {
        $this->url = config('mangoapi.base_uri').'index.php/plus/category?o=channel&key='.config('mangoapi.apikey').$this->extraquery.'&user_id='.config('mangoapi.user_id');

        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }
    public function getCategryRelatedShowBack()
    {
        $this->url = config('mangoapi.base_uri') . 'index.php/plus/category?o=category&t=featured&key=' . config('mangoapi.apikey') . $this->extraquery . '&user_id=' . config('mangoapi.user_id');
        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }

    public function getCategryWithVideos()
    {
        $this->url = config('mangoapi.base_uri') . 'index.php/nand?scope='.config('mangoapi.clientscope').'&action=CategoryWithVideos&key=' . config('mangoapi.apikey') . $this->extraquery . '&user_id=' . config('mangoapi.user_id').'xx=1';
        $responses = $this->GetResponse(array('url' => $this->url));

//        echo  $this->url;
//        echo '<br>';
//        echo($responses);die();
        return \GuzzleHttp\json_decode($responses);
    }

    public function getCategryRelatedShow()
    {
        $this->url = config('mangoapi.base_uri') . 'index.php/nand?scope='.config('mangoapi.clientscope').'&action=CategoryDetailsandShows&key=' . config('mangoapi.apikey') . $this->extraquery . '&user_id=' . config('mangoapi.user_id').'';
        $responses = $this->GetResponse(array('url' => $this->url));
//        echo  $this->url;
//        echo '<br>';
//        echo($responses);die();
        return \GuzzleHttp\json_decode($responses);
    }

    public function getRelatedVideosInCat()
    {
        $this->url = config('mangoapi.base_uri') . 'index.php/nand/RelatedVideosInCat&key=' . config('mangoapi.apikey') . $this->extraquery . '&user_id=' . config('mangoapi.user_id').'';
        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }
    public function resumeList($channel_user_id) {

        $this->url = config('mangoapi.base_uri')."index.php/nand/getResumeList?channel_userid=".$channel_user_id."&user_id=".config('mangoapi.user_id')."".$this->extraquery."&key=".config('mangoapi.apikey');
        $responses = $this->GetResponse(array('url' => $this->url));
        return \GuzzleHttp\json_decode($responses);
    }

    public function premiumCategories() {
        $this->url = config('mangoapi.base_uri').'index.php/nand/premium_categories?&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id');

        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
                
        return \GuzzleHttp\json_decode($responses);
    }

    public function getAds($show_id='0', $video_id='0') {
        $this->url = config('mangoapi.base_uri').'index.php/api/getCode/'.$show_id.'/'.$video_id.'/'.config('mangoapi.user_id').'/'.config('mangoapi.apikey');

        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function getSuggested($show_id='0', $video_id='0', $check=false) {
//        $this->url = config('mangoapi.base_uri').'index.php/api/getSuggested/'.$show_id.'/'.$video_id.'/'.config('mangoapi.user_id').'/'.config('mangoapi.apikey').'/'.$check;
        $this->url = config('mangoapi.base_uri').'index.php/api/getSuggested/'.$show_id.'/'.$video_id.'/'.config('mangoapi.user_id').'/'.config('mangoapi.apikey');
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }


    public function getVideoAd($video_id='0') {
        $this->url = config('mangoapi.base_uri').'index.php/api/getads/'.$video_id.'/'.config('mangoapi.user_id').'/'.config('mangoapi.apikey');

        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    function getSchedule($channel_id) {
        //$url = 'http://admin.mangomolo.com/analytics/index.php/plus/GetSchedule?user_id=71&key=e2c420d928d4bf8ce0ff2ec1&channel_id=13';
        $this->url = config('mangoapi.base_uri').'index.php/plus/GetSchedule?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&channel_id='.$channel_id;
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    function get_category_info($id, $getparent = false) {

        $this->url = config('mangoapi.base_uri').'index.php/plus/season?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&show_id='.$id;

        $data = array();
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        $cat =  \GuzzleHttp\json_decode($responses,true);
        $cat = $cat['cat'];
        if($getparent) {
            $parent = array();
            $parent['id'] =  ( isset($cat['id'])) ? $cat['id'] : false;
            $parent['title_ar'] = ( isset($cat['title_ar'])) ? $cat['title_ar'] : false;
            return $parent;
//return $cat['title_ar'];
        }
        //recursive  the function to get the parent
        else {
            $parent = $this->get_category_info($cat['parent_id'], true);
            $cat['parentTitle'] = ( isset($parent['title_ar'])) ? $parent['title_ar'] : false;
            $cat['parentID'] = (isset($parent['id'])) ? $parent['id'] : false;
            return $cat;
        }
    }
    public function GetFeaturedVideos($limit='') {
        if(empty($limit)){
            $limit=20;
        }
        $this->url = config('mangoapi.base_uri').'index.php/nand/featured/?key='.config('mangoapi.apikey').'&limit='.$limit.'&user_id='.config('mangoapi.user_id');
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
            return \GuzzleHttp\json_decode($responses,true);
        }
    }

    function RelatedVideosInCat() {
        //$url = 'http://admin.mangomolo.com/analytics/index.php/plus/GetSchedule?user_id=71&key=e2c420d928d4bf8ce0ff2ec1&channel_id=13';
        $this->url = config('mangoapi.base_uri').'index.php/nand/RelatedVideosInCat?key='.$this->extraquery.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id');
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function getVideosByChannel($channel_id, $p = 1, $limit = 8, $sort = "desc",$publish = "yes",$categorized = true) {
        $query = "&".http_build_query([
            "channel_id" => $channel_id,
            "p" => $p,
            "limit" => $limit,
            "sort" => $sort,
            "publish" => $publish,
            "categorized" => $categorized,
        ]);
        $this->url = config('mangoapi.base_uri').'index.php/nand/getVideosByChannel?key='.$this->extraquery.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').$query;
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }
//admin.mangomolo.com/analytics/index.php/nand?scope = awaan&action = seasonVideos&user_id = 71&key = e2c420d928d4bf8ce0ff2ec1&limit = 10&cat_id = 6904&p = 1
//
//
//News reports
//
//admin.mangomolo.com/analytics/index.php/nand?scope = awaan&action = seasonVideos&user_id = 71&key = e2c420d928d4bf8ce0ff2ec1&limit = 10&cat_id = 8485&p = 1
//
//مدارات
//
//admin.mangomolo.com/analytics/index.php/nand?scope = awaan&action = seasonVideos&user_id = 71&key = e2c420d928d4bf8ce0ff2ec1&limit = 10&cat_id = 8633&p = 1

    public function getLatestUpdates($limit = 10) {
        $this->url = 'index.php/nand?scope='.config('mangoapi.clientscope').'&action=latest_updates&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&limit='.$limit.'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
        //return json_decode($responses, true);
    }

    public function getResumeVideos($channel_user, $limit = 10){
        $this -> url = "index.php/nand/getResumeVideos?user_id=".config('mangoapi.user_id')."&key=".config('mangoapi.apikey')."&channel_userid={$channel_user}&limit={$limit}&_t=".time();
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function getLatestEpisodes($page = 0,$limit = 104, $excluded = '',$type='all'){
        $this -> url = "index.php/nand/latest_videos?user_id=".config('mangoapi.user_id')."&key=".config('mangoapi.apikey')."&page={$page}&limit={$limit}&excluded={$excluded}&type={$type}";
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }


    public function getCatchupByDate($date,$channel_id = "", $p = 1, $limit = 10, $need_channel_info = "yes") {
        $this->url = 'index.php/plus/catchup_by_date?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&date='.$date.''.'&channel_id='.$channel_id.'&p='.$p.'&limit='.$limit.'&need_channel_info='.$need_channel_info.'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function login($email,$password) {
        $this->url = config('mangoapi.base_uri').'index.php/plus/login?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id');

        $responses = $this->PostRequest([
            'email' => $email,
            'password' => $password,
        ]);
        return \GuzzleHttp\json_decode($responses);
    }

    public function register($data) {
        $this->url = config('mangoapi.base_uri').'index.php/plus/register?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id');

        $responses = $this->PostRequest($data);
        return \GuzzleHttp\json_decode($responses);
    }

    public function getRadioChannels(){
        $this->url = 'index.php/nand?scope=audio&action=live_channels&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function getRadioLive($channel_id){
        $this->url = 'index.php/nand?scope=audio&action=live&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&channel_id='.$channel_id.'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function getRadioCatchup($channel_id,$date,$limit = 10,$p = 1){
        $this->url = 'index.php/nand?scope=audio&action=catchup_by_date&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&date='.$date.''.'&channel_id='.$channel_id.'&p='.$p.'&limit='.$limit.'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function getRadioShowDetails($show_id,$season = "",$p = 1,$limit = 6,$cast = "1", $times = "yes", $need_ordered_audios = "yes"){
        if(isset(Session::get('user_info')->id)){
            $this->userid = Session::get('user_info')->id;
            $this->url = 'index.php/nand?scope=audio&action=show&channel_userid='.$this->userid.'&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&show_id='.$show_id.''.'&season='.$season.'&p='.$p.'&limit='.$limit.'&cast='.$cast.'&times='.$times.'&need_ordered_audios='.$need_ordered_audios.$this->extraquery.'&_t='.time().'';
        }else{
            $this->url = 'index.php/nand?scope=audio&action=show&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&show_id='.$show_id.''.'&season='.$season.'&p='.$p.'&limit='.$limit.'&cast='.$cast.'&times='.$times.'&need_ordered_audios='.$need_ordered_audios.$this->extraquery.'';
        }

        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));

        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function getAudioInfo($id, $full = 0){
        $this->url = 'index.php/nand?scope=audio&action=audio_details&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&id='.$id.'&full='.$full;
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function getCategoriesInChannel($channel_id,$no_order = "yes",$is_radio = "0"){
        $this->url = 'index.php/plus/categories?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&channel_id='.$channel_id.'&no_order='.$no_order.'&is_radio='.$is_radio;
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function getFeaturedShows($channel_id = "0",$limit = "4",$is_radio = "0",$times="") {
        $this->url = 'index.php/plus/ondemand?key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&o=yes&t=featured&channel_id='.$channel_id.'&limit='.$limit.'&is_radio='.$is_radio.'&times='.$times.$this->extraquery;
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function getNotifications($channel_userid,$page=1,$limit=5){
        $this->url = 'index.php/nand?scope=notifications&action=list_notifications&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&channel_userid='.$channel_userid.'&page='.$page.'&limit='.$limit.$this->extraquery.'&_t='.time().'';
        //$this->url = 'index.php/nand?scope=notifications&action=list_notifications&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&channel_userid='.$channel_userid.'&page='.$page.'&limit='.$limit.$this->extraquery.'&_t='.floor(time()/120).'';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }

    public function makeNotificationSeen($channel_userid,$id){
        $this->url = 'index.php/nand?scope=notifications&action=make_seen&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&channel_userid='.$channel_userid.'&id='.$id.'&_t='.time();
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
    }


    function getRecommendedShows() {
        if(isset(Session::get('user_info')->id))
            $this->userid = Session::get('user_info')->id;

        $this->url = config('mangoapi.base_uri').'index.php/nand?scope=awaan&action=getRecommendedShows&channel_userid='.$this->userid.'&key='.config('mangoapi.apikey').'&user_id='.config('mangoapi.user_id').'&_t='.time();
        $responses = $this->GetResponse(array('url' => $this->url));

        if(!empty($responses)){
            return \GuzzleHttp\json_decode($responses);
        }
        return false;
    }

    public function getMostViewedCategories($device_id = "") {
        $this->url = 'index.php/plus/get_top_by_device_id?key='.config('mangoapi.apikey').'&user_id=71&device_id='.$device_id.'&from_date=2017-01-01%2000:00:00&to_date=2018-01-01%2000:00:00&type=categories';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
        //return json_decode($responses, true);
    }

    public function getMostViewedShows($device_id = "") {
        $this->url = 'index.php/plus/get_top_by_device_id?key='.config('mangoapi.apikey').'&user_id=71&device_id='.$device_id.'&from_date=2017-01-01%2000:00:00&to_date=2018-01-01%2000:00:00&type=shows';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
        //return json_decode($responses, true);
    }

    public function getVideosViews($device_id = "") {
        $this->url = 'index.php/plus/get_views_count?key='.config('mangoapi.apikey').'&user_id=71&device_id='.$device_id.'&from_date=2017-01-01%2000:00:00&to_date=2018-01-01%2000:00:00';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
        //return json_decode($responses, true);
    }

    public function getFavChannel($device_id = "") {
        $this->url = 'index.php/plus/get_top_by_device_id?key='.config('mangoapi.apikey').'&user_id=71&device_id='.$device_id.'&from_date=2017-01-01%2000:00:00&to_date=2018-01-01%2000:00:00&type=channels';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
        //return json_decode($responses, true);
    }

    public function getWeKnowData($device_id = "") {
        $this->url = 'index.php/plus/we_know_data?key='.config('mangoapi.apikey').'&user_id=71&device_id='.$device_id.'&from_date=2017-01-01%2000:00:00&to_date=2018-01-01%2000:00:00&type=shows&gg=11';
        if(!empty($this->url)) {
            $responses = $this->GetResponse(array('url' => $this->url));
        }
        return \GuzzleHttp\json_decode($responses);
        //return json_decode($responses, true);
    }
}
