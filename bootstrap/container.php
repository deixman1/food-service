<?php

declare(strict_types=1);

use DI\ContainerBuilder;

require_once __DIR__ . "/../vendor/autoload.php";

$containerBuilder = new ContainerBuilder;

$containerBuilder->useAnnotations(false);
$containerBuilder->useAutowiring(true);
// Set up dependencies
$containerBuilder->addDefinitions(require_once __DIR__ . '/dependencies.php');

return $containerBuilder->build();