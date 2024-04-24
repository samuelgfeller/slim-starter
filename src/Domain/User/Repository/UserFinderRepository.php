<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserData;
use App\Infrastructure\Factory\QueryFactory;
use App\Infrastructure\Utility\Hydrator;

final readonly class UserFinderRepository
{
    public function __construct(
        private QueryFactory $queryFactory,
        private Hydrator $hydrator
    ) {
    }

    /**
     * Return all users.
     *
     * @return UserData[]
     */
    public function findAllUsers(): array
    {
        $query = $this->queryFactory->selectQuery()->select([
            'id',
            'first_name',
            'last_name',
            'email',
            'updated_at',
            'created_at',
        ])->from('user')->where(['deleted_at IS' => null]);

        $userRows = $query->execute()->fetchAll('assoc') ?: [];

        // Convert to list of objects
        return $this->hydrator->hydrate($userRows, UserData::class);
    }

    /**
     * Return user with given id if it exists
     * otherwise null.
     *
     * @param int $id
     *
     * @return array<string, mixed> user row
     */
    public function findUserById(int $id): array
    {
        $query = $this->queryFactory->selectQuery()->select([
            'id',
            'first_name',
            'last_name',
            'email',
            'updated_at',
            'created_at',
        ])->from('user')->where(
            ['deleted_at IS' => null, 'id' => $id]
        );

        // Empty array if not found
        return $query->execute()->fetch('assoc') ?: [];
    }

    /**
     * Checks if user with given email already exists.
     *
     * @param string $email
     * @param int|null $userIdToExclude exclude user that already has the email from check (for update)
     *
     * @return bool
     */
    public function userWithEmailAlreadyExists(string $email, ?int $userIdToExclude = null): bool
    {
        $query = $this->queryFactory->selectQuery()->select(['id'])->from('user')->andWhere(
            ['deleted_at IS' => null, 'email' => $email]
        );

        if ($userIdToExclude !== null) {
            $query->andWhere(['id !=' => $userIdToExclude]);
        }

        return $query->execute()->fetch('assoc') !== false;
    }
}
