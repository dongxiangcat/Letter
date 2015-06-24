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

    public $taglist = array();

    protected $Tag;

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
     * @param   string      $template       模版名
     */
    public function fetch($template = '',$charset = 'utf-8'){
        if($template == '') $template = Letter::$config['Action'];
        return $this->load($template,$charset);
    }

    /**
     * 导入模版
     */
    public function load($template,$charset){
        //输出编码
        header("Content-type: text/html; charset=".$charset);

        return $this->loadCache($template);
    }

    /**
     * 导入缓存模版
     */
    public function loadCache($template){
        //模版路径
        $templateDir = APP_PATH .'/'. Letter::$config['Module'] . '/' .Letter::$config['templateTpl']. '/' . Letter::$config['Controller'] .'/';
        $templateFile = $templateDir . $template . '.' . Letter::$config['suffix'];
        //缓存路径
        $cacheFile = APP_PATH .'/'.Letter::$config['cacheTpl'].'/'.md5($template).'.php';
        if(file_exists($cacheFile) && filemtime($templateFile) <= filemtime($cacheFile)){
            return file_get_contents($cacheFile);
        }

        $templateContent = file_get_contents($templateFile);
        return $this->compiler($templateContent);
    }

    /**
     * 编译模版内容
     * @param $temContent
     */
    public function compiler($templateContent){
        $this->Tag = Letter::getClass('Letter\core\TagLib',array(),true);
        $this->taglist = $this->Tag->loadTagList();
        foreach($this->taglist as $v){
            if(stripos($templateContent,Letter::$config['startTag'].substr($v,1))!==false){
                //解析
                $this->parseTagLib($templateContent,$v);
            }
        }

        return true;
    }


    /**
     * 解析标签
     */
    public function parseTagLib($content,$tag){
        $this->Tag->$tag();
    }

    /**
     * 解析全局变量
     */
    public function parseGlobal(){}

}