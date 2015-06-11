<?php
/**
 * 数据库链接类
 * User: dongxiang
 * Date: 2015/6/9
 * Time: 12:08
 */

namespace Letter\core;


class Db {

    private static $instance = false;

    /**
     * 单例实现
     * @return bool|Db
     */
    public function getInstance(){
        if(self::$instance == false)
            self::$instance = new self();
        return self::$instance;
    }

    protected function connect(){

    }

    protected function query(){

    }

} 