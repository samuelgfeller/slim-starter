<?php

namespace App\Application\Action\User\Api;

use App\Application\Responder\JsonResponder;
use App\Domain\User\Service\UserFinder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class ApiUserFetchListAction
{
    public function __construct(
        private JsonResponder $jsonResponder,
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
        $users = $this->userFinder->findAllUsers();

        return $this->jsonResponder->encodeAndAddToResponse($response, $users);
    }
}
