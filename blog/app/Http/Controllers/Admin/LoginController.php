<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;

require_once 'resources/org/code/Code.class.php';
class LoginController extends CommonController
{
    public function login(){
        
        if($input = Input::all()){
            $code = new \Code;
            $_code = $code->get();
            if(strtoupper($input['code']) != $_code){
                return back()->with('msg', '验证码错误');
            }
             $user = User::first();
             if($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass']){
                 return back()->with('msg', '用户名密码错误');
             }
             
             session(['user'=>$user]);
            //  dd(session('user'));
            //  echo 'ok';
            return redirect('admin/index');
        } 
        
       
        else{
            $user = User::first();
            session(['user'=>null]);
            return view('admin.login');
        }
        
    }
    
    public function quit(){
        session(['user'=>null]);
        return redirect('admin/login');
    }
    
    public function code(){
        $code = new \Code;
        $code->make();
    }
    
    // public function crypt(){
    //     $str = 123456;
    //     $str_p="eyJpdiI6IkVuZ3FnZHNPWmUzQlpzcHZhSE0rTkE9PSIsInZhbHVlIjoiSHIwMkxIWStJQkxVdWhCTHR0ckJ1dz09IiwibWFjIjoiMTlhMWEyYzhiY2I4NTEwOGQyZmIwNDJiMDM4ZTkzNTI2NmMzNjNkOWMzN2ZkYjQyMDlhYzA3MDA2ZWU5YTJjOSJ9";
        
    //     echo Crypt::encrypt($str);
    //     echo "<br>";
    //     echo Crypt::decrypt($str_p);
    // }
}
