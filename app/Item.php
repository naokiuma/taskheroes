<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Item extends Model
{
    /**
     * itemを所有するユーザを取得
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
        //->using('App\ItemUser');
    }
}
