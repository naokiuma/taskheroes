<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Task;

class TaskController extends Controller
{
    public function index()//task一覧トップページ
    {
        return view ('tasks.index');
    }

    public function tasklist()//api
    {   //ユーザー情報
        $tasks = Task::All();
        return $tasks;
    }

//-----------------------新規作成post

public function create(Request $request){

        $request->validate([
            'title' => 'required|string',
            'body' => 'string|max:255',
            'category_id' => 'required'
        ]);
    $task = new Task;//モデルを使ってmDBに登録する値をセット

    $task->title = $request->title;
    $task->body = $request->body; 
    $task->category_id = $request->category_id;
    Auth::user()->tasks()->save($task);//リレーション

    return redirect("/user");

}


}
