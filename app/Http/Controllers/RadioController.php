<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/18/2017
 * Time: 10:15 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\ApiRequest;

class RadioController extends BaseController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(){
        parent::__construct();
    }

    public function index(Request $request,$id){
        $this->getCurrentChannel($id);
        if(!isset($this->data["current_channel"]) || empty($this->data["current_channel"])){
            return redirect()->to('');
        }

        $api = new ApiRequest();
        $date = $request->input("date");
        if(empty($date)) $date = date("Y-m-d");

        $this->data["catchup"] = $api->getRadioCatchup($id,$date,4);
        $this->data["featured_shows"] = $api->getFeaturedShows($id,12,1,"yes");

        if($request->ajax()){
            $this->data["page"] = "1";
            return $this->view("radio.list_catchup");
        }
        $this->data["live_radio"] = $api->getRadioLive($id);
        $this->data["page"] = "1";
        return $this->view("radio.index");
    }

    public function catchup(Request $request,$id){
        $this->getCurrentChannel($id);
        if(!isset($this->data["current_channel"]) || empty($this->data["current_channel"])){
            return redirect()->to('');
        }
        $api = new ApiRequest();
        $date = $request->input("date");
        $page = $request->input("page");
        if(empty($date)) $date = date("Y-m-d");
        if(empty($page)) $page = "1";
        $this->data["catchup"] = $api->getRadioCatchup($id,$date,12,$page);
        $this->data["load_more"] = count($this->data["catchup"]) > 11;
        $this->data["page"] = $page;
        if($request->ajax()){
            return response($this->view("radio.list_catchup"))->header('x-load-more', $this->data["load_more"]);
        }
        return $this->view("radio.catchup");
    }

    public function shows(Request $request,$id){
        $this->getCurrentChannel($id);
        if(!isset($this->data["current_channel"]) || empty($this->data["current_channel"])){
            return redirect()->to('');
        }

        $cat_id = $request -> get("cat_id");
        if(!$request->ajax()){
            $api = new ApiRequest();
            $this->data["categories"] = $api->getCategoriesInChannel($id,"yes","1");
            if(count($this->data["categories"]) < 0){
                return redirect()->to('');
            }

            if(empty($cat_id) && count($this->data["categories"]) > 0){
                $cat_id = "-1";
            }
        }

        $apiObj = new ApiRequest([
            'cat_id' => $cat_id,
            'p_shows' => !empty($request -> get("page"))?$request -> get("page"):1,
            'limit_shows' => 12,
            'production_year' => $request -> get("year"),
            'language' => $request -> get("language"),
            'need_filters' => 1,
            'times' => "yes",
            "is_radio" => "1",
            "channel_id" => $id,
        ]);
        $this->data["content"] = $apiObj->getCategryRelatedShow();
        //dd($this->data["content"]);
        $this->data["cat_id"] = $cat_id;
        $this->data["load_more"] = count($this->data["content"]->shows)  > 11;

        if($request->ajax()){
            return response($this->view("radio.list_show"))->header('x-load-more', $this->data["load_more"]);
        }
        return $this->view("radio.shows");
    }

    public function show_details(Request $request,$id,$show_id, $title = "", $season = ""){
        $this->getCurrentChannel($id);
        if(!isset($this->data["current_channel"]) || empty($this->data["current_channel"])){
            return redirect()->to('');
        }

        $api = new ApiRequest();
        $this->data["content"] = $api->getRadioShowDetails($show_id,$season,!empty($request -> get("page"))?$request -> get("page"):1);
//        dd( $this->data["content"]);
        $this->data["load_more"] = count($this->data["content"]->audio)  > 5;

        if($request->ajax())
            return response($this->view("radio.list_audios"))->header('x-load-more', $this->data["load_more"]);

        return $this->view("radio.show");
    }

    private function getCurrentChannel($id){
        foreach ($this->data["radio_channels"] as $channel){
            if($channel->id == $id){
                $this->data["current_channel"] = $channel;
                break;
            }
        }
    }
}