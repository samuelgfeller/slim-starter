<?php

namespace App\Module\User\Read\Repository;

use App\Core\Infrastructure\Factory\QueryFactory;

final readonly class UserReadFinderRepository
{
    public function __construct(
        private QueryFactory $queryFactory,
    ) {
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
}
