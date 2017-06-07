<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 6/6/2017
 * Time: 10:30 PM
 *
 * Thanks @bestmomo for the idea!
 */
namespace Pzlatarov\ElasticsearchConsole;
class Kernel extends \App\Http\Kernel
{
    public function hasMiddleware($middleware_name){
        return array_key_exists($middleware_name,$this->routeMiddleware);
    }
}