<?php

declare(strict_types=1);

namespace App\Application\Action;

use Psr\Http\Message\ResponseInterface;

class MainPageController extends AbstractController
{
    protected function action(): ResponseInterface
    {
        return $this->responseHtml('main_page.twig');
    }
}