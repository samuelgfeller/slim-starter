<?php

namespace App\Domain\User\Service;

use App\Domain\Exception\DomainRecordNotFoundException;
use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserFinderRepository;

final readonly class UserFinder
{
    public function __construct(
        private UserFinderRepository $userFinderRepository,
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
        return $id ? new UserData($this->userFinderRepository->findUserById((int)$id)) : new UserData();
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

    /**
     * Return all users stored in the database.
     *
     * @return UserData[]
     */
    public function findAllUsers(): array
    {
        return $this->userFinderRepository->findAllUsers();
    }
}
