<?php

namespace App\Domain\Models\CampGrounds;

class CampGroundStatus
{
    public function __construct(
        private string $status
    ) {
        $this->status = $status;
    }

    public function getValue(): string
    {
        return $this->status;
    }
}
