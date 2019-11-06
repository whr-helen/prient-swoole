# prient-swoole

prient-swoole基于Swoole扩展的分布式持久内存PHP框架。它是专门为restful风格API创建的，旨在消除与流程调用和文件加载相关的性能损失。
框架封装了Swoole服务器，并且仍然保持Swoole服务器的原始功能。
<li>基于Swoole扩展</li>
<li>内置HTTP协程服务器</li>
<li>协程和异步任务传递</li>
<li>自定义用户流程</li>
<li>支持RESTful</li>
<li>高性能路由器</li>
<li>服务热重启</li>



# AB测试
```
namespace App\Controllers;

use Framework\Http\Http;

class IndexController extends Http {
    function index(\swoole_http_request $req,\swoole_http_response $rep,$parameter = null){
        $query_string = isset($req->server['query_string'])?$req->server['query_string']:null;
        //路由地址
        $rep->end(json_encode($parameter));
    }
}
```
### 本地mac机子测试结果
```$xslt
Server Software:        swoole-http-server
Server Hostname:        127.0.0.1
Server Port:            9503

Document Path:          /index/index/1/1
Document Length:        9 bytes

Concurrency Level:      100
Time taken for tests:   0.578 seconds
Complete requests:      10000
Failed requests:        0
Total transferred:      1560000 bytes
HTML transferred:       90000 bytes
Requests per second:    17309.33 [#/sec] (mean)
Time per request:       5.777 [ms] (mean)
Time per request:       0.058 [ms] (mean, across all concurrent requests)
Transfer rate:          2636.97 [Kbytes/sec] received
```
###比较
同样环境下看看 easyswoole的ab测试
```$xslt
Server Software:        EasySwoole
Server Hostname:        127.0.0.1
Server Port:            9501

Document Path:          /
Document Length:        1502 bytes

Concurrency Level:      100
Time taken for tests:   0.873 seconds
Complete requests:      10000
Failed requests:        0
Total transferred:      16440000 bytes
HTML transferred:       15020000 bytes
Requests per second:    11460.88 [#/sec] (mean)
Time per request:       8.725 [ms] (mean)
Time per request:       0.087 [ms] (mean, across all concurrent requests)
Transfer rate:          18400.09 [Kbytes/sec] received

```

## 快速开始
```$xslt
前提安装了swoole.so拓展
git@github.com:whr-helen/prient-swoole.git
php server.php
```

<li>QQ交流：850388667</li>
    未完待续...

