<?php
/*
 * Copyright © 2016 DOTCOM Offshore, All Rights Reserved
 *
 * [This is the page ID ]
 * $id: Apis.php
 * Created:        @tonyAssaad    Apr 18, 2016 | 1:19:02 PM
 * Last Update:    @tonyAssaad    Apr 18, 2016 | 1:19:02 PM
 */

namespace App\Http\Controllers;

/* here call the name spaces of the base  controlter
 *
 */

use App\Http\Controllers\Controller;
/**
 * Use the custome APi library
 *
 * @return void
 */
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use App\Providers\ApiRequest;
use Illuminate\Support\Facades\Lang;

class Shows extends BaseController {
    var $user;

    public function __construct(Request $request) {
        parent::__construct();
        $this->user = ($request->session()->has('user_info')) ? (object)$request->session()->get('user_info') : false;
    }

    public function indexBack(Request $request) {
         $showid = $request->segment(2);
        $season_id = $request->segment(4);
        $apiobj = new ApiRequest(['cat_id' => $showid, 'season_id' => $season_id]);
        $showdetails = json_decode($apiobj->getShowDetails());

        try{
            $showdetails->ch_meta = $apiobj->getChannelSettings()->ch_meta;
        }catch (\Exception $e){

        }

        if(empty($showdetails->ShowSeasons)){
           // return response()->view('errors.custom', ['messsage' => 'There is not content available for this show'], 404);
        }
        if(sizeof($showdetails->ShowSeasons > 0)) {
            $showseasons = current($showdetails->ShowSeasons);
        }

        if(empty($showseasons) || !is_object($showseasons)){
            return redirect()->to('');
        }
        $this->data['currentshow'] = $showseasons;
        $this->data['showid'] = $showid;
        $this->data['seasonid'] = $season_id;
        $this->data['content'] = $showdetails;
        return $this-> view('show'
        );
    }

    public function index(Request $request) {
        $user = $request -> session() -> get("user_info");
        if(Session::get('lang') == 'en'){
            $lang = 'en';
        }else{
            $lang = 'ar';
        }
        if(!$request -> ajax()) {
            if($user)
                $api = new ApiRequest([
                    'p' => !empty($request -> get("p"))?$request -> get("p"):1,
                    'limit' => 16,
                    'cast' => 1,
                    't' => time(),
                    'lang' => $lang,
                    'channel_userid' => $user->id
                ]);
            else
                $api = new ApiRequest([
                    'p' => !empty($request -> get("p"))?$request -> get("p"):1,
                    'limit' => 16,
                    'cast' => 1,
                    't' => time(),
                    'lang' => $lang,
                ]);
        }else {
            if($user)
                $api = new ApiRequest([
                    'p' => !empty($request -> get("p"))?($request -> get("p")):2,
                    'limit' => 16,
                    'lang' => $lang,
                    'channel_userid' => $user->id
                ]);
            else
                $api = new ApiRequest([
                    'p' => !empty($request -> get("p"))?($request -> get("p")):2,
                    'lang' => $lang,
                    'limit' => 16
                ]);
        }

        $showid = $request->segment(2);
        $season_id = $request->segment(4);

        if(!$request -> ajax()){
            $this->data['content'] = $api->getShowDetails($showid, $season_id);
//            dd($this->data['content']);

            if($this->data['content'] == null){
                return redirect()->to('');
            }

            $this->data['catid'] = $this->data['content']->cat->parent_id ;
            if($this->data['content']->cat->parent_id  == 208109){
                $isAflam = true;
                return $this-> view('showAflam');
            }else{
                $isAflam = false;
                return $this-> view('show');
            }

        }else{
            $result = array();
            $this->data['content'] = $api->getShowDetails($showid, $season_id);
            $this->data['catid'] = $this->data['content']->cat->parent_id ;
            $contents = $this -> view('show_list')->render();
            $result['html'] = $contents;
            $result['count'] = count( $this->data['content']->videos);
            return $result;
        }
    }

