<?php

declare(strict_types=1);

use App\Application\Action\MainPageController;
use App\Application\Action\SearchFoodController;
use Slim\App;

return static function (App $app) {
    $app->get('/', MainPageController::class);
    $app->get('/search-food', SearchFoodController::class);
};
