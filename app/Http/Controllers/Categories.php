<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\ApiRequest;

class Categories extends BaseController {
    public function __construct(){
        parent::__construct();

    }

    public function index() {

        $apiobj = new ApiRequest();
        $categories = $apiobj->getCategories();
        $color_array = array("#6ec386","#2a2b2c","#6188c6","#dce23b","#dfcde4","#e87f25","#305576","#93a5a4","#10b89b","#7e669c","#82cdb8","#c6c6c6","#efc515","#557580","#66bacd","#c3ce8c","#3766b0");
        $this -> data["color_array"] = $color_array;
        $this -> data["categories"] = $categories;
        return $this -> view('categories');

    }

    public function GetChannels() {
        $apiobj = new ApiRequest();
        $channels = $apiobj->liveChannels();
        $categories = $apiobj->getCategories();
        if(sizeof($channels > 0)) {
            return  $this -> view('channels.home', ['content' => $channels,
                    'categories' => $categories
            ]);
        }
    }

    public function getChannelRelatedShows(Request $request) {
        $channelid = $request->segment(3);

        $apiobj = new ApiRequest(['id' => $channelid]);
        $channels_relatedshows = $apiobj->getRelatedChannelShow();
        $categories = $apiobj->getCategories();

        if(sizeof($channels_relatedshows > 0)) {
            return  $this -> view('channels.shows', ['content' => $channels_relatedshows,
                    'categories' => $categories,
                    'page_title' => urldecode($request->segment(4))
            ]);
        }
    }

}
