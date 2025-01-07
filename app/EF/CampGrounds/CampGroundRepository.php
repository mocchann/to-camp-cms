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
use App\Models\Location;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CampGroundRepository implements ICampGroundRepository
{
    /**
     * @param GetCampGroundsFilter $filter
     * @return array<CampGround>
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
        $camp_ground = ModelsCampGround::with('statuses', 'locations')->find($id->getValue());

        if (is_null($camp_ground)) {
            return null;
        }

        return new CampGround(
            new CampGroundId($camp_ground->id),
            new CampGroundName($camp_ground->name),
            new CampGroundAddress($camp_ground->address),
            new CampGroundPrice($camp_ground->price),
            new CampGroundImage($camp_ground->image_url),
            new CampGroundStatus($camp_ground->statuses[0]->name),
            new CampGroundLocation($camp_ground->locations[0]->name),
            new CampGroundElevation($camp_ground->elevation)
        );
    }

    public function update(CampGround $camp_ground): CampGround
    {
        return DB::transaction(function () use ($camp_ground) {
            $models_camp_ground = ModelsCampGround::with('statuses', 'locations')
                ->find($camp_ground->getId()->getValue());

            if (is_null($models_camp_ground)) {
                throw new RuntimeException('CampGround not found.');
            }

            $status = $models_camp_ground->statuses->first();

            if (!$status) {
                throw new RuntimeException('Status not found.');
            }

            $camp_ground_status_value = $camp_ground->getStatus()->getValue()->value;

            if ($status->name !== $camp_ground_status_value) {
                $status_id = Status::where('name', $camp_ground_status_value)->first()->id;
                $models_camp_ground->statuses()->attach($status_id);
            }

            $location = $models_camp_ground->locations->first();

            if (!$location) {
                throw new RuntimeException('Location not found.');
            }

            $camp_ground_location_value = $camp_ground->getLocation()->getValue()->value;

            if ($location->name !== $camp_ground_location_value) {
                $location_id = Location::where('name', $camp_ground_location_value)->first()->id;
                $models_camp_ground->locations()->attach($location_id);
            }

            $models_camp_ground->update([
                'name' => $camp_ground->getName()->getValue(),
                'address' => $camp_ground->getAddress()->getValue(),
                'price' => $camp_ground->getPrice()->getValue(),
                'image_url' => $camp_ground->getImage()->getValue(),
                'elevation' => $camp_ground->getElevation()->getValue(),
            ]);

            return new CampGround(
                new CampGroundId($models_camp_ground->id),
                new CampGroundName($models_camp_ground->name),
                new CampGroundAddress($models_camp_ground->address),
                new CampGroundPrice($models_camp_ground->price),
                new CampGroundImage($models_camp_ground->image_url),
                new CampGroundStatus($models_camp_ground->statuses[0]->name),
                new CampGroundLocation($models_camp_ground->locations[0]->name),
                new CampGroundElevation($models_camp_ground->elevation)
            );
        });
    }

    public function delete(CampGroundId $id): void {}
}
