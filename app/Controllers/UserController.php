<?php
/**
 * Created by PhpStorm.
 * User: whr_mac
 * Date: 2019/11/1
 * Time: 11:38 AM
 */
namespace App\Controllers;

class UserController{
    function index($req,$rep){
        $rep->end("123");
    }
}