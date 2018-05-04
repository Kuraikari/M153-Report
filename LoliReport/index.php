<?php

//foreach(glob('{models/*.php,controller/*.php}',GLOB_BRACE) as $value)
//{
//    include_once $value;
//}

require 'services/Sessionmanagement.php';
require("Autoloader.php");

\services\Sessionmanagement::start();

function debug($var)
{
    echo "<pre>";
    print_r( $var );
    echo "</pre>";
}

$route = new \Route();

$route->submit();

