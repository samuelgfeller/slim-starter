<?php

namespace App\Test\Fixture;

/**
 * User values inserted into the database for testing.
 * Documentation: https://samuel-gfeller.ch/docs/Writing-Tests#fixtures.
 */
class UserFixture
{
    // Table name
    public string $table = 'user';

    /** @var array<array<string, int|string|null>> */
    public array $records = [
        [
            // id set in the fixture is not used as it's auto increment
            'id' => 1,
            'first_name' => 'Example',
            'last_name' => 'User',
            'email' => 'user@example.com',
            // The first user MUST not be deleted
            'deleted_at' => null,
        ],
    ];
}
