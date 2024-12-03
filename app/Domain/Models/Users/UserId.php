<?php

namespace App\Domain\Models\Users;

class UserId
{
    public function __construct(
        private int $id
    ) {}

    public function getId(): int
    {
        return $this->id;
    }
}
