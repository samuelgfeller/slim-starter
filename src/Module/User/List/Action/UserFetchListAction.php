<?php

namespace App\Module\User\List\Action;

use App\Application\Responder\JsonResponder;
use App\Module\User\List\Service\UserListFinder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class UserFetchListAction
{
    public function __construct(
        private JsonResponder $jsonResponder,
        private UserListFinder $userFinder,
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
        // Retrieve users
        $userDataArray = $this->userFinder->findAllUsers();

        return $this->jsonResponder->encodeAndAddToResponse($response, ['userDataArray' => $userDataArray]);
    }
}
