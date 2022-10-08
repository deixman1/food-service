#!/usr/bin/env php
<?php

declare(strict_types=1);

use App\Application\Command\HelloCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

require_once __DIR__ . "/../vendor/autoload.php";

/** @var ContainerInterface $container */
$container = require_once __DIR__ . "/../bootstrap/container.php";

$cli = new Application('Console');

$cli->add($container->get(HelloCommand::class));

$cli->run();