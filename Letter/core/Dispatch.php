<?php
/**
 * Created by PhpStorm.
 * User: dongxiang
 * Date: 2015/2/9
 * Time: 18:30
 */
namespace Letter\core;
use Letter\Letter;

class Dispatch
{
    public static function router()
    {
        Router::resolve();
        $controllerSpace = self::getControllerName(Router::$module,Router::$controller);
        $actionSpace = self::getActionName(Router::$action);

        $dispatchArr = array();
        $dispatchArr['module'] = Router::$module;
        $dispatchArr['controller'] = $controllerSpace;
        $dispatchArr['action'] = $actionSpace;
        return $dispatchArr;

    }

    private static function getControllerName($module,$controller){
        $app = substr(APP_PATH,2);
        if($controller){
            $controllerSpace = $app .'\\'. $module .'\\Controller\\' . Router::$controller;
            $controllerSpace = self::completion($controllerSpace,'controller');
        }else{
            $controllerSpace = $app . $module .'\\Controller\\' . Letter::$config['emptyController'];
            $controllerSpace = self::completion($controllerSpace,'controller');
        }
        return $controllerSpace;
    }


    private static function getActionName($action){
        if($action){
            $actionSpace = self::completion(Router::$action,'action');
        }else{
            $actionSpace = self::completion(Letter::$config['emptyAction'],'action');
        }
        return $actionSpace;
    }


    private static function completion($str,$type){
        switch($type){
            case 'controller':
                $str .= 'Controller';
                break;
            case 'action':
                $str .= 'Action';
                break;
        }
        return $str;
    }
}





