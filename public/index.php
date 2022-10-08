<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;

$container = require_once __DIR__ . "/../bootstrap/container.php";

$app = AppFactory::createFromContainer($container);

$routers = require_once __DIR__ . '/../bootstrap/routes.php';
$routers($app);

$middleware = require_once __DIR__ . '/../bootstrap/middleware.php';
$middleware($app, $container);

$app->run();
