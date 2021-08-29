<?php

require('../classes/config.php');

spl_autoload_register(function($className) {
    require('../classes/'.strtolower($className).'.php');
});

$app = new App();

if(isset($_GET['url'])) {
    header('content-type:application/json;charset=utf-8');
    echo $app->result;
}

die;