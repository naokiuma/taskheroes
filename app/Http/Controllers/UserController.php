<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; //ログ
use App\User;

class UserController extends Controller
{
    //マイページ表示
    public function mypage()
    {
        $user = Auth::user();//ログインユーザー 
        Log::debug("userコントローラー：mypage");
        //Log::debug(print_r($user->items, true));//全部でる。
        
        //$alluser = User::all();//usersテーブルの全レコードを取得。
        return view ('/user/mypage',compact('user'));
    }


    public function logincheck()//ログイン有無のチェック
    { 
        if (Auth::check()){
            $user = Auth::user();
            return $user;
        }else{
            return "";
        }
    }

}
