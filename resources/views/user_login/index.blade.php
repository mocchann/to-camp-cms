@extends('main')

@section('title', 'Login')

@section('data-attributes')
data-action="{{ action([App\Http\Controllers\LoginUserController::class, 'store']) }}"
data-csrf-token="{{ csrf_token() }}"
@endsection
