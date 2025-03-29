@extends('main')

@section('title', 'Create')

@section('data-attributes')
data-action="{{ action([App\Http\Controllers\CreateCampGroundController::class, 'create']) }}"
data-csrf-token="{{ csrf_token() }}"
data-errors="{{ json_encode($errors->messages()) }}"
data-auth-check="{{ Auth::check() }}"
data-user-name="{{ Auth::check() ? Auth::user()->name : '' }}"
@endsection
