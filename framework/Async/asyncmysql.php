<?php
/**
 * Created by PhpStorm.
 * User: whr_mac
 * Date: 2019/11/11
 * Time: 1:09 PM
 */
namespace Framework\Async;

class Asyncmysql{
    protected $db = null;
    protected $server = [];

    /**
     * Asyncmysql constructor.
     */
    public function __construct()
    {
        $this->db = new \swoole_mysql();
        $this->server = DBMYSQL;
    }

    /**
     * @param $sql
     */
    function query($sql){
        $this->db->connect($this->server, function ($db, $r)use ($sql) {
            if ($r === false) {
                var_dump($db->connect_errno, $db->connect_error);
                die;
            }
            $db->query($sql, function(\swoole_mysql $db, $r) {
                if ($r === false)
                {
                    var_dump($db->error, $db->errno);
                }
                elseif ($r === true )
                {
                    var_dump($db->affected_rows, $db->insert_id);
                }else{
                    var_dump($r);
                }
                $db->close();
            });
        });
    }
}