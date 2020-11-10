<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = ['id'];

    //protected $visible = [
        //apide見える項目。基本的に全部出す。
    //];

    public function user(){
        return $this->belongsTo('App\User');
      }

      /*//カテゴリー作成後に設定。
    public function category(){
    return $this->belongsTo('App\Category');
    }
    */
}
