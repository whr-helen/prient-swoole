<?php
/**
 * Created by PhpStorm.
 * User: whr_mac
 * Date: 2019/10/31
 * Time: 10:48 AM
 */
namespace Framework\Router;

/**
 * Class Router
 */
class Router{
    /**
     * 普通的请求模式 /index/index
     * @param array $path_info_arr
     * @param \swoole_http_request $req
     * @param \swoole_http_response $rep
     */
    static function UrlDistribute(array $path_info_arr, $req, $rep,$http){
        $path_controler = empty($path_info_arr[1])?"\App\Controllers\IndexController":"\App\Controllers\\".ucfirst($path_info_arr[1])."Controller";
        $path_active = empty($path_info_arr[2])?"index":$path_info_arr[2];
        if(class_exists($path_controler)){
            $controller =new $path_controler;
            if(method_exists($controller,$path_active)){
                $func = array($controller,$path_active);
            }else{
                $func = array("\App\Controllers\ErrorController","error");
            }
        }else{
            $func = array("\App\Controllers\ErrorController","error");
        }
        $func($http,$req,$rep);
    }
}


