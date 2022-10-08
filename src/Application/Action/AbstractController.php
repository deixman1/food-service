<?php

declare(strict_types=1);

namespace App\Application\Action;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Twig\Environment;

abstract class AbstractController
{
    protected LoggerInterface $logger;
    protected RequestInterface $request;
    protected ResponseInterface $response;
    protected Environment $template;
    protected array $args;

    public function __construct(LoggerInterface $logger, Environment $template)
    {
        $this->logger = $logger;
        $this->template = $template;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
        return $this->action();
    }

    abstract protected function action(): ResponseInterface;

    protected function getJsonData(): ?array
    {
        return json_decode((string)$this->request->getBody(), true);
    }

    protected function responseJson(array $data, $status = StatusCodeInterface::STATUS_OK): ResponseInterface
    {
        $json = json_encode($data);
        $this->response->getBody()->write($json);
        return $this->response
            ->withStatus($status)
            ->withHeader('Content-Type', 'application/json');
    }

    protected function responseHtml(string $template, array $data = [], $status = StatusCodeInterface::STATUS_OK): ResponseInterface
    {
        $this->response->getBody()->write($this->template->render($template, $data));
        return $this->response
            ->withStatus($status)
            ->withHeader('Content-Type', 'text/html');
    }
}
