<?php

namespace App\Domain\Models\CampGrounds;

class CampGroundId
{
    public function __construct(
        private string $id
    ) {
        $this->id = $id;
    }

    public function getValue(): string
    {
        return $this->id;
    }
}
