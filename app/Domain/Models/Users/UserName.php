<?php

namespace App\Domain\Models\Users;

class UserName
{
    public function __construct(private string $name)
    {
        $this->name = $name;
    }

    public function getValue(): string
    {
        return $this->name;
    }
}
