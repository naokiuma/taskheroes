<?php

namespace App;
namespace App\Library;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


class ParameterCheck extends Model
{
    static public function changeParameter($which,$point,$category){//whichは上がるか下がるか
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
