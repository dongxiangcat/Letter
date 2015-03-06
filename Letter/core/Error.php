<?php
/**
 * Created by PhpStorm.
 * User: JOOMOO
 * Date: 2015/3/5
 * Time: 16:23
 */

namespace Letter\core;


class Error {
    private $errorinfo;

    public function getError(){
        return $this->$errorinfo;
    }

    public function setError($errno, $errstr, $errfile, $errline){
        //echo $errstr;
        switch($errno){
            case E_USER_ERROR:
                echo "<b>".$errstr."</b><br />";
                echo $errline;
                exit;
                break;
            case E_USER_WARNING:
                break;
            case E_USER_NOTICE:
                break;
            default:
                break;
        }
    }
}