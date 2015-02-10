<?php


defined('LETTER_PATH') or define('LETTER_PATH','./Letter');

require(__DIR__ .'/Letter/autoload.php');

(new Letter\core\Application())->run();