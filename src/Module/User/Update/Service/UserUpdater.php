<?php

namespace App\Module\User\Update\Service;

use App\Module\User\Update\Repository\UserUpdaterRepository;
use App\Module\User\Validation\Service\UserValidator;

final readonly class UserUpdater
{
    public function __construct(
        private UserValidator $userValidator,
        private UserUpdaterRepository $userUpdaterRepository,
    ) {
    }

    /**
     * Update user values service.
     *
     * @param int $userIdToChange user id on which the change is requested to be made
     * @param array<string, mixed> $userValues values to change
     *
     * @return bool
     */
    public function updateUser(int $userIdToChange, array $userValues): bool
    {
        // Add user id to user values as it's needed in the validator
        $userValues['id'] = $userIdToChange;
        $this->userValidator->validateUserValues($userValues, false);

        // Unset id from $userValues as this array will be used to update the user and id won't be changed
        unset($userValues['id']);
        // User values to change (cannot use object as unset values would be "null" and remove values in db)
        $validUpdateData = [];
        // Additional check to be sure that only columns that may be updated are sent to the database
        foreach ($userValues as $column => $value) {
            // Check that keys are one of the database columns that may be updated
            if (in_array($column, [
                'first_name',
                'last_name',
                'email',
            ], true)) {
                $validUpdateData[$column] = $value;
            } else {
                throw new \UnexpectedValueException('Not allowed to change user column ' . $column);
            }
        }

        return $this->userUpdaterRepository->updateUser($userIdToChange, $validUpdateData);
    }
}
