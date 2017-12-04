<?php
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::get('/', array('uses' => 'Home@index', 'as' => 'home'), function() {

});

Route::get('/', ['as' => '/',  'uses' => 'Home@index']);
Route::get('/get_catchup_items', ['uses' => 'Home@get_catchup_items']);
Route::get('/shorturl', ['uses' => 'Home@make_shorturl']);

Route::get('dev', array('uses' => 'Home@dev'));

Route::get('info', function() {
    phpinfo();
});

Route::get('episodes', 'Episodes@index', function() {

});

Route::get('live', function() {
    return redirect()->to('live/6/dubai-tv');
});

Route::get('live_frame', function() {
    return redirect()->to('live_frame/6/dubai-tv');
});

Route::get('catchup', function() {
    return redirect()->to('catchup/6/dubai-tv');
});

Route::get('catchup_frame', function() {
    return redirect()->to('catchup_frame/6/dubai-tv');
});

Route::post('feedback', array('uses' => 'Home@feedback'));

Route::get('debug', array('uses' => 'Home@debug'));


Route::get('live/{id}/{slug?}', array('as' => 'live_streaming', 'uses' => 'Home@live'))->where('id', '[0-9]+');
Route::get('live_frame/{id}/{slug?}', array('uses' => 'Home@live_frame'))->where('id', '[0-9]+');
Route::get('live_mango/{id}/{slug?}', array('uses' => 'Home@live_mango'))->where('id', '[0-9]+');
Route::get('catchup/{id}/{slug?}/{video_id?}/{video_slug?}/{tab?}', array('uses' => 'Home@catchup'))->where('id', '[0-9]+')->where('video_id', '[0-9]+');
Route::get('catchup_frame/{id}/{slug?}/{video_id?}/{video_slug?}/{tab?}', array('uses' => 'Home@catchup_frame'))->where('id', '[0-9]+')->where('video_id', '[0-9]+');
Route::get('channel_videos_frame/{channel_id}/{limit?}', array('uses' => 'Home@channel_videos_frame'))->where('channel_id', '[0-9]+')->where('limit', '[0-9]+');

Route::any('auth/register', array('uses' => 'AuthController@register'));
Route::any('auth/reset', array('uses' => 'AuthController@reset'));
Route::any('auth/login', array('uses' => 'AuthController@login'));
Route::any('auth/logout', array('uses' => 'AuthController@logout'));

Route::post('reset', ['as' => 'reset', 'uses' => 'AuthController@resetPassword']);

Route::get('auth/resetbytoken', ['as' => 'do_reset', 'uses' => 'AuthController@resetByToken']);

Route::get('episodes', ['as' => 'episodes', 'uses' => 'Episodes@index']);
Route::get('allshows', ['as' => 'allshows', 'uses' => 'Shows@GetAllShows']);
///Route::get('news', ['as' => 'news', 'uses' => 'News@index']);
Route::get('categories', 'Categories@index');

Route::get('shows/favoriteshows/{uid?}', ['as' => 'favoriteshows', 'uses' => 'Shows@GetUserFavorites']);

Route::get('allshows', ['as' => 'allshows', 'uses' => 'Shows@GetAllShows']);
Route::get('video/favoritesvideos/{uid?}', ['as' => 'favoritesvideos', 'uses' => 'Video@GetUserFavorites']);
Route::get('video/favoritesfilms/{uid?}', ['as' => 'favoritesfilms', 'uses' => 'Video@GetUserFavoritesFilms']);
Route::get('video/resume', ['as' => 'GetUserResume', 'uses' => 'Video@GetUserResume']);


Route::get('series', ['as' => 'series', 'uses' => 'Series@index']);

Route::get('relatedshows/{catid}/{catitle}', ['as' => 'relatedshows', 'uses' => 'Series@CategorySeries']);
Route::get('video/{vid}/{title?}', ['as' => 'video', 'uses' => 'Video@watch'])->where('id', '[0-9]');
/*
  this route for ajax request
 *  */
