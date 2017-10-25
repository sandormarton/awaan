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
                    "gender" => $request->input("Gender"),
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

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->to('/');
    }
}