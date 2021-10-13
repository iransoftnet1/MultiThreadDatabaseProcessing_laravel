<?php
namespace App\TaskTable;
use App\NotificationExchange;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Iransoftnet1\MultiThreadDatabaseProcessing\thread\TaskTable;

class Notify extends TaskTable
{

    function task(Collection $data,$skip): void
    {
        foreach ($data as $model)
        {
            $model->type = time() . " _ ".$skip;
            $model->save();

        }
//        dd("ok");
        $mytime = time();
        $this->echoBox($mytime . " task number ".$skip . " _ count data ".$data->count() . " _ START");
        //sleep(3);

        $mytime = time();
        $this->echoBox($mytime . " task number ".$skip . " _ END");
    }

    function setMaxRowInTread(): int
    {
        return 2;
    }

    function setQueryBuilder(): Builder
    {
        return NotificationExchange::where("id","!=",null);
    }

    public function echoBox($str)
    {
        echo "<p>$str</p>";
    }


}