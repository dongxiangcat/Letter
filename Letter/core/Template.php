<?php
/**
 * 模版类
 * User: dongxiang
 * Date: 2015/6/10
 * Time: 9:38
 */

namespace Letter\core;

use Letter\Letter;

class Template {

    /**
     * 模版变量
     * @var array
     */
    public $vals = array();

    /**
     * 模版文件
     * @var bool
     */
    public $templateFile = '';

    protected static $instance = false;

    final protected function __construct(){}

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

    /**
     * 控制器访问入口
     */
    public function fetch($template = '',$charset = 'utf-8'){
        if($template == '') $template = Letter::$config['Action'];

        $templateFile = APP_PATH .'/'. Letter::$config['Module'] . '/' .Letter::$config['templateTpl']. '/' . Letter::$config['Controller'] .'/'.Letter::$config['Action'];
        $templateFile .= '.' . Letter::$config['suffix'];
        echo $templateFile;
        $tempContent = file_get_contents($templateFile);
        print_r($tempContent);

        return $this->load($templateFile,$charset);
    }

    /**
     * 导入模版
     */
    public function load($templateFile,$charset){
        $tempContent = file_get_contents($templateFile);

        header("Content-type: text/html; charset=".$charset);

        return $this->compiler($tempContent);
    }

    /**
     * 编译模版内容
     * @param $temContent
     */
    public function compiler($tempContent){

        return true;
    }

} 