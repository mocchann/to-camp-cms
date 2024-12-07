<?php

namespace App\Domain\Models\Users;

use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserId;
use App\Domain\Models\Users\UserName;
use App\Domain\Models\Users\UserPassword;

class User
{
    public function __construct(
        private UserId $id,
        private UserName $name,
        private UserEmail $email,
        private UserPassword $password
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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
