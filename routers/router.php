<?php
/**
 * Created by PhpStorm.
 * User: whr_mac
 * Date: 2019/11/1
 * Time: 11:22 AM
 *
 * 例：/user/index  Restful::get("index/{id}/{name}",["index"=>"IndexController@index"]);
 * 路由规范：Restful::method("index",["user"=>"控制器@方法"]);
 * method：'get','post','put','delete','head'
 * {id}/{name}可以为空
 * $parameter array :该参数为restful 后面带的参数数组
 *
 */
use Framework\Router\Restful;

Restful::get("",function($req, $rep,$parameter = null){
    $rep->end("hello prient1222");
});

Restful::get("index/test",function($req, $rep,$parameter = null){
    $rep->end(json_encode($parameter));
});

Restful::get("index/{id}/{name}",["index"=>"IndexController@index"]);

Restful::post("index",["index"=>"IndexController@index"]);

Restful::delete("index",["index"=>"IndexController@index"]);

Restful::put("index",["index"=>"IndexController@index"]);
