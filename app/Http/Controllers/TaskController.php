<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; //ログ
use Illuminate\Support\Facades\DB; // DB ファサードを use する
use App\Task;
use App\User;

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

        //return redirect("/user");
        return "登録しました";

    }

//-----------------------実施未実施切り替えpost

    public function change($id){
        //$changeTask = Task::where('id',$id)->get();//collectionがかえる
        $changeTask = Task::where('id',$id)->first();//1オブジェクトがかエル
        Log::debug("取得データ");
        //↓"categories_id":1,"user_id":1,この中にはこう言うデータが入っている;
        //Log::debug($changeTask);
        //↓lv":null,"hp":null,"power":null,"magic":null,"wisdom":null,"xp":null,が入っている
        //Log::debug(Auth::user());
        //ここでuserのそのカテゴリを処理する

        //反転させる。デフォルトは0。
        if($changeTask->done == 0){
            $changeTask->done = 1;//実施済みに変更
            //これでカテゴリーの数字が取れる。1など
            Log::debug(($changeTask)->categories_id);
            Auth::user()->power++;
            Auth::user()->save();

        }else if($changeTask->done == 1){
            $changeTask->done = 0;
            Auth::user()->power--;
            Auth::user()->save();
        }
        $changeTask->save();
        
        return $changeTask;
    }



//-----------------------タスクのAPI

    public function tasklist($id = null)//api
    {   //ユーザー情報
        //$tasks = Task::All();
        //$result = $tasks->select('user_id',$id)->get();
        if($id == null){
            Log::debug("tasklist.未ログインルート");
            //$tasks = Task::All()->sortByDesc('created_at');
            $tasks = Task::orderByDesc('created_at')->get();
        }else{
            Log::debug("tasklist.ログインルート");
            $tasks = Task::where('user_id', $id)
                                ->orderBy('created_at','desc')
                                ->get();
        }
        Log::debug($tasks);
        return $tasks;
    }


}
