@extends('main')

@section('title', 'Top')

@section('data-attributes')
data-camp-grounds="{{ json_encode(
    array_map(
        fn($camp_ground) => [
            'id'=> $camp_ground->getId()->getValue(),
            'name' => $camp_ground->getName()->getValue(),
            'address' => $camp_ground->getAddress()->getValue(),
            'price' => $camp_ground->getPrice()->getValue(),
            'image' => $camp_ground->getImage()->getValue(),
            'status' => $camp_ground->getStatus()->getValue()->label(),
            'location' => $camp_ground->getLocation()->getValue()->label(),
            'elevation' => $camp_ground->getElevation()->getValue(),
        ],
        $camp_grounds
    ),
) }}"
data-csrf-token="{{ csrf_token() }}"
@endsection