Route::post('showcategories', 'Home@ParseShowsCategories');
Route::post('getchannelivembedd', 'Home@getChannelLiveEmbedd');

Route::post('getseasonvideo', 'Shows@getSeasonsVideos');
Route::post('get_newsseasonvideo', 'News@getSeasonsVideos');

Route::get('show/{id}/{title?}/{season_id?}', ['as' => 'show', 'uses' => 'Shows@index'])->where('id', '[0-9]+');
Route::get('movie/{id}/{title?}', ['as' => 'movie', 'uses' => 'Shows@indexAflam'])->where('id', '[0-9]+');
Route::get('test/{id}/{title?}/{season_id?}', ['as' => 'show_test', 'uses' => 'Shows@test'])->where('id', '[0-9]+');
Route::post('research/{term?}', ['as' => 'search', 'uses' => 'Search@fullSearch']);
Route::get('research', function() {
    return redirect()->to('/');
});

//Route::group(['prefix' => 'news'], function () {
//
//    Route::get('/', ['as' => 'news', 'uses' => 'News@index']);
//    Route::get('videos/{id}/{title}', ['as' => 'videos', 'uses' => 'News@GetVideos']);
//    Route::get('more/{type}', ['as' => 'news/more/', 'uses' => 'News@More'])->where('type', '[a-z]+');
//});


Route::get('premium', function() {
    return redirect()->to('/');
//    return redirect()->to('/');
});

Route::get('gold/{any?}', function() {
    return redirect()->to('/');
//    return redirect()->to('/');
});

Route::get('gold/{id}/{title?}', function() {
    return redirect()->to('/');
//    return redirect()->to('/');
});

Route::group(['prefix' => 'gold'], function () {


//    Route::get('/', ['as' => 'premium', 'uses' => 'Premium@index']);
//    Route::get('subscribe', ['as' => 'subscribe', 'uses' => 'Premium@subscribe']);
//    Route::get('subscribe_dev', ['as' => 'subscribe_dev', 'uses' => 'Premium@subscribe_dev']);
//    Route::get('subscribe-new', ['as' => 'subscribe', 'uses' => 'Premium@subscribe_new']);
//    Route::get('subscribe_activation', ['as' => 'subscribe', 'uses' => 'Premium@subscribe']);
//    Route::post('tpay', ['as' => 'tpay', 'uses' => 'Premium@tpay']);
//    Route::get('{id}/schedule', ['as' => 'premium_schedule', 'uses' => 'Premium@schedule'])->where('id', '[0-9]+');
//    Route::get('{id}/{title?}', ['as' => 'premium', 'uses' => 'Premium@watch'])->where('id', '[0-9]+');
//    Route::get('shows', ['as' => 'premium_shows', 'uses' => 'Premium@shows']);

    /* ADDED BY PS - Jan. 05, 2017 */
    //Route::get('/', ['as' => 'premiumCategories', 'uses' => 'Premium@getPremiumCategories']);

});

Route::group(['prefix' => 'news'], function () {


});


Route::get('set/en', array('uses' => 'Home@setLang'));
Route::get('set/ar', array('uses' => 'Home@setLang'));

Route::get('show/more/{type}', ['as' => 'show/more/', 'uses' => 'Shows@More'])->where('type', '[a-z]+');

Route::get('show/allprograms/{cat_id?}/{title?}', ['as' => 'show/allprograms', 'uses' => 'Shows@FetchAllShows']);

Route::get('categories', ['as' => 'categories', 'uses' => 'Categories@index']);
Route::get('latestAdded', ['as' => 'latestAdded', 'uses' => 'Home@latestEpisods']);
Route::get('youMaybeLike', ['as' => 'youMaybeLike', 'uses' => 'Home@youMaybeLike']);
Route::get('resumeList', ['as' => 'resumeList', 'uses' => 'Home@resumeList']);

