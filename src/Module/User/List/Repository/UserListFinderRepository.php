<?php

namespace App\Module\User\List\Repository;

use App\Infrastructure\Database\Hydrator;
use App\Infrastructure\Database\QueryFactory;
use App\Module\User\Data\UserData;

final readonly class UserListFinderRepository
{
    public function __construct(
        private QueryFactory $queryFactory,
        private Hydrator $hydrator,
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
}
