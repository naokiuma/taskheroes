<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;
use App\User;
use App\itemUser; 
use Illuminate\Support\Facades\Log; //ログ
use Illuminate\Database\Eloquent\Relations\Pivot;




class ItemController extends Controller

{
    //-----------------------アイテムのAPI

    public function buy($id){
        //item_userテーブル挿入
        $newitem = new itemUser;
        $user_id = Auth::user()->id;

        $newitem->item_id = $id;
        $newitem->user_id = $user_id;
        $newitem->save();//リレーション使わずに直に登録


        //値段を変更
        $buyitem = Item::where('id',$id)->first();
        Auth::user()->money -= $buyitem["price"];
        Auth::user()->save();

        return "購入しました";

    }
 
    public function itemlist($id = null)//api
    {   //ユーザー情報
        if($id == null){
            $items = Item::orderBy('id')->get();
            Log::debug("すべて：".$items);
            return $items;
            
        }else{
            //taskコントローラーのtasklistAPIを参考に。
            //https://crieit.net/posts/Laravel-Vue-js#%E3%83%A2%E3%83%87%E3%83%AB%E3%81%AE%E6%BA%96%E5%82%99
            //https://qiita.com/shonansurvivors/items/92455ec74b33f50330e6
            /*これでひとまずすべてやれそう。
            $temp = ItemUser::where('user_id', $id)->orderBy('item_id','desc')->get();
            */
            //$temp = User::where('id', $id)->get()->items;//getではCollectionクラス。foreachで回せばmodel。
            $items = User::find($id)->items; //findではモデルオブジェクトがかえる
            //ちなみにfirst()はモデルをかえす。
            
            Log::debug("自分の：".$items);
            return $items;
            } 
    }        
        
}



