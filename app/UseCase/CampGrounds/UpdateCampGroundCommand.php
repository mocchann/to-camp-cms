<?php

namespace App\UseCase\CampGrounds;

class UpdateCampGroundCommand
{
    public function __construct(
        private int $id,
        private string $name,
        private string $address,
        private int $price,
        private string $image,
        private string $status
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->price = $price;
        $this->image = $image;
        $this->status = $status;
    }
}
