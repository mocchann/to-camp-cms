<?php

namespace App\Domain\Models\Users;

class UserPassword
{
    public function __construct(private string $password)
    {
        $this->password = $password;
    }

    public function getValue(): string
    {
        return $this->password;
    }
}
