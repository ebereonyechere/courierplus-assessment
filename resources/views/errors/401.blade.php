@extends('layouts.errors')

@section('title', '401 error')

@section('content')
    <h1 class="text-3xl font-bold text-center mb-5 text-gray-900">
        Unauthorized Access
    </h1>

    <p class="text-lg text-center">You are not authorized to perfrom this action!</p>
@endsection
