<?php

namespace App\Domain\Models\CampGrounds;

/**
 * キャンプ場施設利用料を表すクラス
 */
class CampGroundPrice
{
    public function __construct(
        private int $price
    ) {
        $this->price = $price;
    }

    public function getValue(): int
    {
        return $this->price;
    }
}
