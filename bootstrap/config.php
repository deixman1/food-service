<?php

declare(strict_types=1);

use Monolog\Level;

return [
    'logger' => [
        'name' => 'app',
        'path' => __DIR__ . '/../logs/app.log',
        'level' => Level::Debug,
    ],
    'displayErrorDetails' => true,
    'usdaApiKey' => 'usdaApiKey',
];