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

    /**
     * 魔术方法 __call
     */
    public function __call($method,$args){
        //检测behaviors，实现代理模式
        $res = $this->isBehaviorExists($method);
        if($res!==false){
            return $res;
        }
        return false;
    }


    /**
     * 调用的方法是否在behaviors中存在
     */
    public function isBehaviorExists($method){
        if(!method_exists($this,'behaviors')){
            return false;
        }else{
            $behaviors = $this->_behaviors();
            foreach($behaviors as $name=>$action){
                if(method_exists($action(),$method)){
                    return $action()->$method();
                }
            }
            return false;
        }
    }

    public function _behaviors(){
        //$behaviors = $this->behaviors();
        return [
            'Letter/core/Function/Common'
        ];
    }

    public function behaviors(){}


    public function init($config)
    {
        foreach($config as $k=>$v){
            Letter::$config[$k] = $v;
        }
    }

}