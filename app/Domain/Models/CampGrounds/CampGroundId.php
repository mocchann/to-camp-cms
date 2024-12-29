<?php

namespace App\Domain\Models\CampGrounds;

class CampGroundId
{
    public function __construct(
        private int $id
    ) {
        $this->id = $id;
    }

    public function getValue(): int
    {
        return $this->id;
    }
}
