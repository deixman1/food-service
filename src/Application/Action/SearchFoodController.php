<?php

declare(strict_types=1);

namespace App\Application\Action;

use App\Domain\Model\Food;
use App\Domain\Service\GetFoodService;
use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class SearchFoodController extends AbstractController
{
    private readonly GetFoodService $service;

    public function __construct(
        LoggerInterface $logger,
        GetFoodService $foodService,
        ResponseFactoryInterface $responseFactory
    )
    {
        $this->service = $foodService;
        parent::__construct($logger, $responseFactory);
    }

    protected function action(ServerRequestInterface $request): ResponseInterface
    {
        $query = $request->getQueryParams()['query'];
        try {
            $foods = $this->service->searchFoodDataByQuery($query);
        } catch (GuzzleException|\Throwable $e) {
            $this->logger->error($e->__toString());
            return $this->responseFactory->createResponseWithJsonData([], StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        }
        return $this->responseFactory->createResponseWithJsonData(array_map(fn(Food $food) => [
            'id' => $food->id,
            'name' => $food->name,
            'calories' => $food->calories,
        ], $foods));
    }
}