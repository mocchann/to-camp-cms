<?php

namespace App\EF\CampGrounds;

use App\Domain\Models\CampGrounds\CampGround;
use App\Domain\Models\CampGrounds\CampGroundAddress;
use App\Domain\Models\CampGrounds\CampGroundElevation;
use App\Domain\Models\CampGrounds\CampGroundId;
use App\Domain\Models\CampGrounds\CampGroundImage;
use App\Domain\Models\CampGrounds\CampGroundLocation;
use App\Domain\Models\CampGrounds\CampGroundName;
use App\Domain\Models\CampGrounds\CampGroundPrice;
use App\Domain\Models\CampGrounds\CampGroundStatus;
use App\Domain\Models\CampGrounds\GetCampGroundsFilter;
use App\Domain\Models\CampGrounds\ICampGroundRepository;
use App\Models\CampGround as ModelsCampGround;

class CampGroundRepository implements ICampGroundRepository
{
    /**
     * @param GetCampGroundsFilter $filter
     * @return CampGround[]
     */
    public function get(GetCampGroundsFilter $filter): array
    {
        $query = ModelsCampGround::query();

        if ($filter->getId()) {
            $query->where('id', $filter->getId());
        }

        if ($filter->getName()) {
            $query->where('name', 'like', "%{$filter->getName()}%");
        }

        if ($filter->getAddress()) {
            $query->where('address', 'like', "%{$filter->getAddress()}%");
        }

        if ($filter->getPrice()) {
            $query->where('price', $filter->getPrice());
        }

        if ($filter->getImage()) {
            $query->where('image_url', 'like', "%{$filter->getImage()}%");
        }

        if ($filter->getStatus()) {
            $query->whereHas('statuses', function ($query) use ($filter) {
                $query->where('name', $filter->getStatus());
            });
        }

        if ($filter->getLocation()) {
            $query->whereHas('locations', function ($query) use ($filter) {
                $query->where('name', $filter->getLocation());
            });
        }

        if ($filter->getElevation()) {
            $query->where('elevation', $filter->getElevation());
        }

        $camp_grounds = $query->with('statuses', 'locations')->get();

        return $camp_grounds->map(
            fn($camp_ground, $index) =>
            new CampGround(
                new CampGroundId($camp_ground->id),
                new CampGroundName($camp_ground->name),
                new CampGroundAddress($camp_ground->address),
                new CampGroundPrice($camp_ground->price),
                new CampGroundImage($camp_ground->image_url),
                new CampGroundStatus($camp_ground->statuses[$index]->name),
                new CampGroundLocation($camp_ground->locations[$index]->name),
                new CampGroundElevation($camp_ground->elevation)
            )
        )->toArray();
    }

    public function findById(CampGroundId $id): ?CampGround
    {
        return null;
    }

    public function update(CampGround $camp_ground): CampGround
    {
        return $camp_ground;
    }

    public function delete(CampGroundId $id): void {}
}
