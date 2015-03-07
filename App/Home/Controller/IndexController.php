<?php
/**
 * Created by PhpStorm.
 * User: JOOMOO
 * Date: 2015/3/4
 * Time: 18:34
 */

namespace App\Home\Controller;


use Letter\core\Controller;

class IndexController extends Controller{

    public function homeAction(){
        echo "xxx";
    }

    public function _emptyAsction(){
        echo 'empty';
    }
}