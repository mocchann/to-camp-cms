<?php

namespace App\Domain\Models\CampGrounds;

use App\Domain\Enums\CampGroundStatus as EnumsCampGroundStatus;
use InvalidArgumentException;

class CampGroundStatus
{
    private EnumsCampGroundStatus $camp_ground_status;

    public function __construct(
        private string $status
    ) {
        $this->camp_ground_status = $this->convert($status);
    }

    private function convert(string $status): EnumsCampGroundStatus
    {
        return match ($status) {
            'draft' => EnumsCampGroundStatus::DRAFT,
            'published' => EnumsCampGroundStatus::PUBLISHED,
            'archived' => EnumsCampGroundStatus::ARCHIVED,
            default => throw new InvalidArgumentException('Invalid status'),
        };
    }

    public function getValue(): EnumsCampGroundStatus
    {
        return $this->camp_ground_status;
    }
}
