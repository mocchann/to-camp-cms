@extends('main')

@section('title', 'Register')

@section('data-attributes')
data-action="{{ action([App\Http\Controllers\RegisterUserController::class, 'store']) }}"
data-csrf-token="{{ csrf_token() }}"
data-session-errors="{{ json_encode(session('error')) }}"
@endsection
