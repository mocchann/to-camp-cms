<?php

namespace App\Domain\Models\CampGrounds;

use App\Domain\Enums\CampGroundStatus as EnumsCampGroundStatus;

class CampGroundStatus
{
    public function __construct(
        private EnumsCampGroundStatus $status
    ) {
        $this->status = $status;
    }

    public function getValue(): EnumsCampGroundStatus
    {
        return $this->status;
    }
}
