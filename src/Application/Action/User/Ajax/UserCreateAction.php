<?php

namespace App\Application\Action\User\Ajax;

use App\Application\Responder\JsonResponder;
use App\Domain\User\Service\UserCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

final readonly class UserCreateAction
{
    public function __construct(
        private LoggerInterface $logger,
        private JsonResponder $jsonResponder,
        private UserCreator $userCreator,
    ) {
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $userValues = (array)$request->getParsedBody();

        $insertId = $this->userCreator->createUser($userValues);

        $this->logger->info('User "' . $userValues['email'] . '" created. ID: ' . $insertId);

        return $this->jsonResponder->encodeAndAddToResponse($response, ['status' => 'success', 'data' => null], 201);
    }
}
