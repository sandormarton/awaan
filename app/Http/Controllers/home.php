<?php

namespace App\Http\Controllers;

/* here call the name spaces of the base  controlter

 *  */

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;
use \View;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Providers\ApiRequest;
use Illuminate\Support\Facades\Mail;
use \Validator;


class Home extends BaseController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $api = new ApiRequest();
        $this->data["home_data"] = $api->getHomeApiResponses();
        if(isset($this->data["home_data"]->all_shows) && is_array($this->data["home_data"]->all_shows))
            $this->data["home_data"]->all_shows = array_slice($this->data["home_data"]->all_shows,0,16);

        //$this->data["latest_updates"] = $api->getLatestUpdates();
        $this->data["catchup_items"] = $api->getCatchupByDate(date("Y-m-d"));
        $api = new ApiRequest(array('cat_id' => '208109',
            'p_shows' => 1,
            'limit_shows' => 16,
        ));
        $this->data['recommendedShows'] = $api->getRecommendedShows();

        //get resume list if needed.
        $this -> data["resume_list"] = "";
        $core_user = Session::get('user_info');
        if($core_user){
            $user = $core_user -> id;
            $this -> data["resume_list"] = $api -> getResumeVideos($user);
//            dd($this -> data["resume_list"]);
        }

        //get series categories.
        $api = new ApiRequest(array('cat_id' => '30348',
            'p_shows' => 1,
            'limit_shows' => 16,
        ));
        $this->data['series'] = $api->getCategryRelatedShow();

        //get movies.
        $api = new ApiRequest(array('cat_id' => '208109',
            'p' => 1,
            'limit' => 4,
        ));
        $this->data['movies'] = $api->getCategryWithVideos();

