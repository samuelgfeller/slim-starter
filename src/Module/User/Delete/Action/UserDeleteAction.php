<?php

namespace App\Module\User\Delete\Action;

use App\Application\Responder\JsonResponder;
use App\Module\User\Delete\Service\UserDeleter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class UserDeleteAction
{
    public function __construct(
        private JsonResponder $jsonResponder,
        private UserDeleter $userDeleter,
    ) {
    }

    /**
     * Delete user action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array<string, string> $args The routing arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args,
    ): ResponseInterface {
        $userIdToDelete = (int)$args['user_id'];
        // Call service function to delete user
        $this->userDeleter->deleteUser($userIdToDelete);

        return $this->jsonResponder->encodeAndAddToResponse($response, ['status' => 'success']);
    }
}
