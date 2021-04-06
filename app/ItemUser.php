<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class ItemUser extends Pivot
{
    protected $table = 'item_user';

    //https://qiita.com/kkznch/items/72ff650737eff863e4d9
    //https://qiita.com/shonansurvivors/items/92455ec74b33f50330e6
    //userrole pivotクラスを作る　参考
    public function items(){
        //return $this->belongsToMany('App\Item');
        return $this->belongsToMany('App\Item')->withPivot('user_id', 'item_id');

        /*
        return $this->belongsTo('App\Item')
        ->using('App\ItemUser')->withPivot(['item_id']);
        */
        
      }


    
}
