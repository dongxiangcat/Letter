<?php
/**
 * Created by PhpStorm.
 * User: JOOMOO
 * Date: 2015/3/6
 * Time: 14:13
 */

namespace Letter\core;


class Controller {

    public function display()
    {

    }

    public function __call($method,$args)
    {
        Log::logged($this,$method,$args);
        //echo get_class($this) ."中".$method."方法不存在";
    }


}