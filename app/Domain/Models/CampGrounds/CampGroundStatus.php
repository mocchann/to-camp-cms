<?php

namespace App\Domain\Models\CampGrounds;

use App\Domain\Enums\CampGroundStatus as EnumsCampGroundStatus;
use InvalidArgumentException;
use ValueError;

class CampGroundStatus
{
    private EnumsCampGroundStatus $camp_ground_status;

    public function __construct(
        private string $status
    ) {
        try {
            $this->camp_ground_status = EnumsCampGroundStatus::from($status);
        } catch (ValueError $e) {
            throw new InvalidArgumentException('Invalid status');
        }
    }

    public function getValue(): EnumsCampGroundStatus
    {
        return $this->camp_ground_status;
    }
}
