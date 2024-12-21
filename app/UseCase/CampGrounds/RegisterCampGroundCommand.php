<?php

namespace App\UseCase\CampGrounds;

class RegisterCampGroundCommand
{
    public function __construct(
        private int $id,
        private string $name,
        private string $address,
        private int $price,
        private string $image,
        private string $status
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
