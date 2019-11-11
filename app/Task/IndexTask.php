<?php
/**
 * Created by PhpStorm.
 * User: whr_mac
 * Date: 2019/11/11
 * Time: 12:41 PM
 */
namespace App\Task;

class IndexTask{
    /**
     * @param $data
     * @return mixed
     */
    function index($data){
        echo __DIR__.PHP_EOL;
        return $data['name'];
    }
}