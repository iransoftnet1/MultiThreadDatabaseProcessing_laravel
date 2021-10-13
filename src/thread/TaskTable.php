<?php

namespace Iransoftnet1\MultiThreadDatabaseProcessing\thread;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Iransoftnet1\MultiThreadDatabaseProcessing\split\SplitThread;

abstract class TaskTable
{
    abstract function task(Collection $data, int $skip): void;

    abstract function setQueryBuilder(): Builder;

    abstract function setMaxRowInTread(): int;

    public $token = null;

    public function __construct()
    {

    }

    public function baseUrl(): string
    {
        return config("MultiThreadDatabaseProcessing.baseUrl");
    }

    public function getToken()
    {

        return $this->token == null ? config("MultiThreadDatabaseProcessing.token") : $this->token;
    }

    public function Run()
    {
        $countAllData = $this->setQueryBuilder()->count();
        if ($countAllData == 0) return;
        $countThread = ceil($countAllData / $this->setMaxRowInTread());
       return $this->MultiCurl($countThread);
    }

    private function getSkip($countThread) :array
    {
        $arrSkip = [];
        $max = $this->setMaxRowInTread();
        $sumMax = 0;
        for ($i = 0; $i < $countThread; $i++) {
            $arrSkip[$i] = $sumMax;
            $sumMax += $max;
        }
        return $arrSkip;
    }

    private function MultiCurl($countGroupThread)
    {
        $token = $this->getToken();
        $baseUrl = $this->baseUrl() . "/req/tread/create/";
        $nodes = [];
        //skip
        $skip = $this->getSkip($countGroupThread);
        //generate url
        for ($i = 0; $i < $countGroupThread; $i++) $nodes[$i] = $baseUrl . $skip[$i] ;
        $node_count = count($nodes);

        $curl_arr = array();
        $master = curl_multi_init();

        for ($i = 0; $i < $node_count; $i++) {
            $url = $nodes[$i];

            $curl_arr[$i] = curl_init($url);
            curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_arr[$i], CURLOPT_POSTFIELDS, http_build_query(array(
                "token" => $token,
                "taskClass" => get_called_class()
            )));

            curl_multi_add_handle($master, $curl_arr[$i]);
        }

        do {
            curl_multi_exec($master, $running);

        } while ($running > 0);

        for ($i = 0; $i < $node_count; $i++) {
            $results[] = curl_multi_getcontent($curl_arr[$i]);
        }
//close curl
        for ($i = 0; $i < $node_count; $i++)
            curl_multi_remove_handle($master, $curl_arr[$i]);
        curl_multi_close($master);

     //   print_r($results);
        return $results;

    }


}