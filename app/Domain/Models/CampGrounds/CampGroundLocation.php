<?php

namespace App\Domain\Models\CampGrounds;

use App\Domain\Enums\CampGroundLocations;
use InvalidArgumentException;

class CampGroundLocation
{
    private CampGroundLocations $camp_ground_location;

    public function __construct(
        private string $location
    ) {
        $this->camp_ground_location = $this->convert($location);
    }

    private function convert(string $location)
    {
        return match ($location) {
            'sea' => CampGroundLocations::SEA,
            'mountain' => CampGroundLocations::MOUNTAIN,
            'river' => CampGroundLocations::RIVER,
            'lake' => CampGroundLocations::LAKE,
            'woods' => CampGroundLocations::WOODS,
            'highland' => CampGroundLocations::HIGHLAND,
            default => throw new InvalidArgumentException("Invalid location: $location"),
        };
    }

    public function getValue(): CampGroundLocations
    {
        return $this->camp_ground_location;
    }
}
