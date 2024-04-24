<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserDeleterRepository;

final readonly class UserDeleter
{
    public function __construct(private UserDeleterRepository $userDeleterRepository)
    {
    }

    /**
     * Delete user service.
     *
     * @param int $userIdToDelete
     *
     * @return bool
     */
    public function deleteUser(int $userIdToDelete): bool
    {
        return $this->userDeleterRepository->deleteUserById($userIdToDelete);
    }
}
