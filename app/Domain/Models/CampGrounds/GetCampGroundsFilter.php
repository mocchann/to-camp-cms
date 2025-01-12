<?php

namespace App\Domain\Models\CampGrounds;

use App\Domain\Enums\CampGroundLocations;
use App\Domain\Enums\CampGroundStatus;

/**
 * 検索条件を表現するオブジェクト
 */
class GetCampGroundsFilter
{
    public function __construct(
        private int | null $id = null,
        private string | null $name = null,
        private string | null $address = null,
        private int | null $price = null,
        private string | null $image = null,
        private string | null $status = null,
        private string | null $location = null,
        private int | null $elevation = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->price = $price;
        $this->image = $image;
        $this->status = $status;
        $this->location = $location;
        $this->elevation = $elevation;
    }

    public function getId(): int | null
    {
        return $this->id;
    }

    public function getName(): string | null
    {
        return $this->name;
    }

    public function getAddress(): string | null
    {
        return $this->address;
    }

    public function getPrice(): int | null
    {
        return $this->price;
    }

    public function getImage(): string | null
    {
        return $this->image;
    }

    public function getStatus(): string | null
    {
        return $this->status;
    }

    public function getLocation(): string | null
    {
        return $this->location;
    }

    public function getElevation(): int | null
    {
        return $this->elevation;
    }
}
