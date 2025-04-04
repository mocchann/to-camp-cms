<?php

namespace App\UseCase\CampGrounds;

class GetCampGroundsCommand
{
    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
        private ?string $address = null,
        private ?int $price = null,
        private ?string $image = null,
        private ?string $status = null,
        private ?string $locations = null,
        private ?int $elevation = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->price = $price;
        $this->image = $image;
        $this->status = $status;
        $this->locations = $locations;
        $this->elevation = $elevation;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getLocations(): ?string
    {
        return $this->locations;
    }

    public function getElevation(): ?int
    {
        return $this->elevation;
    }
}