    public function indexAflam(Request $request) {
        $user = $request -> session() -> get("user_info");
        if(Session::get('lang') == 'en'){
            $lang = 'en';
        }else{
            $lang = 'ar';
        }

        $api = new ApiRequest();
        if($user){
            $api = new ApiRequest([
                't'=>time(),
                'channl_userid'=> $user->id,
            ]);
        }

        $videoid = $request->segment(2);


        $this->data['content'] = $api->getMovieDetails($videoid);

        if($this->data['content'] == null){
            return redirect()->to('');
        }
//        dd($this->data['content']);

        return $this-> view('showAflam');

    }

    public function test(Request $request) {
        $showid = $request->segment(2);
        $season_id = $request->segment(4);
        $apiobj = new ApiRequest(['cat_id' => $showid, 'season_id' => $season_id]);
        $showdetails = json_decode($apiobj->getShowDetails());

        try{
            $showdetails->ch_meta = $apiobj->getChannelSettings()->ch_meta;
        }catch (\Exception $e){

        }

        if(empty($showdetails->ShowSeasons)){
            // return response()->view('errors.custom', ['messsage' => 'There is not content available for this show'], 404);
        }
        if(sizeof($showdetails->ShowSeasons > 0)) {
            $showseasons = current($showdetails->ShowSeasons);
        }

        if(empty($showseasons) || !is_object($showseasons)){
            return redirect()->to('');
        }

        return view('show', ['categories' => $showdetails->Categories,
                'currentshow' => $showseasons,
                'showid' => $showid,
                'seasonid' => $season_id,
                'content' => $showdetails]
        );
    }

    /* Call the  Request object as  closure */
    public function getSeasonsVideos(Request $request) {
        if($request->ajax()) {
            $season_id = $request->input('seasonid');
            $api = new ApiRequest(array('season_id' => $season_id));
            $season_videos = json_decode($api->getVideosSeasons(), true);
            $html = view('show_seasons_videos', compact('season_videos'))->render();
            echo $html;
        }
    }

    public function GetAllShows() {
        $api = new ApiRequest();
        $show_contents = json_decode($api->GetShowPage(), true);
        $categories = $api->getCategories();
        $slides = $api->GetSlides();
        $featured_videos=$api->GetFeaturedVideos(20);

        return view('all_shows', ['show_content' => $show_contents,'featured_videos'=>$featured_videos, 'categories' => $categories, 'slides' => $slides]);
    }

    public function GetUserFavorites(Request $request) {

        if(!$this->user)
            return redirect()->to('/');

        $core_user = Session::get('user_info');

        $api = new ApiRequest();
        $favorites_shows_rows = '';
        $categories = $api->getCategories();
        $favorites_shows = ($this->getFavoritesShows($core_user->id));
        unset($favorites_shows['videos']); //remove videos array
        foreach($favorites_shows as $shows) {
            $this->data['shows'] = $shows;
            $favorites_shows_rows .= $this -> view('favorites_shows_rows')->render();

        }
        $this->data['categories'] = $categories;
        $this->data['favorites_shows_rows'] = $favorites_shows_rows;
        $html = $this -> view('favroties_shows')->render();
        echo $html;
    }

    //temporary
    private function getFavoritesShows($uid) {

        $url = "http://admin.mangomolo.com/analytics/index.php/plus/favorites_shows?user_id=".config('mangoapi.user_id')."&channel_userid=".$uid."&key=".config('mangoapi.apikey') . "&t=".time();
        if(!empty($url)) {
            $responses = json_decode(file_get_contents($url), true);
        }
        return ($responses);
    }

