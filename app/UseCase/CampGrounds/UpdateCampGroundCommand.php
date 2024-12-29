<?php

namespace App\UseCase\CampGrounds;

use App\Domain\Enums\CampGroundStatus;

class UpdateCampGroundCommand
{
    public function __construct(
        private int $id,
        private string $name,
        private string $address,
        private int $price,
        private string $image,
        private CampGroundStatus $status
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->price = $price;
        $this->image = $image;
        $this->status = $status;
    }

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

    public function getStatus(): CampGroundStatus
    {
        return $this->status;
    }
}
