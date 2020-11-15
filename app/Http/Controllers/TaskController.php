<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; //ログ
use Illuminate\Support\Facades\DB; // DB ファサードを use する
use App\Task;

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

    //-----------------------タスクのAPI

    public function tasklist($id = null)//api
    {   //ユーザー情報
        //$tasks = Task::All();
        //$result = $tasks->select('user_id',$id)->get();
        if($id == null){
            $tasks = Task::All();
        }else{
            $tasks = Task::where('user_id', $id)->get();
        }
        //Log::debug($tasks);
        return $tasks;
    }


}
