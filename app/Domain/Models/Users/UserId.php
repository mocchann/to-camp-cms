<?php

namespace App\Domain\Models\Users;

class UserId
{
    public function __construct(private int $id)
    {
        $this->id = $id;
    }

    public function getValue(): int
    {
        return $this->id;
    }
}
