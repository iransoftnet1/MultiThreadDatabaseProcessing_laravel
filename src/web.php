<?php


Route::group(['namespace' => 'Iransoftnet1\MultiThreadDatabaseProcessing\controllers'], function()
{
    Route::post('/req/tread/create/{skip}', ['uses' => 'ReceiveController@handelReceive']);



});
