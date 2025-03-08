@extends('main')

@section('title', 'Login')

@section('data-attributes')
data-action="{{ action([App\Http\Controllers\LoginUserController::class, 'store']) }}"
data-csrf-token="{{ csrf_token() }}"
data-auth-check="{{ Auth::check() }}"
data-session-message="{{ json_encode(session('error') ?? '') }}"
@endsection
