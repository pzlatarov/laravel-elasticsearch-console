<?php

namespace Pzlatarov\ElasticsearchConsole\Controllers;


use Pzlatarov\ElasticsearchConsole\Kernel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ElasticsearchConsoleController extends Controller
{

    public function __construct(Kernel $kernel){
        if($kernel->hasMiddleware('es_console')){
            $this->middleware('es_console');
        }
    }

    public function index(){
        return view('es-console::index');
    }

    public function query(){
        $host = config('elasticsearch_console.host');
        $host .= substr($host,strlen($host)-1,1)=='/'?'':'/';
        $client = new Client(['http_errors' => false]);
        try {
            $request = $client->get($host . Input::get('query'));

            $json = json_decode($request->getBody());

            if($json){
                return response()->json(json_decode($request->getBody()));
            } else{
                return response($request->getBody());
            }


        } catch(\Exception $e){
            return response()->json([
                'error'=>'exception',
                'exception' => get_class($e),
                'message' => $e->getMessage()
            ]);
        }

        return null;
    }
}
