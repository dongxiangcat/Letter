<?php


$config = require(__DIR__ . '/Letter/conf/config.php');

defined('LETTER_PATH') or define('LETTER_PATH','./Letter');
defined('APP_PATH') or define('APP_PATH','./App');

require(__DIR__ .'/Letter/autoload.php');

(new Letter\core\Application($config))->run();