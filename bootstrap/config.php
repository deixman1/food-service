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
    'usdaApiKey' => 'laxDjxER6fI5dQJcrnzAsxJ1FUpGTg7M1MGlHfL4',
];