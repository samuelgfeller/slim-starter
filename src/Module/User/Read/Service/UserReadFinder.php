<?php

namespace App\Module\User\Read\Service;

use App\Domain\Exception\DomainRecordNotFoundException;
use App\Module\User\Data\UserData;
use App\Module\User\Read\Repository\UserReadFinderRepository;

final readonly class UserReadFinder
{
    public function __construct(
        private UserReadFinderRepository $userReadFinderRepository,
    ) {
    }

    /**
     * Returns user with given id if it exists
     * otherwise an empty UserData object.
     *
     * @param string|int|null $id
     *
     * @return UserData
     */
    public function findUserById(string|int|null $id): UserData
    {
        // Find user in database and return object
        return $id ? new UserData($this->userReadFinderRepository->findUserById((int)$id)) : new UserData();
    }

    /**
     * Returns user with given id if it exists
     * otherwise throws an exception.
     *
     * @param string|int|null $id
     *
     * @throws DomainRecordNotFoundException
     *
     * @return UserData
     */
    public function getUserById(string|int|null $id): UserData
    {
        $user = $this->findUserById($id);

        if (!$user->id) {
            throw new DomainRecordNotFoundException('User not found.');
        }

        return $user;
    }
}
