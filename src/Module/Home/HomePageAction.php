<?php

namespace App\Module\Home;

use App\Core\Application\Responder\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class HomePageAction
{
    public function __construct(
        private TemplateRenderer $templateRenderer,
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->templateRenderer->render(
            $response,
            'home/home.html.php',
        );
    }
}
