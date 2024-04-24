<?php

namespace App\Infrastructure\Utility;

class Settings
{
    /** @var array<string, mixed> */
    private array $settings;

    /**
     * @param array<string, mixed> $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Get settings by key.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $this->settings[$key] ?? null;
    }
}
