<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function index()//task一覧トップページ
    {
        return view ('tasks.index');
    }

    public function tasklist()//api
    {   
        $tasks = Task::All();

        //user情報も出したいなら下記を参照。
        //$tasks = Task::with(['user'])　以下のuserはモデルで指定しているメソッド
        //->orderBy(Task::CREATED_AT,'desc') -> paginate();
        return $tasks;
        

    }
}
