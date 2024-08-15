<?php

namespace App\Domain\User\Data;

/**
 * User DTO (Data Transfer Object) class.
 * This class is used to transfer data between the different layers of the application
 * and serialize it for the frontend or database.
 * Documentation: https://samuel-gfeller.ch/docs/Domain#data-transfer-object-dto.
 */
class UserData implements \JsonSerializable
{
    // Variable names matching database columns (camelCase instead of snake_case)
    public ?int $id;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $email;
    public ?\DateTimeImmutable $updatedAt;
    public ?\DateTimeImmutable $createdAt;

    /**
     * @param array<string, mixed> $userData
     */
    public function __construct(array $userData = [])
    {
        // Keys may be taken from view form or database, so they have to correspond to both; otherwise use mapper
        $this->id = $userData['id'] ?? null;
        $this->firstName = $userData['first_name'] ?? null;
        $this->lastName = $userData['last_name'] ?? null;
        $this->email = $userData['email'] ?? null;
        try {
            $this->updatedAt = $userData['updated_at'] ?? null ? new \DateTimeImmutable($userData['updated_at']) : null;
        } catch (\Exception $e) {
            $this->updatedAt = null;
        }
        try {
            $this->createdAt = $userData['created_at'] ?? null ? new \DateTimeImmutable($userData['created_at']) : null;
        } catch (\Exception $e) {
            $this->createdAt = null;
        }
    }

    /**
     * Serialize the object to an array where the keys
     * represent the database fields.
     *
     * @return array<string, int|string|null>
     */
    public function toArrayForDatabase(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
        ];
    }

    /**
     * Define how json_encode() should serialize the object
     * camelCase according to Google recommendation https://stackoverflow.com/a/19287394/9013718.
     *
     * @return array<string, mixed> in the format expected by the frontend
     */
    public function jsonSerialize(): array
    {
        // camelCase according to Google recommendation https://stackoverflow.com/a/19287394/9013718
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'updatedAt' => $this->updatedAt?->format('Y-m-d H:i:s'),
            'createdAt' => $this->createdAt?->format('Y-m-d H:i:s'),
        ];
    }
}
