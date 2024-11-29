<?php

namespace App\Domain\Models\Users;

class UserName
{
    public function __construct(private string $name) {}

    public function getName(): string
    {
        return $this->name;
    }
}
