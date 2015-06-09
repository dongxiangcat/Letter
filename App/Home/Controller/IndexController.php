<?php
/**
 * Created by PhpStorm.
 * User: JOOMOO
 * Date: 2015/3/4
 * Time: 18:34
 */

namespace App\Home\Controller;
use Letter\core\Controller;
use Letter\core\Event;


class IndexController extends Controller{

    public function homeAction(){
        echo "xxx";
    }

    public function indexAction(){
        $event = new Event();
        $this->on('hello',function($event){
            echo 'aaaa';
            });
        $this->on('hello',function($event){
            echo 'bbb';
        });
        $this->trigger('hello',$event);
    }

    public function _emptyAction(){
        echo 'empty';
    }


}