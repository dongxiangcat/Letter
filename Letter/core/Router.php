<?php
/**
 * Created by PhpStorm.
 * User: JOOMOO
 * Date: 2015/3/4
 * Time: 17:57
 */

namespace Letter\core;


use Letter\Letter;

class Router{

    public static $module;
    public static $controller;
    public static $action;

    public static function resolve()
    {
        $offset = 0;
        if(stripos($_SERVER['PHP_SELF'],'/index.php')!==false){
            $offset = 10;
        }
        //echo $_SERVER['PHP_SELF'];
        //echo $offset;
        $routerStr = substr($_SERVER['PHP_SELF'],$offset);
        //echo $routerStr;
        self::getName($routerStr,Letter::$config['pathType']);

    }

    protected static function getName($routerStr,$type)
    {
        $routerArr = array();
        switch($type){
            case 0:
                $routerArr[] = isset($_GET[Letter::$config['moduleSign']])?$_GET[Letter::$config['moduleSign']]:Letter::$config['defaultModule'];
                $routerArr[] = isset($_GET[Letter::$config['controllerSign']])?$_GET[Letter::$config['controllerSign']]:Letter::$config['defaultController'];
                $routerArr[] = isset($_GET[Letter::$config['actionSign']])?$_GET[Letter::$config['actionSign']]:Letter::$config['defaultAction'];
                break;
            case 1:
                $routerArr = explode(Letter::$config['pathLink'],ltrim($routerStr,'/'));
                break;
        }
        //检测模块是否存在
        self::$module = (isset($routerArr[0])&&!empty($routerArr[0]))?$routerArr[0]:Letter::$config['defaultModule'];

        if(!file_exists(APP_PATH.'/'.self::$module)){
            trigger_error("模块".self::$module."不存在",E_USER_ERROR);
        }
        self::$controller = isset($routerArr[1])?$routerArr[1]:Letter::$config['defaultController'];
        self::$action = isset($routerArr[2])?$routerArr[2]:Letter::$config['defaultAction'];

    }

}