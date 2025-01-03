<?php

namespace App\Domain\Models\CampGrounds;

use App\Domain\Enums\CampGroundLocations;

class CampGroundLocation
{
    public function __construct(
        private CampGroundLocations $locations
    ) {
        $this->locations = $locations;
    }

    public function getValue(): CampGroundLocations
    {
        return $this->locations;
    }
}
