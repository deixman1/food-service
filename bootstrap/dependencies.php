<?php

declare(strict_types=1);

use App\Application\Response\ResponseFactory;
use App\Domain\Infrastructure\UsdaApi\UsdaApi;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;

return [
    'config' => require_once __DIR__ . '/config.php',
    LoggerInterface::class => function (ContainerInterface $container) {
        $config = $container->get('config')['logger'];
        $logger = new Logger($config['name']);
        $handler = new StreamHandler($config['path'], $config['level']);
        $logger->pushHandler($handler);
        return $logger;
    },
    UsdaApi::class => function (ContainerInterface $container) {
        $key = $container->get('config')['usdaApiKey'];
        return new UsdaApi(new Client(), $key);
    },
    ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return new ResponseFactory();
    }
];

