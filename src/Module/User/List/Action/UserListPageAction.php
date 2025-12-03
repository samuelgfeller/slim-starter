<?php

namespace App\Module\User\List\Action;

use App\Application\Responder\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class UserListPageAction
{
    public function __construct(private TemplateRenderer $templateRenderer)
    {
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array<string, string> $args
     *
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args,
    ): ResponseInterface {
        return $this->templateRenderer->render($response, 'user/user-list.html.php');
    }
}
