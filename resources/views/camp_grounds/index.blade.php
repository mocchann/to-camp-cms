@extends('main')

@section('title', 'Top')

@section('data-attributes')
data-camp-grounds="{{ json_encode(
    array_map(
        fn($camp_ground) => [
            'id'=> $camp_ground->id,
            'name' => $camp_ground->name,
            'address' => $camp_ground->address,
            'price' => $camp_ground->price,
            'image' => $camp_ground->image,
            'status' => $camp_ground->status,
            'location' => $camp_ground->location,
            'elevation' => $camp_ground->elevation,
        ],
        $camp_grounds
    ),
) }}"
@endsection
