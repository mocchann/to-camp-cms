<?php

namespace App\Domain\Models\CampGrounds;

class CampGroundAddress
{
    public function __construct(
        private string $address
    ) {
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}
