<?php

namespace App\Application\Action\User\Page;

use App\Application\Responder\TemplateRenderer;
use App\Domain\Exception\DomainRecordNotFoundException;
use App\Domain\User\Service\UserFinder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

final readonly class UserReadPageAction
{
    public function __construct(
        private TemplateRenderer $templateRenderer,
        private UserFinder $userFinder,
    ) {
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
        array $args
    ): ResponseInterface {
        // Get user id from request url (key defined in route definition)
        $userId = (int)$args['user_id'];

        try {
            // Retrieve user infos
            return $this->templateRenderer->render($response, 'user/user-read.html.php', [
                'user' => $this->userFinder->getUserById($userId),
            ]);
        } catch (DomainRecordNotFoundException $domainRecordNotFoundException) {
            throw new HttpNotFoundException($request, $domainRecordNotFoundException->getMessage());
        }
    }
}
