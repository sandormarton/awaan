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
 * @author: Hany alsmaman
 * Use the custom APi library
 *
 * @return void
 */
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Providers\ApiRequest;
use Illuminate\Support\Facades\Session;

class Premium extends Controller {

    var $api;
    var $user;
    var $categories_widget;
    var $currencies;
    var $lang;

    public function __construct(Request $request)
    {
        $this->api = new ApiRequest();
        $this->currencies = [
            "AED" => "درهم",
            "SAR" => "ريال",
            "EGP" => "جنيه",
            "ILS" => "جنيه",
            "JOD" => "دينار",
            "QAR" => "ريال",
            "KWD" => "دينار",
            "BHD" => "دينار",
            "IQD" => "دينار عراقى",
            "MAD" => "درهم مغربى",
            "TND" => "دينار"
        ];
        $this->categories_widget = json_decode($this->api->GetSeries());
        $this->user = ($request->session()->has('user')) ? (object) $request->session()->get('user') : false;
        $this->lang = ($request->session()->has('lang')) ? $request->session()->get('lang') : false;

    }

    public function index(Request $request) {
        $channels = $this->api->liveChannelsWithStream();

        $check = false;
        if($this->user){
            $check = $this->api->subscribeCheck($this->user->id);
            if( isset($check->status) && strtolower($check->status) == 'active' )
                return redirect()->to('gold/57/Drama');

        }
        return view('premium.index',
            [
                'categories' => $this->categories_widget->Categories,
                'channels' => $channels,
                'check' => $check
            ]);
    }

    private function getAmount($currencyCode){
        switch ($currencyCode) {
            case "AED":
                $amount = 18;
                break;
            case "SAR":
                $amount = 18;
                break;
            case "EGP":
                $amount = 45;
                break;
            case "ILS":
                $amount = 18;
                break;
            case "JOD":
                $amount = 3.4;
                break;
            case "QAR":
                $amount = 18;
                break;
            case "KWD":
                $amount = 1.5;
                break;
            case "BHD":
                $amount = 1.85;
                break;
            case "IQD":
                $amount = 5800;
                break;
            case "TND":
                $amount = 10;
                break;
            case "MAD":
                $amount = 48.85;
                break;
            default:
                $amount = 0;
                break;
        }
        return $amount;
    }

    public function subscribe_dev(Request $request){
        if(!$this->user)
            return redirect()->back();

        $check = $this->api->subscribeCheck($this->user->id);

        if( isset($check->status) && strtolower($check->status) == 'active' ){
            //subscriptions
            $status = (isset($check->status)) ? strtolower($check->status) : false;

            $contract_status = false; // Active, Expired, Suspended or canceled

            $contract_array = [
                "new" => trans('content.premiumerros.new'),
                "active" => trans('content.premiumerros.active'),
                "expired" => trans('content.premiumerros.expired'),
                "suspended" => trans('content.premiumerros.suspended'),
                "canceled" => trans('content.premiumerros.canceled')
            ];

            if(isset($contract_array[$status]))
                $contract_status = $contract_array[$status];

            $summary_view = ($this->lang == 'ar') ? 'premium.summary' : 'premium.summary_en';

            return view($summary_view, ['categories' => $this->categories_widget->Categories,
                'status' => $status,
                'contract' => $contract_status,
                'item' => $check,
            ]);

        }elseif(strtolower($check->status) == 'new' && $check->verified != "1"){
            //activation

            $currencytrans = $this->currencies[$check->currencyCode];

            $amount= $this->getAmount($check->currencyCode);

            return view('premium.verification',
                [
                    'categories' => $this->categories_widget->Categories,
                    'amount' => $amount,
                    'currency' => $currencytrans,
                    'msisdn' => $check->msisdn,
                    'operatorCode' => $check->operatorCode,
                    'provider' => $check->provider
                ]);

        }elseif(strtolower($check->status) == 'new_off' && $check->verified != "1"){

            //activation method

            $currencytrans = $this->currencies[$check->currencyCode];

            $amount=0;

            switch ($check->currencyCode){

                case "AED":
                    $amount = 30;
                    break;

                case "SAR":
                    $amount = 50;
                    break;

                case "EGP":
                    $amount = 35;
                    break;

                case "ILS":
                    $amount = 30;
                    break;

                case "JOD":
                    $amount = 5;
                    break;

                case "QAR":
                    $amount = 50;
                    break;

                case "KWD":
                    $amount = 2;
                    break;

                case "BHD":
                    $amount = 5;
                    break;

                case "IQD":
                    $amount = 5800;
                    break;

                case "TND":
                    $amount = 10;
                    break;
            }

            return view('premium.activation',
                [
                    'categories' => $this->categories_widget->Categories,
                    'amount' => $amount,
                    'currency' => $currencytrans,
                    'msisdn' => $check->msisdn,
                    'operatorCode' => $check->operatorCode,
                    'provider' => $check->provider
                ]);

        }else{
            //subscribe
            return view('premium.subscribe_dev', ['categories' => $this->categories_widget->Categories]);
        }
    }


