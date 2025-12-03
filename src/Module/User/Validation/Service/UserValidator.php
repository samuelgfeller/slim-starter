<?php

namespace App\Module\User\Validation\Service;

use App\Module\User\Validation\Repository\UserValidationExistenceCheckerRepository;
use App\Module\Validation\Exception\ValidationException;
use Cake\Validation\Validator;

final readonly class UserValidator
{
    public function __construct(
        private UserValidationExistenceCheckerRepository $userValidationExistenceCheckerRepository,
    ) {
    }

    /**
     * Validate user creation and update.
     *
     * @param array<string, mixed> $userValues
     * @param bool $isCreateMode
     */
    public function validateUserValues(array $userValues, bool $isCreateMode = true): void
    {
        $validator = new Validator();

        // Cake validation library automatically sets a rule that fields cannot be null as soon as there is any
        // validation rule set for the field. This is why we have to allowEmptyString to allow null.

        // For the user, there are no optional fields meaning that if any field is passed, it has to contain a value.
        $validator
            // First name and last_name are required to have values if they're given so no allowEmptyString
            ->requirePresence('first_name', $isCreateMode, 'Field is required')
            ->minLength('first_name', 2, 'Minimum length is 2')
            ->maxLength('first_name', 100, 'Maximum length is 100')
            // Disallow empty strings as field is required
            ->notEmptyString('first_name', 'Required')
            ->requirePresence('last_name', $isCreateMode, 'Field is required')
            ->minLength('last_name', 2, 'Minimum length is 2')
            ->maxLength('last_name', 100, 'Maximum length is 100')
            ->notEmptyString('last_name', 'Required')
            ->requirePresence('email', $isCreateMode, 'Field is required')
            // email() automatically disallows empty strings
            ->email('email', false, 'Invalid email')
            ->add('email', 'emailIsUnique', [
                'rule' => function ($value, $context) {
                    // Check if email already exists. On update requests, the user id is passed to exclude it from the check
                    return !$this->userValidationExistenceCheckerRepository->userWithEmailAlreadyExists(
                        $value,
                        $context['data']['id'] ?? null
                    );
                },
                'message' => 'Email already exists',
            ]);

        // Validate and throw exception if there are errors
        $errors = $validator->validate($userValues);
        if ($errors) {
            throw new ValidationException($errors);
        }
    }
}
