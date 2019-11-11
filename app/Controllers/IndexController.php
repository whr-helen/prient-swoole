<?php
/**
 * Created by PhpStorm.
 * User: whr_mac
 * Date: 2019/10/31
 * Time: 3:53 PM
 */
namespace App\Controllers;

use Framework\Async\Asyncmysql;

class IndexController{
    /**
     * 控制器模板
     * @param $http
     * @param $req
     * @param $rep
     * @param null $parameter
     */
    function index($http,$req,$rep,$parameter = null){
        $query_string = isset($req->server['query_string'])?$req->server['query_string']:null;
        //路由地址
        $rep->end(json_encode($parameter));
    }

    /**
     * 控制器模板 带TASK任务
     * @param $http
     * @param $req
     * @param $rep
     * @param null $parameter
     */
    function task($http,$req,$rep,$parameter = null){
        $data = [
            "name"=>"index@index",
            "data"=>"this is test",
        ];
        $task_id = $http->task($data);
        $rep->end("{$task_id}:task_id:");
    }

    /**
     * 异步mysql
     * @param $http
     * @param $req
     * @param $rep
     * @param null $parameter
     */
    function mysql($http,$req,$rep,$parameter = null){
        $sql = "select * from account";
        $asy_mysql = new Asyncmysql();
        $asy_mysql->query($sql);
        $rep->end("async mysql");
    }
}