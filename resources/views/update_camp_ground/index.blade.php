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
        'image' => asset('storage/' . $camp_ground->getImage()->getValue()),
        'status' => $camp_ground->getStatus()->getValue(),
        'location' => $camp_ground->getLocation()->getValue(),
        'elevation' => $camp_ground->getElevation()->getValue(),
    ]
  )
}}"
data-csrf-token="{{ csrf_token() }}"
data-errors="{{ json_encode($errors->messages()) }}"
data-auth-check="{{ Auth::check() }}"
data-user-name="{{ Auth::check() ? Auth::user()->name : '' }}"
@endsection
