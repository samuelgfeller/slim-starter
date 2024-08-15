<?php

namespace App\Test\Provider\User;

/**
 * Provider documentation: https://samuel-gfeller.ch/docs/Writing-Tests#data-providers.
 */
class UserCreateProvider
{
    /**
     * Returns combinations of invalid data to trigger validation exception.
     *
     * @return array<array<int|string, mixed>>
     */
    public static function invalidUserCreateCases(): array
    {
        // Including as many values as possible that trigger validation errors in each case
        return [
            // The key name of the datasets for each test case (e.g. 'too-short', 'too-long' etc.) is indicative
            // when a test fails. The key name is displayed in the test output.
            'too-short' => [
                // The requestBody and expectedJsonResponse keys must match the parameter names of the test function
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
            'too-long' => [
                // Values too long
                'requestBody' => [
                    'first_name' => str_repeat('i', 101),
                    'last_name' => str_repeat('i', 101),
                    // Existing email (fixture inserted in test function)
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
            'empty-values' => [
                // Required values not given
                'requestBody' => [
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                ],
                'expectedJsonResponse' => [
                    'status' => 'error',
                    'message' => 'Validation error',
                    'data' => [
                        'errors' => [
                            'first_name' => [0 => 'Required'],
                            'last_name' => [0 => 'Required'],
                            'email' => [0 => 'Invalid email'],
                        ],
                    ],
                ],
            ],
            'empty-request-body' => [
                'requestBody' => [],
                'expectedJsonResponse' => [
                    'status' => 'error',
                    'message' => 'Validation error',
                    'data' => [
                        'errors' => [
                            'first_name' => [0 => 'Field is required'],
                            'last_name' => [0 => 'Field is required'],
                            'email' => [0 => 'Field is required'],
                        ],
                    ],
                ],
            ],
        ];
    }
}
