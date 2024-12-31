<?php

namespace App\Domain\Models\CampGrounds;

class CampGround
{
    public function __construct(
        private CampGroundId $id,
        private CampGroundName $name,
        private CampGroundAddress $address,
        private CampGroundPrice $price,
        private CampGroundImage $image,
        private CampGroundStatus $status,
        private CampGroundLocation $location,
        private CampGroundElevation $elevation
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

    public function getId(): CampGroundId
    {
        return $this->id;
    }

    public function getName(): CampGroundName
    {
        return $this->name;
    }

    public function getAddress(): CampGroundAddress
    {
        return $this->address;
    }

    public function getPrice(): CampGroundPrice
    {
        return $this->price;
    }

    public function getImage(): CampGroundImage
    {
        return $this->image;
    }

    public function getStatus(): CampGroundStatus
    {
        return $this->status;
    }

    public function getLocation(): CampGroundLocation
    {
        return $this->location;
    }

    public function getElevation(): CampGroundElevation
    {
        return $this->elevation;
    }
}