//        $contents = view('home.home')->with('channels');
//        return response($contents)->header('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60)));

        return $this->view('home.home');
    }

    public function latestEpisods(){
        $api = new ApiRequest();
        $this->data["content"] = $api->getLatestEpisodes();
        $this->data["page_title"] =  trans('content.whole.latestAdded') ;
//        dd($this->data["latest"]);
        return $this->view('home.latestEpisodes');
    }

    public function resumeList(){
        $api = new ApiRequest();
        $this -> data["content"] = "";
        $core_user = Session::get('user_info');
        if($core_user){
            $user = $core_user -> id;
            $this -> data["content"] = $api -> getResumeVideos($user,30);
        }

        $this->data["page_title"] = trans('content.whole.resume');
        return $this->view('home.resumeList');
    }
    public function youMaybeLike(){
        $api = new ApiRequest();
        $this -> data["content"] = "";
        $this->data['content'] = $api->getRecommendedShows();
        $this->data["page_title"] = trans('content.whole.recommended');
        return $this->view('home.recommendedList');
    }

    public function get_catchup_items(Request $request){
        $api = new ApiRequest();
        $date = $request->input("date");
        $channel_id = $request->input("channel_id");

        $this->data["catchup_items"] = $api->getCatchupByDate($date,$channel_id);
        return $this->view('home.home_catchup');
    }

    public function dev(){
        $api = new ApiRequest();
        $categories = $api->categoriesList();
        View::share('categories', $categories);

        $api = new ApiRequest(array('season_id' => 207537));
        $season_videos = $api->getVideosSeasons();
        //dd($season_videos);
        View::share('season_videos', $season_videos);

        $channels = $api->liveChannels();
        View::share('footer_channels', $channels);
        return view('dev.home');
    }

    /**
     * stdClass Object ( [id] => 6 [title_ar] => دبي الاولى [title_en] => Dubai Al Oula [description_ar] => [description_en] => [icon] => uploads/71/Dubai-Uola-Icon.png [cover] => uploads/71/Dubai-Uola-Icon.png [thumbnail] => uploads/71/Dubai-Uola-Icon.png [live_icon] => uploads/71/icons/live/Dubai-Uola-Icon.png [catchup_icon] => uploads/71/icons/catchup/Dubai-Uola-Icon.png [AppName] => dubaitv [StreamName] => dubaitv [Live_StreamName] => dubaitv_source [nDVR] => 0 [catchup] => 1 [premuim] => 0 [vip] => 1 [sort] => 1 [geo_status] => none [geo_countries] => AD,AE,AF,AG,AI,AL,AM,AO,AQ,AR,AS,AT,AU,AW,AX,AZ,BA,BB,BD,BE,BF,BG,BH,BI,BJ,BL,BM,BN,BO,BQ,BR,BS,BT,BV,BW,BY,BZ,CA,CC,CD,CF,CG,CH,CI,CK,CL,CM,CN,CO,CR,CU,CV,CW,CX,CY,CZ,DE,DJ,DK,DM,DO,DZ,EC,EE,EG,EH,ER,ES,ET,FI,FJ,FK,FM,FO,FR,GA,GB,GD,GE,GF,GG,GH,GI,GL,GM,GN,GP,GQ,GR,GS,GT,GU,GW,GY,HK,HM,HN,HR,HT,HU,ID,IE,IL,IM,IN,IO,IQ,IR,IS,IT,JE,JM,JO,JP,KE,KG,KH,KI,KM,KN,KP,KR,KW,KY,KZ,LA,LB,LC,LI,LK,LR,LS,LT,LU,LV,LY,MA,MC,MD,ME,MF,MG,MH,MK,ML,MM,MN,MO,MP,MQ,MR,MS,MT,MU,MV,MW,MX,MY,MZ,NA,NC,NE,NF,NG,NI,NL,NO,NP,NR,NU,NZ,OM,PA,PE,PF,PG,PH,PK,PL,PM,PN,PR,PS,PT,PW,PY,QA,RE,RO,RS,RU,RW,SA,SB,SC,SD,SE,SG,SH,SI,SJ,SK,SL,SM,SN,SO,SR,SS,ST,SV,SX,SY,SZ,TC,TD,TF,TG,TH,TJ,TK,TL,TM,TN,TO,TR,TT,TV,TW,TZ,UA,UG,UM,US,UY,UZ,VA,VC,VE,VG,VI,VN,VU,WF,WS,XK,YE,YT,ZA,ZM,ZW [create_time] => 2015-01-07 00:00:00 [update_time] => 2015-04-15 11:35:15 [user_id] => 71 [activated] => 1 [twitter_account] => dubaitv [signature] => 8c8e219c9b02496f2b9ef78c5461f4c6 [time_now] => 1461621192 [temp] => 1439535600 )
     * @param $id {channel_id}
     * @param null $slug
     * @return View
     */
    public function live($id, $slug = null)
    {
        $api = new ApiRequest();
        $channels_list = $api->liveChannelsMixed();
        if($id == 49){
            $channel = $api->channelDetails($id, 105);
        }elseif($id == 48){
            $channel = $api->channelDetails($id, 102);
        }else{
            $channel = $api->channelDetails($id);
        }

        if(empty($channel) || !isset($channel -> id)){
            return view("errors.404");
        }

        View::share('inner_channels', $channels_list);
        if($channel->premuim == 1){
            return redirect()->to('premium');
        }
        $live_next = $api->liveNext($id);
        return $this->view('live' , ['channel' => $channel, 'channels_list' => $channels_list, 'live_next' => $live_next]);
    }

    public function live_frame($id, $slug = null)
    {
        $api = new ApiRequest();
        $channels_list = $api->liveChannels();
        $channel = $api->channelDetails($id);
        if($channel->premuim == 1){
            return redirect()->to('premium');
        }
        return view('live_frame' , ['channel' => $channel, 'channels_list' => $channels_list])->render();
    }

    public function live_mango($id, $slug = null)
    {
        $api = new ApiRequest();
        $channels_list = $api->liveChannels();
        $channel = $api->channelDetails($id);
        if($channel->premuim == 1){
            return redirect()->to('premium');
        }
        return view('live_mango' , ['channel' => $channel, 'channels_list' => $channels_list])->render();
    }

    /**
     * @param $id {channel_id}
     * @param null $slug
     * @return View
     */
    public function catchup($id, $slug = null, $video = null, $video_slug = null, $tab= 1){

        $api = new ApiRequest();
        $catchup = $api->catchup($id);

        $channels = $api->liveChannels();
        $categories = $api->categoriesList();
        $video_ad = false;
        $google_doubleclick = false;

        if($video > 0){
            $video = $api->getVideoDetails($video);
            //$video_ad = $api->getSuggested(0, $video, 'verify');
        }
        $channel = $api->channelDetails($id);
        if($channel->premuim == 1){
            return redirect()->to('premium');
        }

        if(is_array($video_ad)){
            $video_ad = end($video_ad);
            if(isset($video_ad->google_doubleclick_mid) && !empty($video_ad->google_doubleclick_mid)){

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
        $this->data['catchup'] = $catchup;
        $this->data['categories'] = $categories;
        $this->data['channels'] = $channels;
        $this->data['channel'] =$channel;
        $this->data['video'] = $video;
        $this->data['tab'] = $tab;
        return $this -> view('catchup');
    }

    public function catchup_frame($id, $slug = null, $video = null, $video_slug = null, $tab= 1){

        $api = new ApiRequest();
        $catchup = $api->catchup($id);
        $channels = $api->liveChannels();
        if($video > 0){
            $video = $api->getVideoDetails($video);
        }
        $channel = $api->channelDetails($id);
        if($channel->premuim == 1){
            return redirect()->to('premium');
        }
        return view('catchup_frame' ,
            [
                'catchup' => $catchup,
                'channels' => $channels,
                'channel' => $channel,
                'video' => $video,
                'tab' => $tab
            ])->render();
    }

    public function channel_videos_frame($channel_id, $limit = 8){
        $api = new ApiRequest();
        $videos = $api->getVideosByChannel($channel_id,1,$limit);

        return view('channel_videos_frame' , [
            'videos' => $videos,
        ])->render();
    }

    public function parseDateTimeZone($timezone)
    {
        $timezones = \DateTimeZone::listIdentifiers();
        foreach ($timezones as $timezone) {
            echo Carbon::now($timezone)->toDayDateTimeString();
            echo '</pre>';
        }
    }

    /* Call the  Request object as  closure */
    public function getChannelLiveEmbedd(Request $request) {
        if($request->ajax()) {
            $channelid = $request->input('channelid');
            $api = new ApiRequest(array('channel_id' => $channelid));
            $embedd_code = $api->GetChannelLiveStream();
            $embeddcode = view('home.channel_live_embeddcode', compact('embedd_code'))->render();
            echo $embeddcode;
        }
    }

    public function ParseShowsCategories(Request $request) {
        if($request->ajax()) {
            $catid = $request->input('catid');
            $api = new ApiRequest(array('cat_id' => $catid));
            $categ_shows = $api->getCategShows();
            $html = view('home.categories_shows', compact('categ_shows'))->render();
            ///return Response::json(['html' => $html]);
            echo $html;
            exit;
        }
    }

    public function login(Request $request) {
        if($request->ajax()) {
            if($request->input('logged')){
                $request->session()->forget('user'); //reset
                $request->session()->put('user', $request->input('user'));
            }
            return response()->json($request->session()->get('user'));
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->to('/');
    }

    public function feedback(Request $request) {
        $email = $request->get( 'email' );
        $subject =  $request->get('subject');
        if($request->ajax()) {
            Mail::send('feedback', array('subject' => $subject), function ($message) use ($email) {
                $message->from('info@dmi.ae', 'Awaan Feedback');
                $message->subject('AWAAN Feedback')
                    ->to('awaan@dmi.ae')
                    ->replyTo($email);
            });
        }
        return response()->json(['sent' => true]);
    }

    public function setLang(Request $request) {
        $locale = $request->segment(2);
        $request->session()->forget('lang'); //reset
        $locales = Config('app.locales');

        if (array_key_exists($locale, $locales)) {
            $request->session()->set('lang', $locale);
            app()->setLocale($locale);
        } else {
            $locale = null;
            $request->session()->set('lang', Config('app.fallback_locale'));
            app()->setLocale(Config('app.fallback_locale'));
        }

        return redirect()->back();
    }

    public function competition()
    {
        $api = new ApiRequest();
        $categories = $api->getCategories();
        return view('competition', [ 'categories' => $categories ]);
    }


    public function submit_answer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|max:255',
            'email' => 'required|email',
            'mobile_number' => 'required|numeric|min:11', // The mobile number has already been taken.
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => 1, 'msg' => 'All fields are required']);
        }else{

            //get active trophy
            $trophy = \DB::table('awaan_trophy')->whereDate('created_date', '=', date('Y-m-d'))
                ->first();

            if($request->input('mobile_number')){

                $mobile_check = \DB::table('awaan_trophy_quiz')
                    ->where('mobile_number', '=', $request->input('mobile_number'))
                    ->whereDate('created_date', '=', date('Y-m-d'))
                    ->count();

                if($mobile_check){
                    return response()->json(['errors' => 2, 'msg' => 'you already subscribed with this mobile number']);
                }
            }

            $isCorrect = ($trophy->displayOn == strtolower($request->input('select_answer'))) ? '1' : 0;

            \DB::table('awaan_trophy_quiz')->insert(
                array(
                    'full_name' => $request->input('full_name'),
                    'email' => $request->input('email'),
                    'mobile_number' => $request->input('mobile_number'),
                    'country' => $request->input('country'),
                    'trophy_id' => $trophy->id,
                    'trophy_answer' => strtolower($request->input('select_answer')),
                    'isCorrect' => $isCorrect,
                )
            );

            return response()->json(['errors' => 0, 'msg' => 'done']);

        }

    }

    public function make_shorturl(Request $request){
        $url = $request->input('url');
        if(empty($url)){
            return response()->json(['errors' => 1, 'msg' => 'The url you sent is empty']);
        }
        $url = base64_decode($url);
        $api = new ApiRequest();
        $short = $api -> ShortenURL($url);
        if(!empty($short) && $short){
            return response()->json(['url' => $short]);
        }else
            return response()->json(['url' => $url]);
    }
}
