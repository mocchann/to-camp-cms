<?php

namespace App\Domain\Models\CampGrounds;

class CampGroundImage
{
    public function __construct(
        private string $image
    ) {
        $this->image = $image;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
