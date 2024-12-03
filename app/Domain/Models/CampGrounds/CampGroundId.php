<?php

namespace App\Domain\Models\CampGrounds;

class CampGroundId
{
    public function __construct(
        private string $id
    ) {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
