<?php

namespace App\Domain\Users;

use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserId;
use App\Domain\Models\Users\UserName;

class User
{
    public function __construct(
        private readonly UserId $id,
        private UserName $name,
        private UserEmail $email
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): UserName
    {
        return $this->name;
    }

    public function getEmail(): UserEmail
    {
        return $this->email;
    }
}
