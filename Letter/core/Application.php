<?php
/**
 * Created by PhpStorm.
 * User: JOOMOO
 * Date: 2015/2/6
 * Time: 18:37
 */

namespace Letter\core;

class Application
{
    public function run()
    {
        Dispacth::router();


    }
}