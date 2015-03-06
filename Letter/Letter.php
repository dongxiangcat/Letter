<?php
/**
 * Created by PhpStorm.
 * User: dongxiang
 * Date: 2015/3/5
 * Time: 14:15
 */

namespace Letter;

use Letter\core\Factory;

class Letter{

    public static $config;

    public static $alias = array();

    public static function getClass($classname,$parameters = array())
    {
        if(!isset(self::$alias[$classname])){
            $factory = new Factory();
            $class = $factory->create($classname,$parameters);
            self::$alias[$classname] = $class;

        }
        return self::$alias[$classname];
    }

}