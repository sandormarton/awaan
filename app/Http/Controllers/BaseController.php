<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/12/2017
 * Time: 11:37 AM
 */

namespace App\Http\Controllers;

use App\Providers\ApiRequest;
use Illuminate\Support\Facades\Session;

abstract class BaseController extends Controller
{
    public $data = [];

    public function __construct(){
        $api = new ApiRequest();
        $this -> data["channels"] = $api->liveChannels();
        $this -> data["radio_channels"] = $api->getRadioChannels();
        $color_array = array("#6ec386","#2a2b2c","#6188c6","#dce23b","#dfcde4","#e87f25","#305576","#93a5a4","#10b89b","#7e669c","#82cdb8","#c6c6c6","#efc515","#557580","#66bacd","#c3ce8c","#3766b0");
        $this -> data["color_array"] = $color_array;
        if(Session::has('user_info') && isset(Session::get('user_info')->id)){
            //user logged in get notifications.
            $this -> data["notifications"] = $api->getNotifications(Session::get('user_info')->id);
        }
    }

    public function view($page, $data=[]){
        return view($page,array_merge($this -> data, $data));
    }
}