<?php

namespace App;
namespace App\Library;
use App\Library\itemCheck;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;



class ParameterCheck extends Model
{//whichは上がるか下がるか。受け取った情報をもとに能力値のアップまたはダウンをする
    static public function changeParameter($which,$point,$category){


        if($which == "up"){
            if($category === 1){
                Auth::user()->power += $point;
            }else if ($category === 2){
                Auth::user()->magic += $point;
            }else if($category === 3){
                Auth::user()->wisdom += $point;
            }
            Auth::user()->save();
    
        }elseif($which = "down"){
            if($category === 1){
                Auth::user()->power -= $point;
            }else if ($category === 2){
                Auth::user()->magic -= $point;
            }else if($category === 3){
                Auth::user()->wisdom -= $point;
            }
            Auth::user()->save();
        }
    }
}
