<?php
/**
 * Created by PhpStorm.
 * User: dongxiang
 * Date: 2015/3/5
 * Time: 14:15
 */

namespace Letter;


class Letter{

    public static $config;
    /**
     * 类树
     * @var array
     */
    public static $alias = array();

    /**
     * 获取类对象
     * @param $classname
     * @param array $parameters
     * @param boolean   $type   true为单例模式
     * @return mixed
     */
    public static function getClass($classname,$parameters = array(),$type = false)
    {
        if(!isset(self::$alias[$classname])){
            if($type == false)
                $class = self::create($classname,$parameters);
            else
                $class = self::createStatic($classname,$parameters);

            self::$alias[$classname] = $class;

        }
        return self::$alias[$classname];
    }

    /**
     * 实例化类
     * @param $classname
     * @param $arr
     * @return mixed
     */
    public static function create($classname,$arr)
    {
        $class = new $classname();
        foreach($arr as $k=>$v){
            $class->$k = $v;
        }
        return $class;
    }

    /**
     * 实例化静态类
     * @param $classname
     * @param $arr
     * @return mixed
     */
    public static function createStatic($classname,$arr = array())
    {
        $class = $classname::getInstance();
        foreach($arr as $k=>$v){
            $class->$k = $v;
        }
        return $class;
    }

}