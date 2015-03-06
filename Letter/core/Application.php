<?php
/**
 * Created by PhpStorm.
 * User: JOOMOO
 * Date: 2015/2/6
 * Time: 18:37
 */

namespace Letter\core;

use Letter\Letter;

class Application
{

    public function __construct($config)
    {
        $this->init($config);
        $err = Letter::getClass('Letter\core\Error');
        set_error_handler(array($err,'setError'));
    }

    public function run()
    {
        $dispatchArr = Dispatch::router();
        $controller = $dispatchArr['controller'];
        $action = $dispatchArr['action'];
        //print_r($dispatchArr);
        if(class_exists($controller)){
            $con = Letter::getClass($controller);
        }elseif(class_exists(Letter::$config['emptyController'].'Controller')){
            $controller = Letter::$config['emptyController'].'Controller';
            $con = Letter::getClass($controller);
        }else{
            trigger_error("控制器".$controller."不存在", E_USER_ERROR);
        }


        if(isset($con)&&method_exists($con,$action)){
            $con->$action();
        }elseif(isset($con)&&method_exists($con,Letter::$config['emptyAction'].'Action')){
            $action = Letter::$config['emptyAction'].'Action';
            $con->$action();
        }else{
            trigger_error("action ".$action."不存在", E_USER_ERROR);
        }

    }

    public function init($config)
    {
        foreach($config as $k=>$v){
            Letter::$config[$k] = $v;
        }
    }

}