<?php

namespace Iransoftnet1\MultiThreadDatabaseProcessing\thread;
class ReceiveRequests
{

    private $tbl_task;

    public function __construct($task, int $skip)
    {
        //save task
        $this->tbl_task =  $task;


        //handel Task for Data
        $this->handel($this->getData($skip),$skip);

    }

    //get model name as query builder
    private function getData($skip)
    {
        /** @var Illuminate\Database\Eloquent\Builder $model */
        $model =$this->tbl_task->setQueryBuilder();
        return $model->take($this->tbl_task->setMaxRowInTread())->skip($skip)->get();
    }


    public function handel($data,$skip)
    {
        $this->tbl_task->task($data,$skip);
    }

}