<?php

namespace App\Domain\Models\CampGrounds;

class CampGroundName
{
    public function __construct(
        private string $name
    ) {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}