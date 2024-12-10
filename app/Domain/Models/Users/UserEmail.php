<?php

namespace App\Domain\Models\Users;

class UserEmail
{
    public function __construct(private string $email)
    {
        $this->email = $email;
    }

    public function getValue(): string
    {
        return $this->email;
    }
}
