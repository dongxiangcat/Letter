<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/9
 * Time: 12:03
 */

namespace Letter\core;
use Letter\Letter;

class Controller extends Application{
    /**
     * 事件集合
     * @var array
     */
    protected $_events = array();

    /**
     * 行为集合
     * @var array
     */
    protected $_behaviors = array();

    /**
     * 模版对象
     */
    protected $_templateObj;

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
     * 魔术方法 __set
     */
    public function __set($name,$value){
        $this->assign($name,$value);
    }

    /**
     * 魔术方法 __get
     */
    public function __get($name){
        if(isset($this->_assign[$name])){
            return $this->_assign[$name];
        }else{
            return false;
        }
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
            $event = Letter::getClass('Letter\core\Event');
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
     * 赋值模版方法
     * @param $name
     * @param $value
     */
    public function assign($name,$value){
        if(!$this->_templateObj){
            $this->_templateObj = Letter::getClass('Letter\core\Template',array(),true);
        }
        $this->_templateObj->vals[$name] = $value;
    }

    /**
     * 选取模版
     */
    public function display($template,$charset='utf-8'){
        echo $this->fetch($template,$charset);
    }

    /**
     * 解析模版
     */
    public function fetch($template = '',$charset){
        $this->_templateObj = Letter::getClass('Letter\core\Template',array(),true);
        $content = $this->_templateObj->fetch($template,$charset);
        return $content;
    }

}