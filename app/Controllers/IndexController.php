<?php
/**
 * Created by PhpStorm.
 * User: whr_mac
 * Date: 2019/10/31
 * Time: 3:53 PM
 */
namespace App\Controllers;

use Framework\Http\Http;

class IndexController extends Http {
    function index(\swoole_http_request $req,\swoole_http_response $rep,$parameter = null){
        $query_string = isset($req->server['query_string'])?$req->server['query_string']:null;
        //路由地址
        $rep->end(json_encode($parameter));
    }

    function test(\swoole_http_request $req,\swoole_http_response $rep,$parameter = null){
        parent::Task(["name"=>"test","data"=>"123123"]);
    }
}