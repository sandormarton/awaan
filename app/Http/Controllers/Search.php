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
use App\Http\Requests;
use App\Providers\ApiRequest;

class Search extends BaseController {
    private $search = '';

    public function fullSearch(Request $request) {
        $term = $request->input('term');
        $apiobj = new ApiRequest(['text' => $term]);
        $apiobjcat = new ApiRequest();
        $cat_response = json_decode($apiobjcat->GetSeries());
        $this->search = json_decode($apiobj->FullSearch());

        // $videocontent = object_get($this->search, 'videos');
        //   $showscontent = object_get($this->search, 'shows');
        /* Get item from the object
          @param $video_response the object
         * @param video  the item to be returned
         *
         * */
//        if(sizeof($videocontent) > 0) {
//
//        }
        $this->data['searchcotent'] = $this->search;
        $this->data['categories'] =  $cat_response->Categories;
        $this->data['shows'] = $this->data['searchcotent']->shows;
        $this->data['videos'] = $this->data['searchcotent']->videos;
        $this->data['films'] = $this->data['searchcotent']->films;
        $this->data['audios'] = $this->data['searchcotent']->audios;

        return $this -> view('searchs.search');
    }

}