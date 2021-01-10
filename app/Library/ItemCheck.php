<?php

namespace App;
namespace App\Library;
use App\User;
use App\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log; //ログ


class Itemcheck
{
    static public function check($user,$items){


    }

    static public function test(){
        Log::debug("itemcheckのtestだよ");
        $user = Auth::user();
        Log::debug("userだよ".$user);

        $items = $user->items;
        Log::debug("自分の：".$items);



    }
}