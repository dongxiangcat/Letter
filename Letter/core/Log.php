<?php
/**
 * Created by PhpStorm.
 * User: JOOMOO
 * Date: 2015/3/7
 * Time: 11:09
 */

namespace Letter\core;


use Letter\Letter;

class Log {

    public static function logged($class,$method,$args)
    {
        $file = Letter::getClass("Letter\core\File");
        //print_r($file);
        $file->write($class,$method,$args);
    }

}