Route::group(['prefix' => 'channels'], function () {
//    Route::get('/', ['as' => 'channels', 'uses' => 'Categories@GetChannels']);
    Route::get('view/{id}/{title}', ['as' => 'view', 'uses' => 'Categories@getChannelRelatedShows'])->where('id', '[0-9]+');
});
Route::get('epg/{folder1?}/{folder2?}/{file?}', ['as' => 'epg', 'uses' => 'Home@ReadEpg']);
/* show-autoloaders */

//Route::get('/show-autoloaders', function() {
//    foreach(spl_autoload_functions() as $callback) {
//        if(is_string($callback)) {
//            echo '- ', $callback, "\n<br>\n";
//        }
//        else if(is_array($callback)) {
//            if(is_object($callback[0])) {
//                echo '- ', get_class($callback[0]);
//            }
//            elseif(is_string($callback[0])) {
//                echo '- ', $callback[0];
//            }
//            echo '::', $callback[1], "\n<br>\n";
//        }
//        else {
//            var_dump($callback);
//        }
//    }
//});

Route::get('gitex', array('uses' => 'Home@competition'));

Route::post('gitex', array('uses' => 'Home@submit_answer'));

Route::group(['prefix' => 'trophy'], function () {

    Route::post('api', function() {
        $results = DB::table('awaan_trophy')->whereDate('created_date', '=', date('Y-m-d'))
            ->first();
        return response()->json($results, 200 ,[], JSON_PRETTY_PRINT);
    });
});


Route::get("/app", function(){
    $api = new \App\Providers\ApiRequest();
    $channels = $api->liveChannels();
    View::share('footer_channels', $channels);
    $categories = $api->categoriesList();
    View::share('categories', $categories);
	return view("home.applications");
});

Route::get("/dmilibrary", function(){
    return redirect()->to('/digitallibrary');
});

Route::get("/search", function(){
    return redirect()->to('/digitallibrary');
});

Route::get('radio/{id}/{title?}', ['as' => 'radio', 'uses' => 'RadioController@index'])->where('id', '[0-9]+');
Route::get('radio/catchup/{id}/{title?}', ['as' => 'radio_catchup', 'uses' => 'RadioController@catchup'])->where('id', '[0-9]+');
Route::get('radio/shows/{id}/{title?}', ['as' => 'radio_shows', 'uses' => 'RadioController@shows'])->where('id', '[0-9]+');
Route::get('radio/show/{id}/{show_id}/{title?}', ['as' => 'radio_shows', 'uses' => 'RadioController@show_details'])->where('id', '[0-9]+')->where('show_id', '[0-9]+');
Route::get('radio/inner_show/{id}/{show_id}/{title?}', ['as' => 'radio_shows', 'uses' => 'RadioController@full_show_details'])->where('id', '[0-9]+')->where('show_id', '[0-9]+');
Route::get('radio/audio/{id}/{audio_id}/{title?}', ['as' => 'radio_audios', 'uses' => 'RadioController@audio_details'])->where('id', '[0-9]+')->where('audio_id', '[0-9]+');

Route::get('video/open_notification/{notification_id}/{id}/{title?}', ['as' => 'open_notification', 'uses' => 'Video@open_notification'])->where('notification_id', '[0-9]+')->where('id', '[0-9]+')->where('show_id', '[0-9]+');


Route::get("/getImg/{path}", function($path=''){

    try{

        $file_name = basename(base64_decode($path));
        $files_path = public_path("images/schedule/");

        if(file_exists($files_path.$file_name)){
            $file = file_get_contents($files_path.$file_name);
        }else{
            usleep(200);
            $file = file_put_contents($files_path.$file_name, file_get_contents(base64_decode($path)));
        }

        $sLastModified = gmdate('D, d M Y H:i:s', strtotime('now')) . ' GMT';

        return Response::make($file, 200, [
            'Content-Type' => 'image'
        ]);

    }catch (\Exception $e){

    }
    return false;
});
