@extends('main')

@section('title', 'Update')

@section('data-attributes')
data-action="{{ action([App\Http\Controllers\UpdateCampGroundController::class, 'update'], ['id' => $camp_ground->getId()->getValue()]) }}"
data-camp-ground="{{ json_encode(
    [
        'id'=> $camp_ground->getId()->getValue(),
        'name' => $camp_ground->getName()->getValue(),
        'address' => $camp_ground->getAddress()->getValue(),
        'price' => $camp_ground->getPrice()->getValue(),
        'image' => asset($camp_ground->getImage()->getValue()),
        'status' => $camp_ground->getStatus()->getValue()->label(),
        'location' => $camp_ground->getLocation()->getValue()->label(),
        'elevation' => $camp_ground->getElevation()->getValue(),
    ]
  )
}}"
data-csrf-token="{{ csrf_token() }}"
data-errors="{{ $errors->any() ? json_encode([
    'name' => $errors->get('name') ?? null,
    'address' => $errors->get('address') ?? null,
    'price' => $errors->get('price') ?? null,
    'image' => $errors->get('image') ?? null,
    'status' => $errors->get('status') ?? null,
    'location' => $errors->get('location') ?? null,
    'elevation' => $errors->get('elevation') ?? null,
  ]) : '' }}"
@endsection
