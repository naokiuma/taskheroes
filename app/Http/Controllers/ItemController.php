<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;
use App\itemUser;
use Illuminate\Support\Facades\Log; //ログ
use Illuminate\Database\Eloquent\Relations\Pivot;




class ItemController extends Controller

{
    //-----------------------アイテムのAPI

    public function itemlist($id = null)//api
    {   //ユーザー情報
        if($id == null){
            $items = Item::orderBy('id')->get();
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
            return $items;
            } 
        }
        //Log::debug($items);
        
        
}



