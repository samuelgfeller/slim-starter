<?php

namespace App\Domain\User\Repository;

use App\Infrastructure\Factory\QueryFactory;

/**
 * Repository that inserts user values into the database.
 *
 * Repositories are part of the Infrastructure layer but inside the Domain namespace.
 * The vertical slice architecture allows having one module folder in the Domain layer
 * and separating the layers inside the module folder to have the services, repositories,
 * and data classes together and have a better overview.
 * Documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Architecture#vertical-slice-architecture
 */
final readonly class UserCreatorRepository
{
    public function __construct(
        private QueryFactory $queryFactory
    ) {
    }

    /**
     * Insert user values into the database.
     *
     * @param array<string, int|string|null> $userRow
     *
     * @return int lastInsertId
     */
    public function insertUser(array $userRow): int
    {
        return (int)$this->queryFactory->insertQueryWithData($userRow)->into('user')->execute()->lastInsertId();
    }
}
