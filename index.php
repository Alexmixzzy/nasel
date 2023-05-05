<?php

declare(strict_types=1);
require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/core/router/Router.php";



$router = new Router();

$router->runMain();

?>