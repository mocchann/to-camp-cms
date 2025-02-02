@extends('main')

@section('title', 'Create')

@section('data-attributes')
data-action="{{ action([App\Http\Controllers\CreateCampGroundController::class, 'create']) }}"
data-csrf-token="{{ csrf_token() }}"
@endsection
