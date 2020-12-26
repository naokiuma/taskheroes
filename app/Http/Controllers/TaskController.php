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
        Log::debug($changeTask);//　→"categories_id":1,"user_id":1,;
        //Log::debug(Auth::user());　　//lv":null,"hp":null,"power":null,"magic":null,"wisdom":null,"xp":null,が入っている
        //ここでuserのそのカテゴリを処理する
        $point = $changeTask->difficult;
        $category = $changeTask->categories_id;
        Log::debug("変更point：" . $point);
        Log::debug("対象category：" . $category);//1は力2は魔力3は知恵
        //$status = 

        //反転させる。デフォルトは0。実施済みは1
        if($changeTask->done == 0){
            $changeTask->done = 1;
            //これでカテゴリーの数字が取れる。1など
            //Log::debug(($changeTask)->categories_id);
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
