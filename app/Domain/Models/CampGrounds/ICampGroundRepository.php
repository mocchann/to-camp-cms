<?php

namespace App\Domain\Models\CampGrounds;

interface ICampGroundRepository
{
    public function findAll(): array;
}
