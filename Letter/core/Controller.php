<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/9
 * Time: 12:03
 */

namespace Letter\core;

class Controller {
    /**
     * 事件集合
     * @var array
     */
    protected $_events = array();

    /**
     * 初始化
     */
    public function __init__(){}

    /**
     * 构造函数
     */
    public function __construct(){
        $this->__init__();
    }

    /**
     * 注册事件
     * @param $name     事件名
     * @param $handler  注册方法
     */
    public function on($name,$handler,$data = array(),$append = true){
        if($append||empty($this->_events[$name])){
            $this->_events[$name][] = [$handler,$data];
        }else{
            array_unshift($this->_events[$name],[$handler,$data]);
        }
    }

    /**
     * 执行事件
     */
    public function trigger($name,$event = null){
        if($event == null){
            $event = new \Event();
        }
        //循环调用handler
        foreach($this->_events[$name] as $handler){
            call_user_func($handler[0],$event);
            if($event->handled){
                return;
            }
        }
        //调用Event自身的触发
        Event::trigger($name);
    }

    /**
     * 模版赋值
     */
    public function assign(){

    }

    /**
     * 选取模版
     */
    public function display(){

    }

    /**
     * 解析模版
     */
    public function fetch(){

    }


} 