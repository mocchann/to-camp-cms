<?php

namespace App\Domain\Models\CampGrounds;

class CampGroundElevation
{
    public function __construct(
        private int $elevation
    ) {
        $this->elevation = $elevation;
    }

    public function getValue(): int
    {
        return $this->elevation;
    }
}