    public function More($type) {
        $api = new ApiRequest();
        $show_contents = json_decode($api->GetAllShowPage());
        $categories = $api->getCategories();
        $lang = Lang::get('content')['allshows']; // return entire lang array with specified index

        switch($type) {
            case'featured':
                $all_content = $show_contents->featuredshows;
                $other_content = ['route' => 'show',
                        'page_title_ar' => $lang['featuredVideos'],
                        'class' => 'all-vod-featured-show-more-wrapper'
                ];

                break;
            case'latest':
                if(!isset($show_contents->LatestVideos)){
                    return response()->view('errors.custom', ['messsage' => 'There is not content available for this show'], 404);
                }
                $all_content = $show_contents->LatestVideos;
                $other_content = ['route' => 'video',
                        'page_title_ar' => $lang['latestepisodes'],
                        'class' => 'all-vod-latest-show-more-wrapper'
                ];
                break;
            case'topwatched':
                $all_content = $show_contents->Most_Shows;
                $other_content = ['route' => 'video',
                        'page_title_ar' => $lang['mostviewed'],
                        'class' => 'all-vod-topwatched-show-more-wrapper'
                ];
                break;
            case'toprated':
                $all_content = $show_contents->top_videos;
                $other_content = ['route' => 'video', 'page_title_ar' => $lang['toprated']];
                break;
        }

        return view('all_vod', ['other_content' => $other_content, 'content' => $all_content, 'categories' => $categories]);
    }

