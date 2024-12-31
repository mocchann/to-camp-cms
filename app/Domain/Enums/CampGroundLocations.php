<?php

namespace App\Domain\Enums;

enum CampGroundLocations: string
{
    case SEA = 'sea';
    case MOUNTAIN = 'mountain';
    case RIVER = 'river';
    case LAKE = 'lake';
    case WOODS = 'woods';
    case HIGHLAND = 'highland';

    public function location(): string
    {
        return match ($this) {
            self::SEA => '海',
            self::MOUNTAIN => '山',
            self::RIVER => '川',
            self::LAKE => '湖',
            self::WOODS => '林間',
            self::HIGHLAND => '高原',
        };
    }
}
