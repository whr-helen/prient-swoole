<?php
/**
 * Created by PhpStorm.
 * User: whr_mac
 * Date: 2019/11/1
 * Time: 11:11 AM
 * 以下为系统参数，请勿乱修改
 * 修改后请重启服务
 */
### 先看一下数据
// DEBUG=true:Requests per second:38861.82 [#/sec] (mean)
// DEBUG=false:Requests per second:52062.45 [#/sec] (mean)
define("DEBUG",false);//调试模式建议下开启,开启后代码实时跟新生效。
define("HOST","127.0.0.1");//主机
define("PROT",9503);//端口
define("PATH_INFO",1);//PATH_INFO 0为默认的路由模式1为restful路由模式
define("HOSTS",dirname(__DIR__));//根目录
# swoole配置
define("SYSTEM",[
    'task_worker_num' =>20,//task worker数量
    'daemonize' => false,//开启守护进程
    'log_file' => HOSTS.'/data/log/swoole.log',//开启日志
    'enable_static_handler' => true,//开启静态理由
    'document_root' => HOSTS.'/data',
    'static_handler_locations' => [
        '/log'=>HOSTS.'/data/log'
    ],
]);