    /**
     * Object ( [id] => 115 [channel_userid] => 2 [transactionId] => 3999007 [paymentTransactionStatusCode] => 10 [subscriptionContractId] => 768978 [amountCharged] => [currencyCode] => AED [operatorCode] => 971 [msisdn] => 971506172067 [nextPaymentDate] => [productCatalogName] => [productId] => [verified] => 0 [status] => active [created_time] => 2015-08-17 13:57:10 [updated_at] => 2015-08-18 16:17:04 )
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function subscribe(Request $request){
        if(!$this->user)
            return redirect()->back();

        $check = $this->api->subscribeCheck($this->user->id);

        if( isset($check->status) && strtolower($check->status) == 'active' ){
            //subscriptions
            $status = (isset($check->status)) ? strtolower($check->status) : false;

            $contract_status = false; // Active, Expired, Suspended or canceled

            $contract_array = [
                "new" => trans('content.premiumerros.new'),
                "active" => trans('content.premiumerros.active'),
                "expired" => trans('content.premiumerros.expired'),
                "suspended" => trans('content.premiumerros.suspended'),
                "canceled" => trans('content.premiumerros.canceled')
            ];

            if(isset($contract_array[$status]))
                $contract_status = $contract_array[$status];

            $summary_view = ($this->lang == 'ar') ? 'premium.summary' : 'premium.summary_en';

            return view($summary_view, ['categories' => $this->categories_widget->Categories,
                'status' => $status,
                'contract' => $contract_status,
                'item' => $check,
            ]);

        }elseif(strtolower($check->status) == 'new' && $check->verified != "1"){
            //activation

            $currencytrans = $this->currencies[$check->currencyCode];

            $amount= $this->getAmount($check->currencyCode);

            if($check->provider == 'Asia'){
                //$amount = 5800;
            }

            return view('premium.verification',
                [
                    'categories' => $this->categories_widget->Categories,
                    'amount' => $amount,
                    'currency' => $currencytrans,
                    'msisdn' => $check->msisdn,
                    'operatorCode' => $check->operatorCode,
                    'provider' => $check->provider
                ]);

        }elseif(strtolower($check->status) == 'new_off' && $check->verified != "1"){
            
            //activation method

            $currencytrans = $this->currencies[$check->currencyCode];

            $amount = $this->getAmount($check->currencyCode);

//            switch ($check->currencyCode){
//
//                case "AED":
//                    $amount = 30;
//                    break;
//
//                case "SAR":
//                    $amount = 50;
//                    break;
//
//                case "EGP":
//                    $amount = 35;
//                    break;
//
//                case "ILS":
//                    $amount = 30;
//                    break;
//
//                case "JOD":
//                    $amount = 5;
//                    break;
//
//                case "QAR":
//                    $amount = 50;
//                    break;
//
//                case "KWD":
//                    $amount = 2;
//                    break;
//
//                case "BHD":
//                    $amount = 5;
//                    break;
//
//                case "IQD":
//                    $amount = 5800;
//                    break;
//
//                case "TND":
//                    $amount = 28;
//                    break;
//            }

            return view('premium.activation',
                [
                    'categories' => $this->categories_widget->Categories,
                    'amount' => $amount,
                    'currency' => $currencytrans,
                    'msisdn' => $check->msisdn,
                    'operatorCode' => $check->operatorCode,
                    'provider' => $check->provider
                ]);

        }else{
            //subscribe
            return view('premium.subscribe', ['categories' => $this->categories_widget->Categories]);
        }
    }

    public function subscribe_new(Request $request){

        /*
         * Get the today schdedule for thje given  channel
         * */

        $today=date('Y-m-d',strtotime('today'));

        !empty($this->api->getSchedule(12)->$today)?  $schedule['dubai']=array_slice($this->api->getSchedule(12)->$today,0,8) : $schedule['dubai']='' ;

        !empty($this->api->getSchedule(60)->$today)?  $schedule['seeviprem']=array_slice($this->api->getSchedule(60)->$today,0,8) : $schedule['seeviprem']='' ;

        !empty($this->api->getSchedule(57)->$today)?  $schedule['seevidrama']=array_slice($this->api->getSchedule(57)->$today,0,8) : $schedule['seevidrama']='' ;

