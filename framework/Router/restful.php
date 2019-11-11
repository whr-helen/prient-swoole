<?php
/**
 * Created by PhpStorm.
 * User: whr_mac
 * Date: 2019/11/1
 * Time: 9:53 AM
 */
namespace Framework\Router;

class Restful{

    /**
     * 路由队列
     * @var array
     */
    static private $path_arr = ["GET","POST","PUT","DELETE","HEAD"];

    /**
     * @param $name
     * @param $arguments
     */
    static function __callStatic($name, $arguments)
    {
        $method = strtoupper($name);
        if(in_array($method,self::$path_arr)){
            self::setRestful($method,$arguments);
        }else{
            var_dump($method.'不符合 restful 风格');
        }
    }

    /**
     * 路由解析器
     * @param $method
     * @param $path_info_arr
     * 逐级拆分解析：$path_info = /index/index/1/2
     */
    static function UrlDistribute($method,$path_info_url,$req,$rep,$http){

        $path_info = self::whereisUrl($method,$path_info_url);
        if(!array_key_exists($path_info,self::$path_arr[$method])){
            $func = array("\App\Controllers\ErrorController","error");
            $func($http,$req,$rep);
        }else{
            //解析参数
            $parameter = self::GetParameter($path_info_url,$path_info);
            $path = self::$path_arr[$method][$path_info];
            if($path instanceof \Closure){
                $path($http,$req,$rep,$parameter);
            }else{
                $pathinfo_arr = explode('@',$path);
                $func = array(new $pathinfo_arr[0],$pathinfo_arr[1]);
                $func($http,$req,$rep,$parameter);
            }
        }
    }

    /**
     * 格式$router::get('index',['index'=>'UserController@index']);
     * @param string $url
     * @param $closure
     * old version :  static function setRestful($method,string $url,$closure)
     */
    static function setRestful($method,$argumentse){
        $url = self::GetUrl($argumentse[0]);
        $closure = $argumentse[1];
        //判断是不是闭包
        if($closure instanceof \Closure){
            self::$path_arr[$method]["/".$url] = $closure;
        }else{
            $key = array_keys($closure)[0];
            $path = "\App\Controllers\\".ucfirst($key)."Controller@".$url;
            self::$path_arr[$method]['/'.$key.'/'.$url] = $path;
        }
    }

    /**
     * @param $method
     * @param $path_info
     * @return bool|string
     */
    static function whereisUrl($method,$path_info){
        if(array_key_exists($path_info,self::$path_arr[$method])){
            return $path_info;
        }else{
            $key = strrpos($path_info,'/');
            if($key>1){
                $path_info = substr($path_info,0,$key);
                return self::whereisUrl($method,$path_info);
            }else{
                return "/error/error";
            }
        }
    }

    /**
     * 提取参数
     * @param $url
     * @param $path_url
     * @return array
     */
    static function GetParameter($url,$path_url){
        $paramener_str = trim(substr($url,strlen($path_url)),'/');
        return explode('/',$paramener_str);
    }

    /**
     * @param $url
     * @return bool|string
     */
    static function GetUrl($url){
        $key = strpos($url,'{');
        if($key>0){
            return substr($url,0,$key-1);
        }else{
            return $url;
        }
    }
}