<?php

namespace Iransoftnet1\MultiThreadDatabaseProcessing\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Iransoftnet1\MultiThreadDatabaseProcessing\thread\ReceiveRequests;
use Iransoftnet1\MultiThreadDatabaseProcessing\thread\TaskTable;

class ReceiveController extends Controller
{

    public function handelReceive($skip, Request $request)
    {
        //dd($request->taskClass);


        $request->validate(
            [
                "token" => "required|string",
                "taskClass"=>"required|string",
                "skip"=>"int|min:0"
            ]
        );
        $task = "";
        //validateTaskClass

        $task = $request->taskClass;
        if (!class_exists($task))dd("no object task exist");

        if (get_parent_class($task) != TaskTable::class) die("class Task not valid");

        //check Token
        $task = new $task();
        $t = $task->getToken();
        if ($t != $request->token) die("token not valid");

        //handel
        new ReceiveRequests($task,$request->skip);

    }

}