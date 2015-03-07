<?php
/**
 * Created by PhpStorm.
 * User: JOOMOO
 * Date: 2015/3/6
 * Time: 13:28
 */

namespace Letter\core;


class Factory {

    public function create($classname,$arr)
    {
        $class = new $classname();
        foreach($arr as $k=>$v){
            $class->$k = $v;
        }
        return $class;
    }


}