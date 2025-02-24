@extends('main')

@section('title', 'Create')

@section('data-attributes')
data-action="{{ action([App\Http\Controllers\CreateCampGroundController::class, 'create']) }}"
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
data-auth-check="{{ Auth::check() }}"
@endsection
