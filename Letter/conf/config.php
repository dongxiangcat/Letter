<?php
/**
 * Created by PhpStorm.
 * User: JOOMOO
 * Date: 2015/3/4
 * Time: 17:49
 */

return [
    'pathType'          => 1,       //0.普通模式   1.pathinfo模式
    //普通模式
    'moduleSign'        => 'm',
    'controllerSign'    => 'c',
    'actionSign'        => 'a',
    //pathinfo模式
    'pathLink'          => '/',     //URL 连接符

    'emptyController'   => 'Empty', //空控制器
    'emptyAction'       => '_empty',//空操作

    'defaultModule'     => 'Home',
    'defaultController' => 'Index',
    'defaultAction'     => 'index',

    'suffix'            => 'html',
    'templateTpl'       => 'Tpl',
];