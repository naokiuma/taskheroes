<?php

namespace App;
namespace App\Library;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


class GoldCheck extends Model
{//Goldの計算
    static public function culcMoney($point){//$pointは現在のユーザーの能力値。10

        $gold = rand(1, 4) * 10; //300
        $coefficient = $point * rand(1,3);//20
        $addgold = $gold * $coefficient / 100; //200
        $gold = round($addgold + $gold);

        return $gold;
        

    }
}
