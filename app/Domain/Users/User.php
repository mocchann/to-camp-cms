<?php

namespace App\Domain\Users;

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
