<?php

use Phinx\Seed\AbstractSeed;

/**
 * Documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Database-Migrations#seeding
 */
class UserSeeder extends AbstractSeed
{

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $userRows = [
            [
                'id' => 1,
                'first_name' => 'Steve',
                'last_name' => 'Norton',
                'email' => 'steve.norton@email.com',
            ],
            [
                'id' => 2,
                'first_name' => 'Alan',
                'last_name' => 'Brown',
                'email' => 'alan.brown@email.com',
            ],
            [
                'id' => 3,
                'first_name' => 'Sylvia',
                'last_name' => 'Hager',
                'email' => 'sylvia.hager@email.com',
            ],
            [
                'id' => 4,
                'first_name' => 'Kristin',
                'last_name' => 'Burns',
                'email' => 'kristin.burns@email.com',
            ],
        ];

        $table = $this->table('user');
        $table->insert($userRows)->saveData();
    }
}
