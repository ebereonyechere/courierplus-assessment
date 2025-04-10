@extends('layouts.auth')

@section('title', 'Pending Account')

@section('content')
    <h1 class="text-3xl font-bold text-center mb-5 text-gray-900">
        Pending Approval
    </h1>

    <p class="text-lg text-center">Hello, your account is pending approval by the admins and will become active once
        approved. Thanks!</p>
    <form method="POST" action="{{ route('sessions.destroy') }}" class="flex justify-center mt-5">
        @csrf()
        @method('DELETE')
        <button class="text-center hover:underline mt-1 flex justify-center text-red-800 cursor-pointer">Logout</button>
    </form>
@endsection
