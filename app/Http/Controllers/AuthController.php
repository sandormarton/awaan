<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/13/2017
 * Time: 12:07 PM
 */

namespace App\Http\Controllers;

use App\Providers\ApiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class AuthController extends BaseController
{
    public function __construct(){
        parent::__construct();
    }

    public function register(Request $request){
        if($request->ajax()) {
            try{
                $api = new ApiRequest();
                $result = $api->register([
                    "firstname" => $request->input("firstname"),
                    "lastname" => $request->input("lastname"),
                    "gender" => $request->input("gender"),
                    "email" => $request->input("email"),
                    "birthday" => $request->input("birthday"),
                    "username" => $request->input("username"),
                    "country" => $request->input("country"),
                    "password" => $request->input("password"),
                    "city" => $request->input("city"),
                    "mobile" => $request->input("mobile"),
                ]);
                if(isset($result->success) && isset($result->user) && isset($result->user[0])){
                    $request->session()->forget('user_info'); //reset
                    $request->session()->put('user_info', $result->user[0]);
                    return response()->json(["success" => "تم التسجيل بنجاح"]);
                }elseif(isset($result->error) && $result->error == "exist"){
                    return response()->json(["error" => "يوجد حساب قديم بنفس المعلومات"]);
                }else{
                    return response()->json(["error" => "حدذ خطأ أثناء التسجيل"]);
                }
            }catch (Exception $e){
                return response()->json(["error" => "حدذ خطأ أثناء التسجيل"]);
            }
        }
        return $this->view("auth.register");
    }

    public function login(Request $request){

        try{
            if( ! $request->secure() )
                return redirect()->secure('/auth/login' );

        }catch (\Exception $exception){

        }

        if($request->ajax()) {
            try{
                if($request->input('logged')){
                    $request->session()->forget('user_info'); //reset
                    $request->session()->put('user_info', (object)$request->input('user'));
                    return response()->json([
                        "success" => "تم تسجيل الدخول بنجاح"
                    ]);
                }

                $username = $request->input("username");
                $password = $request->input("password");
                $api = new ApiRequest();
                $result = $api->login($username,$password);
                if(isset($result->error)){
                    return response()->json([
                        "error" => "يوجد مشكلة باسم المستخدم أو كلمة المرور"
                    ]);
                }elseif(count($result) > 0){
                    $request->session()->forget('user_info'); //reset

                    $request->session()->put('user_info', $result[0]);
                    //print_r($request->session()->all());
                    return response()->json([
                        "success" => "تم تسجيل الدخول بنجاح"
                    ]);
                }else{
                    return response()->json([
                        "error" => "يوجد مشكلة باسم المستخدم أو كلمة المرور"
                    ]);
                }
            }catch (\Exception $e){
                return response()->json([
                    "error" => "حدث خطأ في تسجيل الدخول"
                ]);
            }
        }
        return $this->view("auth.login");
    }

    public function reset(Request $request){
        return $this->view("auth.reset");
    }


    public function resetByToken(Request $request){
        $this->data["token"] = $request -> get("token");
        if(!isset($this->data["token"]) or empty($this->data["token"])){
            return redirect()->to('/');
        }
        return $this->view("auth.resetByToken");
    }

    public function resetPassword(Request $request)
    {
        $hash = $request->get('hash');
        $token = substr(sha1($hash), 0, 32);
        $email = $request->get('email');
        //  $username = $request->get('username');
        $emailname = explode('@', $request->get('email'));

        $username = $emailname[0];

        if ($hash && $token) {
            // Data to be used on the email view
            $data = array('token' => $token,
                'user' => $username,
                'messagebodysection1' => ' يرجى النقر على الوصله ادناه او نسخها ولصقها في المتصفح
                                لتتمكن من وضع كلمة السر الخاصة بك',
                'messagebodysection2' => '<a href="http://awaan.ae/auth/resetbytoken?token='. $token.'">الرابط</a>
                        و شكرا'
            );
            // Send the welcome email
            $result = Mail::send(['html' => 'emails.newsletter_table'], $data, function ($message) use ($email) {
                $message->from('no-reply@awaan.ae', 'Awaan');
                $message->subject('Password Recovery')
                    ->to($email);
            });
        }
        return response()->json(['sent' =>'result: ' . $result]);
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->to('/');
    }
}
