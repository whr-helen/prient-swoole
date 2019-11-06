<?php
/**
 * Created by PhpStorm.
 * User: whr_mac
 * Date: 2019/10/31
 * Time: 3:24 PM
 */
namespace Framework\Http;
use Framework\Router\Restful;
use Framework\Router\Router;

class Http{

    public $http = null;

    /**
     * Http constructor.
     */
    public function __construct()
    {
        $this->http = new \swoole_http_server(HOST,PROT);
        $this->http->set(SYSTEM);
        $this->http->on("Start",[$this,"onStart"]);
        $this->http->on("Task",[$this,"onTask"]);
        $this->http->on("Finish",[$this,"onFinish"]);
        $this->http->on("request",[$this,"onRequest"]);
        $this->http->on('WorkerStart',[$this,"onWorkerStart"]);
        $this->http->start();
    }

    /**
     *  开始事件
     */
    function onStart(){
        echo "server  http://".HOST.':'.PROT."\n";
    }

    /**
     * 注册响应请求
     * 注意管理内存
     * @param \swoole_http_request $req
     * @param \swoole_http_response $rep
     */
    function onRequest(\swoole_http_request $req,\swoole_http_response $rep){

        $request_method = $req->server['request_method'];
        $path_info = $req->server['request_uri'];
        if($path_info!="/favicon.ico"){
            //热重启
            if(DEBUG){
                $this->http->reload();
            }
            if (PATH_INFO == 0){
                $path_info_arr = explode("/",$path_info);
                Router::UrlDistribute($path_info_arr,$req,$rep);
            }else{
                Restful::UrlDistribute($request_method,$path_info,$req,$rep);
            }
        }
    }

    /**
     * 热重启需要重新加载到worker的文件
     */
    function onWorkerStart(){
        include_once dirname(__DIR__)."/../routers/router.php";
    }

    /**
     * @param \swoole_http_server $http
     * @param int $task_id
     * @param int $src_worker_id
     * @param mixed $data
     * @return mixed
     */
    function onTask(\swoole_http_server $http,int $task_id,int $src_worker_id, mixed $data){
        echo "onTask: name".$data['name'];
        echo "onTask: data".$data['data'];
        return $data['name'];
    }


    function onFinish(\swoole_http_server $serv, int $task_id, string $data){
        echo "task name:".$data['name'];
    }


    /**
     * 投递任务
     * @param mixed $parment
     */
    function Task(mixed $parment){
        $this->Task($parment);
    }
}

