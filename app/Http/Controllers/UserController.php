<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    //マイページ表示
    public function mypage()
    {
        $user = Auth::user();//ログインユーザー
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

    /*
    public function list()いろんな人のデータを見れる。交流目的のサービスでは無いので2ばんめ
    {
        return view('/user/list');
    }
    */

}
