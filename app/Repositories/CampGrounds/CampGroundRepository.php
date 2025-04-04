<?php

namespace App\Repositories\CampGrounds;

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

class CampGroundRepository implements ICampGroundRepository
{
    /**
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
            fn($camp_ground) => new CampGround(
                new CampGroundId($camp_ground->id),
                new CampGroundName($camp_ground->name),
                new CampGroundAddress($camp_ground->address),
                new CampGroundPrice($camp_ground->price),
                new CampGroundImage($camp_ground->image_url),
                new CampGroundStatus($camp_ground->statuses->first()->name),
                new CampGroundLocation($camp_ground->locations->first()->name),
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
            new CampGroundStatus($camp_ground->statuses->first()->name),
            new CampGroundLocation($camp_ground->locations->first()->name),
            new CampGroundElevation($camp_ground->elevation)
        );
    }

    public function update(CampGround $camp_ground): CampGround
    {
        return DB::transaction(function () use ($camp_ground) {
            $models_camp_ground = ModelsCampGround::updateOrCreate(
                ['id' => $camp_ground->getId()->getValue()],
                [
                    'name' => $camp_ground->getName()->getValue(),
                    'address' => $camp_ground->getAddress()->getValue(),
                    'price' => $camp_ground->getPrice()->getValue(),
                    'image_url' => $camp_ground->getImage()->getValue(),
                    'elevation' => $camp_ground->getElevation()->getValue(),
                ]
            );

            $camp_ground_status_value = $camp_ground->getStatus()->getValue()->value;
            $status_id = Status::where('name', $camp_ground_status_value)->first()->id;
            $status = $models_camp_ground->statuses->first();
            if (is_null($status)) {
                $models_camp_ground->statuses()->attach($status_id);
                $models_camp_ground->load('statuses');
            }
            if ($status && $status->name !== $camp_ground_status_value) {
                $models_camp_ground->statuses()->updateExistingPivot($status->id, ['status_id' => $status_id]);
                $models_camp_ground->load('statuses');
            }

            $camp_ground_location_value = $camp_ground->getLocation()->getValue()->value;
            $location_id = Location::where('name', $camp_ground_location_value)->first()->id;
            $location = $models_camp_ground->locations->first();
            if (is_null($location)) {
                $models_camp_ground->locations()->attach($location_id);
                $models_camp_ground->load('locations');
            }
            if ($location && $location->name !== $camp_ground_location_value) {
                $models_camp_ground->locations()->updateExistingPivot($location->id, ['location_id' => $location_id]);
                $models_camp_ground->load('locations');
            }

            return new CampGround(
                new CampGroundId($models_camp_ground->id),
                new CampGroundName($models_camp_ground->name),
                new CampGroundAddress($models_camp_ground->address),
                new CampGroundPrice($models_camp_ground->price),
                new CampGroundImage($models_camp_ground->image_url),
                new CampGroundStatus($models_camp_ground->statuses->first()->name),
                new CampGroundLocation($models_camp_ground->locations->first()->name),
                new CampGroundElevation($models_camp_ground->elevation)
            );
        });
    }

    public function delete(CampGroundId $id): void
    {
        $models_camp_ground = ModelsCampGround::findOrFail($id->getValue());

        $models_camp_ground->delete();
    }
}
