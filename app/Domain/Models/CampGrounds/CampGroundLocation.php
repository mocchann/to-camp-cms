<?php

namespace App\Domain\Models\CampGrounds;

use App\Domain\Enums\CampGroundLocations as EnumsCampGroundLocations;
use InvalidArgumentException;
use ValueError;

class CampGroundLocation
{
    private EnumsCampGroundLocations $camp_ground_location;

    public function __construct(
        private string $location
    ) {
        try {
            $this->camp_ground_location = EnumsCampGroundLocations::from($location);
        } catch (ValueError $e) {
            throw new InvalidArgumentException('Invalid location', $e->getMessage());
        }
    }

    public function getValue(): EnumsCampGroundLocations
    {
        return $this->camp_ground_location;
    }
}
