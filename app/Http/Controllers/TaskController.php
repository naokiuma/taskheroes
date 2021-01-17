<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; //ログ
use Illuminate\Support\Facades\DB; // DB ファサードを use する

use App\Task;
use App\User;
use App\Library\ParameterCheck;
use App\Library\GoldCheck;



class TaskController extends Controller
{
    public function index()//task一覧トップページ
    {
        return view ('tasks.index');
    }

//-----------------------新規作成post

    public function create(Request $request){
        Log::debug("新規タスクのリクエスト：" . $request ."がリクエストされました");
            $request->validate([
                'title' => 'required|string',
                'body' => 'max:255',
                'categories_id' => 'required'
            ]);
        $task = new Task;//モデルを使ってmDBに登録する値をセット

        $task->title = $request->title;
        $task->body = $request->body; 
        $task->categories_id = $request->categories_id;
        $task->difficult = $request->difficult;

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
        $changeTask = Task::where('id',$id)->first();//該当のタスク。1オブジェクトが返る
        Log::debug("taskコントローラー：change");
        //Log::debug($changeTask);//　→"categories_id":1,"user_id":1,;
        $point = $changeTask->difficult;
        $category = $changeTask->categories_id;//カテゴリー。1なら力、2なら魔力、3なら知識
        Log::debug("変更point：" . $point);
        Log::debug("対象category：" . $category);//1は力2は魔力3は知恵
        $now = "";
        $randam = 0;
        $gold = 0;
        
        //経験値、gold、計算
        if($changeTask->given == 0){//一度だけ経験値、おかねアップの処理。0であればまだ取得してない。
            $changeTask->given = 1;//取得するので1にする。

            if($category == 1){//力
                $nowUserPoint =  Auth::user()->power;//現在のユーザーの力
            }elseif($category == 2){//魔力
                $nowUserPoint = Auth::user()->magic;//現在のユーザーの魔力。
            }else{
                $nowUserPoint = Auth::user()->wisdom;
            }
            Log::debug("taskコントローラー84：現在の能力値".$nowUserPoint);

            //gold計算。
            $gold = GoldCheck::culcMoney($nowUserPoint);//ゲットするおかね。
            Log::debug("タスクコントローラー88：goldのなかみ".$gold);

            //経験値計算
            $nowXp = Auth::user()->xp;
            $nowXp++;
            if($nowXp == 10){
                $randam = rand(1, 10);
                Auth::user()->lv++;
                Auth::user()->xp = 0;
                Log::debug("レベルアップしました");
                Auth::user()->hp += $randam;
                Auth::user()->money += $gold;
            }else{
                Auth::user()->xp++;
                Auth::user()->money += $gold;
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
        //itemCheck::test();
        return [$changeTask,$randam,$gold];
      
    }



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
