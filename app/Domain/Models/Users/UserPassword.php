<?php

namespace App\Domain\Models\Users;

use Illuminate\Support\Facades\Hash;

class UserPassword
{
    public function __construct(private string $password)
    {
        $this->password = Hash::make($password);
    }

    public function getValue(): string
    {
        return $this->password;
    }
}
