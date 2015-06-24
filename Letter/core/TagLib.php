<?php
/**
 * Created by PhpStorm.
 * User: dongxiang
 * Date: 2015/6/24
 * Time: 10:13
 */

namespace Letter\core;

use Letter\Letter;
class TagLib{

    public static $instance = false;

    private $taglib = 'Core';

    public $tagobj;

    /**
     * 单例
     * @return bool|Template
     */
    public static function getInstance(){
        if(self::$instance == false){
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function __call($method,$args){
        if(method_exists($this->tagobj,$method)){
            $this->tagobj->$method();
        }
    }

    public function loadTagList(){
        $tagLibName = 'TagLib'.$this->taglib;
        $this->tagobj = Letter::getClass('Letter\\core\TagLib\\'.$tagLibName);
        return get_class_methods($this->tagobj);
    }


} 