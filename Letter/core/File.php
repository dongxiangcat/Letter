<?php
/**
 * Created by PhpStorm.
 * User: JOOMOO
 * Date: 2015/3/7
 * Time: 11:23
 */

namespace Letter\core;


class File {

    public function write($class,$method,$args){
        echo get_class($class);
    }

    public function createFile(){

    }

}