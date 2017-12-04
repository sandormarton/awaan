<?php
/*
 * Copyright © 2016 DOTCOM Offshore, All Rights Reserved
 *
 * [This is the page ID ]
 * $id: Apis.php
 * Created:        @wissamsabbagh    Apr 20, 2016 | 1:19:02 PM
 * Last Update:    @wissamsabbagh    Apr 20, 2016 | 1:19:02 PM
 */

namespace App\Http\Controllers;

/* here call the name spaces of the base  controlter
 *
 */

//use App\Http\Controllers\Controller;
/**
 * Use the custome APi library
 *
 * @return void
 */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Providers\ApiRequest;
use \View;

//use Illuminate\Foundation\Exceptions\Handler;

class Video extends BaseController
{
    private $video_response = '';
    var $user;

    public function __construct(Request $request)
    {
        parent::__construct();
        $this->user = ($request->session()->has('user_info')) ? (object)$request->session()->get('user_info') : false;
    }

    public function watch(Request $request)
    {
        $vid = $request->segment(2);
        $offset = $request->input('t');
        $current = '';
//        echo $vid;
        if(!$request -> ajax()) {
            $apiobj = new ApiRequest([
                'video_id' => $vid,
                'limit_sv' => 6,
                'start_sv' => 0,
            ]);
        }else{
            $apiobj = new ApiRequest([
                'video_id' => $vid,
                'limit_sv' => 6,
                'start_sv' => !empty($request -> get("p"))?($request -> get("p"))*6:6,
            ]);
        }
        $this->video_response = json_decode($apiobj->GetVideo());

        /* Get item from the object
          @param $video_response the object
         * @param video  the item to be returned
         *
         */

        if (is_object($this->video_response) && is_object($this->video_response->video)) {
            $videocontent = object_get($this->video_response, 'video');
            $videocontent->rating = $this->parseVideoRating();
        } else {
            return redirect()->to('relatedshows/30348/مسلسلات');
            //return response()->view('errors.custom', [], 404);
        }
        $videocontent->ch_meta = $apiobj->getChannelSettings()->ch_meta;

        $videocontent->geo_deny = $this->checkGeoVideo($videocontent, $request);

        if (isset($videocontent) && $videocontent->premium == 1) {
            if ($this->user) {
                $check = $apiobj->subscribeCheck($this->user->id);
                if (isset($check->status) && strtolower($check->status) != 'active')
                    return redirect()->to('gold');
            } else {
                return redirect()->to('gold');
            }
        }


        $featuredshows = object_get($this->video_response, 'featuredshows');
        //store the current season to display it in the selected
        $shows_seasons = object_get($this->video_response, 'ShowSeasons');

//        $current = $videocontent = $featuredshows = $featuredshows = '';
        if (sizeof($shows_seasons) > 0) {
            $current = $shows_seasons[0];
            unset($shows_seasons[0]);
        }
        if (!isset($current->shows_parent[0]->title_ar)) {
            //return response()->view('errors.custom', [], 404);
        }
        /* remove the selected to avoid duplications */
        //$this->parseVideoRating();

        /* generate base url */
        $shareurl = url('/') . '/video/' . $videocontent->id . '/' .\App\Helpers\Functions::cleanurl($videocontent->title_ar);
//        $shortenurl = $apiobj->ShortenURL($shareurl);
        $shortenurl = $shareurl;

        /* Parse the video signature */
        $video_signature = $this->parseVideoUrl($videocontent->embed)['signature'][0];

//        $videocontent->embed = str_replace("%", "%25", $videocontent->embed);
        $this->data['currentseasons'] = $current;
        $this->data['otherseasons'] = $this->video_response->ShowSeasons;
        $this->data['featuredshows'] = $featuredshows;
        $this->data['content'] = $videocontent;
        if(isset($videocontent->parent_id) && !empty($videocontent->parent_id) && ($videocontent->parent_id == 208109)){
            $api = new ApiRequest([
                'limit'=>4,
            ]);
            $videoid = $videocontent->id;
            $this->data['videoDetailedAflam'] = $api->getMovieDetails($videoid);
        }
        $this->data['shareurl'] = $shortenurl;
        $this->data['videosignature'] = $video_signature;
        $this->data['vid'] = $vid;
        $this->data['offset'] = $offset;
        $this->data['categories'] =  $this->video_response->Categories;
        $this->data['channel_userid'] =  ($request->session()->has('user_info')) ? $request->session()->get('user_info')->id : false;
        $this->data['api'] =  $apiobj;
        if(!$request -> ajax()) {
            return $this -> view('videos.video_embedd');
        }else{
            $contents = $this -> view('videos._single_video_item')->render();
            $result['html'] = $contents;
            $result['count'] = count( $this->data['currentseasons']->videos);
            return $result;
        }

    }

    private function checkGeoVideo($video, $request)
    {
        $ip = $this->getRealIpAddr($request);
        $geodata = geoip_record_by_name($ip);
//         $geo_code = $geodata['']
        $country_code = $geodata['country_code'];
        $video_info['geo_deny'] = 0;
        if ($video->geo_status == 'allowed') {
            $geo_countries = explode(",", $video->geo_countries);

            if (!in_array("$country_code", $geo_countries)) {
                $video_info['geo_deny'] = 1; //This Video is Not Available in Your Country
            }
        }
        if ($video->geo_status == 'not_allowed') {
            $geo_countries = explode(",", $video->geo_countries);
            if (in_array("$country_code", $geo_countries)) {
                $video_info['geo_deny'] = 1; //This Video is Not Available in Your Country
            }
        }

        return $video_info['geo_deny'];
    }


