<?php

declare(strict_types=1);

namespace App\Application\Action;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractController
{
    protected LoggerInterface $logger;
    protected ResponseFactoryInterface $responseFactory;

    public function __construct(LoggerInterface $logger, ResponseFactoryInterface $responseFactory)
    {
        $this->logger = $logger;
        $this->responseFactory = $responseFactory;
    }

    abstract protected function action(ServerRequestInterface $request): ResponseInterface;

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->action($request);
    }
}
