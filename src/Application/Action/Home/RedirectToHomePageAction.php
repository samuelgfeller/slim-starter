<?php

namespace App\Application\Action\Home;

use App\Application\Responder\RedirectHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Redirect url to the home page.
 * Required to test RedirectHandler.
 */
final readonly class RedirectToHomePageAction
{
    public function __construct(
        private RedirectHandler $redirectHandler,
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->redirectHandler->redirectToRouteName($response, 'home-page');
    }
}
