<?php
/**
 * Created by PhpStorm.
 * User: dongxiang
 * Date: 2015/2/6
 * Time: 17:45
 */

class AutoLoader
{
    private static $loader;

    private static $classMap;

    public static function getLoader()
    {
        if(self::$loader === false){
            return self::$loader;
        }
        //self::$loader = new \Letter\load\LoadClass();
        self::$loader = new self();


        self::$classMap = require(__DIR__ . '/classMap.php');

        spl_autoload_register(array(self::$loader,'loadClass'));
    }

    public function loadClass($class)
    {
        if(isset(self::$classMap[$class])){
            require self::$classMap[$class];
        }else{
            $filePath =  './'.str_replace('\\','/',$class).'.php';

            if(file_exists($filePath)){
                require($filePath);
            }else{
                //\Letter\core\Error::setError("控制器文件不存在");
            }
        }
        //echo $class.'xxx<br />';
    }
}