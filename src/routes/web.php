<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 6/4/2017
 * Time: 4:18 PM
 */

Route::get('elasticsearch-console','Pzlatarov\ElasticsearchConsole\Controllers\ElasticsearchConsoleController@index');
Route::get('elasticsearch-console/query','Pzlatarov\ElasticsearchConsole\Controllers\ElasticsearchConsoleController@query')->name('esConsoleQuery');