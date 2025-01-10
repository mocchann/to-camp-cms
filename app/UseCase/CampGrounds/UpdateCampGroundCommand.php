<?php

namespace App\UseCase\CampGrounds;

class UpdateCampGroundCommand
{
    public function __construct(
        private string $id,
        private string $name,
        private string $address,
        private int $price,
        private string $image,
        private string $status,
        private string $location,
        private int $elevation
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->price = $price;
        $this->image = $image;
        $this->status = $status;
        $this->location = $location;
        $this->elevation = $elevation;
    }

    public function getId(): string
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

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getElevation(): int
    {
        return $this->elevation;
    }
}
