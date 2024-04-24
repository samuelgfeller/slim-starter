<?php

namespace App\Application\Action\User\Ajax;

use App\Application\Responder\JsonResponder;
use App\Domain\User\Service\UserUpdater;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class UserUpdateAction
{
    public function __construct(
        private JsonResponder $jsonResponder,
        private UserUpdater $userUpdater,
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
        // Key 'user_id' for the user id in the URL is defined in the route definition in routes.php
        $userIdToChange = (int)$args['user_id'];
        $userValuesToChange = (array)$request->getParsedBody();

        // Call service function to update user with the id and values to change
        $this->userUpdater->updateUser($userIdToChange, $userValuesToChange);

        return $this->jsonResponder->encodeAndAddToResponse($response, ['status' => 'success', 'data' => null]);
    }
}
