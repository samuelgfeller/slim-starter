<?php

namespace App\Module\User\Delete\Service;

use App\Module\User\Delete\Repository\UserDeleterRepository;

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