    static function getRealIpAddr($request)
    {
        // Logic : if remote_addr equal to x_forwarded_for, then thats the real ip
        // otherwise x_forwarded_for contains a list of IP, the most to the left may be the real ip, but we have to filter out reserved IPs
        $ip = $request->server->get('REMOTE_ADDR');
        if ( $request->server->get('HTTP_X_FORWARDED_FOR') === $request->server->get('REMOTE_ADDR') ) {
            $ip = $request->server->get('REMOTE_ADDR');
        } elseif (!empty($request->server->get('HTTP_X_FORWARDED_FOR'))) {
            $ips = preg_split("/[\s,]+/", $request->server->get('HTTP_X_FORWARDED_FOR') );
            $wehaveip = false; $i = 0;
            while ( ( $wehaveip == false ) && ( $i < count( $ips)) ) {
                if ( filter_var( $ips[ $i], FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    $ip = $ips[ $i];
                    $wehaveip = true;
                } else {
                    $i++;
                }
            }
        }
        return $ip;
    }

    private function parseVideoUrl($code = '')
    {
        /* Get query portion from url */
        if (!empty($code)) {
            $video_embedd = parse_url($code, PHP_URL_QUERY);

            $querystring_portion = explode('&', $video_embedd);
            foreach ($querystring_portion as $param) {
                list($name, $value) = explode('=', $param);
                $params[urldecode($name)][] = urldecode($value);
            }
            return $params;
        }
    }


    private function parseVideoRating()
    {
        if (is_object($this->video_response->video)) {
            $rate_value = object_get($this->video_response->video, 'rate_value');
            switch ($rate_value) {
                case 1:
                    $starcount = 1;
                    break;
                case 2:
                    $starcount = 2;
                    break;
                case 3 :
                    $starcount = 3;
                    break;
                case 4 :
                    $starcount = 4;
                    break;
                case 5 :
                    $starcount = 5;
                    break;
                default :
                    $starcount = 0;
            }

            return $starcount;
        }
    }

    public function GetUserResume(Request $request)
    {
        if (!$this->user)
            return redirect()->to('/');

        $core_user = Session::get('user_info');
        $api = new ApiRequest();
        $categories = $api->getCategories();
        $resume = $api->resumeList($core_user->id);

        echo view('videos.resume', compact('categories', 'resume'))->render();
    }

    public function GetUserFavorites(Request $request)
    {
        if (!$this->user)
            return redirect()->to('/');

        $core_user = Session::get('user_info');
        $api = new ApiRequest();
        $favorites_videos_rows = '';
        $categories = $api->getCategories();
        $fav_videos = $this->getFavoritesVideos($core_user->id);
        foreach ($fav_videos as $item) {
            if(isset($item['parent']) and !empty($item['parent']) and (count($item['parent']) > 0) and isset($item['parent']['id']) and !empty($item['parent']['id']) and ($item['parent']['id']== 208109) )
            {
                continue;
            }
            $this->data['item'] = $item;
            $favorites_videos_rows .= $this -> view('videos.favorites_videos_rows');
        }

        $this->data['categories'] = $categories;
        $this->data['favorites_videos_rows'] = $favorites_videos_rows;
        $html = $this -> view('videos.favroties_videos')->render();
        echo $html;
    }

    public function GetUserFavoritesFilms(Request $request)
    {
        if (!$this->user)
            return redirect()->to('/');

        $core_user = Session::get('user_info');
        $api = new ApiRequest();
        $favorites_films_rows = '';
        $categories = $api->getCategories();
        $fav_videos = $this->getFavoritesVideos($core_user->id);
        foreach ($fav_videos as $item) {
            if(isset($item['parent']) and !empty($item['parent']) and (count($item['parent']) > 0) and isset($item['parent']['id']) and !empty($item['parent']['id']) and ($item['parent']['id']== 208109) )
            {
                $this->data['item'] = $item;
                $favorites_films_rows .= $this -> view('videos.favorites_films_rows');
            }
        }

        $this->data['categories'] = $categories;
        $this->data['favorites_films_rows'] = $favorites_films_rows;
        $html = $this -> view('videos.favroties_films')->render();
        echo $html;
    }

    //temporary
    private function getFavoritesVideos($uid)
    {

        $url = "http://admin.mangomolo.com/analytics/index.php/plus/favorites?user_id=" . config('mangoapi.user_id') . "&channel_userid=" . $uid . "&key=" . config('mangoapi.apikey'). "&t=".time();
        if (!empty($url)) {
            $responses = json_decode(file_get_contents($url), true);
        }
        return ($responses);
    }

    public function index()
    {

    }

    public function open_notification($notification_id,$id,$title = ""){
        if(Session::has('user_info')){
            $api = new ApiRequest();
            $rec = $api->makeNotificationSeen(Session::get('user_info')->id,$notification_id);
            return redirect()->to("video/{$id}/".\App\Helpers\Functions::cleanurl($title));
        }else{
            return redirect()->to('/');
        }
    }

}
