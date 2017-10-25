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
use App\Providers\ApiRequest;

class Shows extends Controller {
    public function index(Request $request) {
        $showid = $request->segment(2);
        $apiobj = new ApiRequest(['cat_id' => $showid]);
        $showdetails = json_decode($apiobj->getShowDetails());

        return view('show', ['categories' => $showdetails->Categories,
                'currentshow' => current($showdetails->ShowSeasons),
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
        $show_contents = json_decode($api->GetShowPage());

        $categories = object_get($show_contents, 'Categories');

        return view('all_shows', ['show_content' => $show_contents, 'categories' => $categories]);
    }

}