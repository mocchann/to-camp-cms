<?php

namespace App\UseCase\CampGrounds;

use App\Domain\Enums\CampGroundLocations;
use App\Domain\Enums\CampGroundStatus;
use GuzzleHttp\Exception\InvalidArgumentException;

class UpdateCampGroundCommand
{
    private CampGroundStatus $status;
    private CampGroundLocations $location;

    public function __construct(
        private int $id,
        private string $name,
        private string $address,
        private int $price,
        private string $image,
        string $status,
        string $location,
        private int $elevation
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->price = $price;
        $this->image = $image;
        $this->status = $this->convertStatus($status);
        $this->location = $this->convertLocation($location);
        $this->elevation = $elevation;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getStatus(): CampGroundStatus
    {
        return $this->status;
    }

    public function getLocation(): CampGroundLocations
    {
        return $this->location;
    }

    public function getElevation(): int
    {
        return $this->elevation;
    }

    private function convertStatus(string $status): CampGroundStatus | InvalidArgumentException
    {
        return match ($status) {
            'draft' => CampGroundStatus::DRAFT,
            'published' => CampGroundStatus::PUBLISHED,
            'archived' => CampGroundStatus::ARCHIVED,
            default => throw new InvalidArgumentException("Invalid status: $status"),
        };
    }

    private function convertLocation(string $location): CampGroundLocations | InvalidArgumentException
    {
        return match ($location) {
            'sea' => CampGroundLocations::SEA,
            'mountain' => CampGroundLocations::MOUNTAIN,
            'river' => CampGroundLocations::RIVER,
            'lake' => CampGroundLocations::LAKE,
            'woods' => CampGroundLocations::WOODS,
            'highland' => CampGroundLocations::HIGHLAND,
            default => throw new InvalidArgumentException("Invalid location: $location"),
        };
    }
}
