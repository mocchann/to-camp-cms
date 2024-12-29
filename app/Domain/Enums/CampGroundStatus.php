<?php

namespace App\Domain\Enums;

enum CampGroundStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    public function status(): string
    {
        return match ($this) {
            self::DRAFT => '下書き',
            self::PUBLISHED => '公開',
            self::ARCHIVED => '非公開',
        };
    }
}
