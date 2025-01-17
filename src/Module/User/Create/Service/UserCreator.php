<?php

namespace App\Module\User\Create\Service;

use App\Module\User\Create\Repository\UserCreatorRepository;
use App\Module\User\Data\UserData;
use App\Module\User\Validation\Service\UserValidator;

final readonly class UserCreator
{
    public function __construct(
        private UserValidator $userValidator,
        private UserCreatorRepository $userCreatorRepository,
    ) {
    }

    /**
     * User creation logic.
     *
     * @param array<string, mixed> $userValues
     *
     * @return int insert id. If a user already exists, validation exception is thrown
     */
    public function createUser(array $userValues): int
    {
        // Validate user values
        $this->userValidator->validateUserValues($userValues);

        // Create user data object
        $user = new UserData($userValues);
        // Serialize user data object to array where keys represent database fields
        $userRow = $user->toArrayForDatabase();

        // Insert new user into database
        return $this->userCreatorRepository->insertUser($userRow);
    }
}
