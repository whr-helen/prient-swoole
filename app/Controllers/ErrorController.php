<?php
/**
 * Created by PhpStorm.
 * User: whr_mac
 * Date: 2019/10/31
 * Time: 4:57 PM
 */
namespace App\Controllers;
class ErrorController{

    function error($http,\swoole_http_request $req,\swoole_http_response $rep){
        $rep->end("404 Not Found");
    }

}