        !empty($this->api->getSchedule(59)->$today)?  $schedule['seevikanb']=array_slice($this->api->getSchedule(59)->$today,0,8) : $schedule['seevikanb']='' ;
        !empty($this->api->getSchedule(59)->$today)?  $schedule['seevibeelink']=array_slice($this->api->getSchedule(59)->$today,0,8) : $schedule['seevibeelink']='' ;



//        foreach($channelid as $key=> $channelid ) {
//     if(!empty($this->api->getSchedule($channelid)->$today)){
//         $schedule['favoritshows']=$this->api->getSchedule($channelid)->$today;
//     }
// }

        $summary_view = ($this->lang == 'ar') ? 'premium.summary_new' : 'premium.summary_new_en';

        return view($summary_view, ['categories' => $this->categories_widget->Categories,
            'channel_favshows'=>$schedule

        ]);


        if(!$this->user)
            return redirect()->back();

        $check = $this->api->subscribeCheck($this->user->id);

        if( isset($check->status) && strtolower($check->status) == 'active' ){
            //subscriptions
            $status = (isset($check->status)) ? strtolower($check->status) : false;

            $contract_status = false; // Active, Expired, Suspended or canceled

            $contract_array = [
                "new" => "بإنتظار الموافقة",
                "active" => "مفعل",
                "expired" => "منتهي الصلاحية",
                "suspended" => "معلق او تم ايقافه",
                "canceled" => "تم الغاءه"
            ];

            if(isset($contract_array[$status]))
                $contract_status = $contract_array[$status];

            return view('premium.summary_new', ['categories' => $this->categories_widget->Categories,
                'status' => $status,
                'contract' => $contract_status,
                'item' => $check,
            ]);

        }elseif(strtolower($check->status) == 'new' && $check->verified != "1"){
            //activation

            $currencytrans = $this->currencies[$check->currencyCode];

            $amount = $this->getAmount($check->currencyCode);

            return view('premium.verification',
                [
                    'categories' => $this->categories_widget->Categories,
                    'amount' => $amount,
                    'currency' => $currencytrans,
                    'msisdn' => $check->msisdn,
                    'operatorCode' => $check->operatorCode,
                    'provider' => $check->provider
                ]);

        }elseif(strtolower($check->status) == 'new_off' && $check->verified != "1"){

            //activation method

            $currencytrans = $this->currencies[$check->currencyCode];

            $amount=0;

            switch ($check->currencyCode){

                case "AED":
                    $amount = 30;
                    break;

                case "SAR":
                    $amount = 50;
                    break;

                case "EGP":
                    $amount = 35;
                    break;

                case "ILS":
                    $amount = 30;
                    break;

                case "JOD":
                    $amount = 5;
                    break;

                case "QAR":
                    $amount = 50;
                    break;

                case "KWD":
                    $amount = 2;
                    break;

                case "BHD":
                    $amount = 5;
                    break;

                case "IQD":
                    $amount = 5800;
                    break;

                case "TND":
                    $amount = 10;
                    break;
            }

            return view('premium.activation',
                [
                    'categories' => $this->categories_widget->Categories,
                    'amount' => $amount,
                    'currency' => $currencytrans,
                    'msisdn' => $check->msisdn
                ]);

        }else{
            //subscribe
            return view('premium.subscribe_newui', ['categories' => $this->categories_widget->Categories]);
        }
    }


    public function subscribe_new_original(Request $request){
        if(!$this->user)
            return redirect()->back();

        $check = $this->api->subscribeCheck($this->user->id);

        if( isset($check->status) && strtolower($check->status) == 'active' ){
            //subscriptions
            $status = (isset($check->status)) ? strtolower($check->status) : false;

            $contract_status = false; // Active, Expired, Suspended or canceled

            $contract_array = [
                "new" => "بإنتظار الموافقة",
                "active" => "مفعل",
                "expired" => "منتهي الصلاحية",
                "suspended" => "معلق او تم ايقافه",
                "canceled" => "تم الغاءه"
            ];

            if(isset($contract_array[$status]))
                $contract_status = $contract_array[$status];

            return view('premium.summary_new', ['categories' => $this->categories_widget->Categories,
                'status' => $status,
                'contract' => $contract_status,
                'item' => $check,
            ]);

        }elseif(strtolower($check->status) == 'new' && $check->verified != "1"){
            //activation

            $currencytrans = $this->currencies[$check->currencyCode];

            $amount=0;

            switch ($check->currencyCode){

                case "AED":
                    $amount = 30;
                    break;

                case "SAR":
                    $amount = 50;
                    break;

                case "EGP":
                    $amount = 35;
                    break;

                case "ILS":
                    $amount = 30;
                    break;

                case "JOD":
                    $amount = 5;
                    break;

                case "QAR":
                    $amount = 50;
                    break;

                case "KWD":
                    $amount = 2;
                    break;

                case "BHD":
                    $amount = 5;
                    break;

                case "IQD":
                    $amount = 5800;
                    break;

                case "TND":
                    $amount = 10;
                    break;
            }

            return view('premium.verification',
                [
                    'categories' => $this->categories_widget->Categories,
                    'amount' => $amount,
                    'currency' => $currencytrans,
                    'msisdn' => $check->msisdn
                ]);

        }elseif(strtolower($check->status) == 'new_off' && $check->verified != "1"){

            //activation method

            $currencytrans = $this->currencies[$check->currencyCode];

            $amount=0;

            switch ($check->currencyCode){

                case "AED":
                    $amount = 30;
                    break;

                case "SAR":
                    $amount = 50;
                    break;

                case "EGP":
                    $amount = 35;
                    break;

                case "ILS":
                    $amount = 30;
                    break;

                case "JOD":
                    $amount = 5;
                    break;

                case "QAR":
                    $amount = 50;
                    break;

                case "KWD":
                    $amount = 2;
                    break;

                case "BHD":
                    $amount = 5;
                    break;

                case "IQD":
                    $amount = 5800;
                    break;

                case "TND":
                    $amount = 10;
                    break;
            }

            return view('premium.activation',
                [
                    'categories' => $this->categories_widget->Categories,
                    'amount' => $amount,
                    'currency' => $currencytrans,
                    'msisdn' => $check->msisdn
                ]);

        }else{
            //subscribe
            return view('premium.subscribe_newui', ['categories' => $this->categories_widget->Categories]);
        }
    }

    public function tpay(Request $request){
        if(!$this->user)
            return redirect()->back();

        $request->merge(['channel_userid' => $this->user->id]);

        $subscribe = $this->api->tpaySubscribe($request->all());
//
//        $subscribe = $this->api->tpayDev($request->all());

        if(isset($subscribe->status) && isset($subscribe->currencyCode) && $subscribe->status == 'success'){
            $amount = $this->getAmount($subscribe->currencyCode);
            $currencytrans = $this->currencies[$subscribe->currencyCode];
            $subscribe->msg = str_replace("#price", "{$amount} {$currencytrans}", $subscribe->msg);
        }
        return response()->json($subscribe);
    }

    public function watch($id){
        if(!$this->user)
            return redirect()->to('gold');

        $check = $this->api->subscribeCheck($this->user->id);
        $channels = $this->api->liveChannelsWithStream();
        $channel = $this->api->channelDetails($id);
        $premiumshows = $this->api->premiumCategories();

        if( isset($check->status) && strtolower($check->status) == 'active' ){

            $live_next = $this->api->live($id);

            return view('premium.index',
                [
                    'categories' => $this->categories_widget->Categories ,
                    'channels' => $channels ,
                    'channel' => $channel,
                    'live_next' => $live_next,
                    'check' => $check,
                    'premiumshows' => $premiumshows
                    
                ]);
        }else{
            return redirect()->to('gold');
        }
    }

    public function shows(){
        if(!$this->user)
            return redirect()->to('gold');

        $check = $this->api->subscribeCheck($this->user->id);
        $channels = $this->api->liveChannelsWithStream();
        $premium_shows = $this->api->premiumCategories();

        if( isset($check->status) && strtolower($check->status) == 'active' ){

            return view('premium.index',
                [
                    'categories' => $this->categories_widget->Categories ,
                    'shows' => $premium_shows,
                    'channels' => $channels ,
                    'check' => $check
                ]);
        }else{
            return redirect()->to('gold');
        }
    }


    public function schedule($id){
        if(!$this->user)
            return redirect()->to('gold');

        $check = $this->api->subscribeCheck($this->user->id);
        $channels = $this->api->liveChannelsWithStream();
        $schedule = (array) $this->api->getSchedule($id);
        $channel = $this->api->channelDetails($id);

        $premium_shows = false;

        if($schedule != false){
            $today = date("Y-m-d");
            if(isset($schedule[$today])){
                $premium_shows = $schedule[$today];
            }
        }

        if( isset($check->status) && strtolower($check->status) == 'active' ){

            return view('premium.schedule',
                [
                    'categories' => $this->categories_widget->Categories ,
                    'shows' => $premium_shows,
                    'channels' => $channels ,
                    'channel' => $channel ,
                    'check' => $check
                ]);
        }else{
            return redirect()->to('gold');
        }
    }
    
    
    /* ADDED BY PS - Jan. 05, 2017 */
    /*public function getPremiumCategories() {
    	    	
        $premiumCategories = $this->api->premiumCategories();

        if( isset($check->status) && strtolower($check->status) == 'active' ){

            return view('premium.index',
                [
                    'premiumCategories' => $premiumCategories ,
                    
                ]);
        }else{
            return redirect()->to('gold');
        }
    }*/
    
}