    public function FetchAllShows(Request $request, $cat_id = -1) {
        $api = new ApiRequest();
        $lang = Lang::get('content')['allshows']; // return entire lang array with specified index
        $other_content = ['route' => 'show', 'page_title_ar' => $lang['allshows']];

        $categories = $api->getCategories();
        $color_array = array("#6ec386","#2a2b2c","#6188c6","#dce23b","#dfcde4","#e87f25","#305576","#93a5a4","#10b89b","#7e669c","#82cdb8","#c6c6c6","#efc515","#557580","#66bacd","#c3ce8c","#3766b0");
        $this -> data["color_array"] = $color_array;
        $this -> data["categories"] = $categories;

        $this -> data["other_content"] = $other_content;
        if(!$request -> ajax()){
            if(isset($categories[0]->id) and !empty($categories[0]->id)){
                $catid = $categories[0]->id;
                $this->data['cat_name'] = $categories[0];
            }
            if(!empty($cat_id)){
                if($cat_id == -1){
                    $this->data['cat_name'] = new \stdClass();
                    $this->data['cat_name']->title_ar = trans('content.whole.all_shows');
                    $this->data['cat_name']->title_en = trans('content.whole.all_shows');
                    $this->data['cat_name']->id = -1;
                    $catid = $cat_id;
                }
               $i = 0;
                $found = false;
                foreach($categories as $key => $value) {
                    if ($value->id == $cat_id) {
                        $found = true;
                        break;
                    }
                    $i++;
                }
                if($found == true){
                    $this->data['cat_name'] = $categories[$i];
                    $catid = $cat_id;
                }
            }else{

            }
            if($cat_id == 208109){
                $api = new ApiRequest(array('cat_id' => $catid,
                    'p' => !empty($request -> get("p"))?$request -> get("p"):1,
                    'limit' => 16,
                    'need_filters' => 1
                ));
                $this->data['content'] = $api->getCategryWithVideos();
            }else{
                $api = new ApiRequest(array('cat_id' => $catid,
                    'p_shows' => !empty($request -> get("p"))?$request -> get("p"):1,
                    'limit_shows' => 16,
                    'need_filters' => 1
                ));
                $this->data['content'] = $api->getCategryRelatedShow();
            }

//            dd($this->data['content']);
            $this->data['catid'] = $catid;
            return $this -> view('all_programs');
        }else{
            $catid = $request -> get("cat_id");
            if($catid == 208109){
                $api = new ApiRequest(array('cat_id' => $catid,
                    'p' => !empty($request -> get("p"))?$request -> get("p"):1,
                    'limit' => 16,
                    'production_year' => !empty($request -> get("production_year"))?$request -> get("production_year"):'',
                    'language' => !empty($request -> get("language"))?$request -> get("language"):'',
                    'order_type' => !empty($request -> get("order_type"))?$request -> get("order_type"):'',
                    'order' => !empty($request -> get("order"))?$request -> get("order"):'',
                    'channel_id' => !empty($request -> get("channel_id"))?$request -> get("channel_id"):'',
                    'need_filters' => 1
                ));
                $all = $api->getCategryWithVideos();
            }else{
                $api = new ApiRequest(array('cat_id' => $catid,
                    'p_shows' => !empty($request -> get("p"))?$request -> get("p"):1,
                    'limit_shows' => 16,
                    'production_year' => !empty($request -> get("production_year"))?$request -> get("production_year"):'',
                    'language' => !empty($request -> get("language"))?$request -> get("language"):'',
                    'order_type' => !empty($request -> get("order_type"))?$request -> get("order_type"):'',
                    'order' => !empty($request -> get("order"))?$request -> get("order"):'',
                    'channel_id' => !empty($request -> get("channel_id"))?$request -> get("channel_id"):'',
                    'need_filters' => 1
                ));
                $all = $api->getCategryRelatedShow();
            }

            if($catid == 208109){
                $this->data['content'] = $all->videos;
            }else{
                $this->data['content'] = $all->shows;
            }

            $this->data['catid'] = $catid;
            $contents = $this -> view('all_programs_list')->render();
            $result['html'] = $contents;
            $result['count'] = count( $this->data['content']);

            $lang_html = '<option>'.trans('content.whole.language').'</option>';
            foreach ($all->all_language as $langu){
                $lang_html .= ' <option value="'.$langu.'">'.trans('content.languanges.'.$langu).'</option>';
            }
            $date_html = '<option>'.trans('content.whole.order_date').'</option>';
            foreach ($all->available_years as $year){
                $date_html .= ' <option value="'.$year.'">'.$year.'</option>';
            }

            $channel_html ='<option value="channel" data-id="0">'.trans('content.whole.all_channels').'</option>';
            foreach($this->data['channels']  as $item){
                if(Session::get('lang') == 'ar'){
                    $title = $item->title_ar;
                }else{
                    $title = $item->title_en;
                }
                if(!empty($title) and $item->premuim != 1 and $item->id != 25){
                    $channel_html .='<option value="channel" data-id="'.$item->id.'">'.$title.'</option>';
                }
            }
            $result['channel_html'] =  $channel_html;
            $result['lang_html'] =  $lang_html;
            $result['date_html'] =  $date_html;
            return $result;
//            return response($contents)->header('x-load-more', $this->data["load_more"]);
        }

//        $this -> data["categories"] = $categories;
//        return $this -> view('all_programs');
    }

    public function getRelatedShows($catid, $slug,Request $request) {

        $api2 = new ApiRequest();

        $this->data['categories'] = $api2->GetCategories();
        //$this->data['most_watched_show'] = $api -> getMostWatchedShowInCategory($catid);
        $this->data['load_more'] = isset($this->data['relatedshows']) && sizeof($this->data['relatedshows'])>8;
        //get most show in this cat..
//        $this->data['page_title'] = $slug;

        if(!$request -> ajax()){
            $catid =  get("offset");
            $catid =  get("cat_id");
            $api = new ApiRequest(array('id' => $catid,
                'videos' => 1,
                'p' => !empty($request -> get("p"))?$request -> get("p"):1,
                'limit' => 9
            ));
            $this->data['relatedshows'] = $api->getCategryRelatedShow()->results;
            return view('programs_categories.index', [
                'content' => $this->data,
                'load_more' => $this->data['load_more']
            ]);
        }else{
            View::share('program_categories', $this->data['categories']);
            $contents = view('programs_categories.list_shows', ['content' => $this->data,]);
            return response($contents)->header('x-load-more', $this->data["load_more"]);
        }
    }

}
