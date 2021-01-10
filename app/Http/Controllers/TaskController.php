<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; //ログ
use Illuminate\Support\Facades\DB; // DB ファサードを use する
use App\Library\itemCheck;

use App\Task;
use App\User;
use App\Library\ParameterCheck;


class TaskController extends Controller
{
    public function index()//task一覧トップページ
    {
        return view ('tasks.index');
    }

//-----------------------新規作成post

    public function create(Request $request){

            $request->validate([
                'title' => 'required|string',
                'body' => 'string|max:255',
                'categories_id' => 'required'
            ]);
        $task = new Task;//モデルを使ってmDBに登録する値をセット

        $task->title = $request->title;
        $task->body = $request->body; 
        $task->categories_id = $request->categories_id;
        Auth::user()->tasks()->save($task);//リレーション
        return "登録しました";

    }

//-----------------------削除post
    public function delete($id){
        $deleateTask = Task::where('id',$id)->first();
        Log::debug("taskコントローラー：deleate");
        $deleateTask->delete();
        return "${id}を削除しました";

    }


//-----------------------実施未実施切り替えpost

    public function change($id){
        //$changeTask = Task::where('id',$id)->get();//getだとcollectionがかえる
        $changeTask = Task::where('id',$id)->first();//1オブジェクトが変える
        Log::debug("taskコントローラー：change");
        //Log::debug($changeTask);//　→"categories_id":1,"user_id":1,;
        $point = $changeTask->difficult;
        $category = $changeTask->categories_id;
        Log::debug("変更point：" . $point);
        Log::debug("対象category：" . $category);//1は力2は魔力3は知恵
        $now = "";

        if($changeTask->given == 0){//一度だけ経験値アップの処理。戻すことはない
            $changeTask->given = 1;
            $nowXp = Auth::user()->xp;
            $nowXp++;
            if($nowXp == 10){
                Auth::user()->lv++;
                Auth::user()->xp = 0;
                Log::debug("レベルアップしました");

            }else{
                Auth::user()->xp++;

            }
            Auth::user()->save();
        }


        //反転させる。デフォルトは0。実施済みは1
        if($changeTask->done == 0){
            $changeTask->done = 1;
            //$this->parameter("up",$point,$category);//次の関数
            ParameterCheck::changeParameter("up",$point,$category);
        }else if($changeTask->done == 1){
            $changeTask->done = 0;
            //$this->parameter("down",$point,$category);
            ParameterCheck::changeParameter("down",$point,$category);
        }
        $changeTask->save();

        /*ここでアイテムげっとの判定を行う場合、getitemに設定する*/
        //$Auth::user()->lv//レベル取得

        itemCheck::test();

        return [$changeTask,"getitem"];

        //return array("result" => $changeTask,"gotItem" => "剣");
      
    }


    
    //上がるかどうか?とポイント、カテゴリーを受け処理する
    /*
    public function parameter($which,$point,$category){//whichは上がるか下がるか
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
    */



//-----------------------タスクのAPI

    public function tasklist($id = null)//api
    {   //ユーザー情報
        if($id == null){
            //Log::debug("tasklist.未ログインルート");
            $tasks = Task::orderByDesc('created_at')->get();
        }else{
            //Log::debug("tasklist.ログインルート");
            $tasks = Task::where('user_id', $id)
            ->orderBy('created_at','desc')
            ->get();
        }
        //Log::debug($tasks);
        return $tasks;
    }


}
