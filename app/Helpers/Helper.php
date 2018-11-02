<?php
namespace App\Helpers;
use Auth;
class Helper {

    public static function is_login() {
        if(Auth::check()){
           return True;
        }else{
           return False;
        }
    }

    public static function must_login(){
        if(Auth::check()){
           return True;
        }else{
           return Redirect::to('logout');;
        }
    }
}