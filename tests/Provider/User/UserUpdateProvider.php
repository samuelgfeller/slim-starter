<?php

namespace App\Test\Provider\User;

class UserUpdateProvider
{
    /**
     * Returns combinations of invalid data to trigger validation exception
     * for modification.
     *
     * @return array<array<int|string, mixed>>
     */
    public static function invalidUserUpdateCases(): array
    {
        // Including as many values as possible that trigger validation errors in each case
        return [
            [
                'requestBody' => [
                    // Values too short
                    'first_name' => 'n',
                    'last_name' => 'n',
                    'email' => 'new.email@tes$t.ch',
                ],
                'expectedJsonResponse' => [
                    'status' => 'error',
                    'message' => 'Validation error',
                    'data' => [
                        'errors' => [
                            'first_name' => [0 => 'Minimum length is 2'],
                            'last_name' => [0 => 'Minimum length is 2'],
                            'email' => [0 => 'Invalid email'],
                        ],
                    ],
                ],
            ],
            [
                // Values too long
                'requestBody' => [
                    'first_name' => str_repeat('i', 101),
                    'last_name' => str_repeat('i', 101),
                    'email' => 'existing@email.com',
                ],
                'expectedJsonResponse' => [
                    'status' => 'error',
                    'message' => 'Validation error',
                    'data' => [
                        'errors' => [
                            'first_name' => [0 => 'Maximum length is 100'],
                            'last_name' => [0 => 'Maximum length is 100'],
                            'email' => [0 => 'Email already exists'],
                        ],
                    ],
                ],
            ],
        ];
    }
}
