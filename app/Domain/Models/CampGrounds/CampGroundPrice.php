<?php

namespace App\Domain\Models\CampGrounds;

class CampGroundPrice
{
    public function __construct(
        private int $price
    ) {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
