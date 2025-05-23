@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <h1 class="text-3xl font-bold text-center mb-5 text-gray-900">
        Register for an Account
    </h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="flex flex-col mb-5">
            <label for="" class="text-lg">Name:</label>
            <input type="text" class="border-2 border-gray-600 rounded p-2" placeholder="John Doe" name="name"
                value="{{ old('name') }}" required>
            @error('name')
                <p class="text-sm text-red-500 text-semibold">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col mb-5">
            <label for="" class="text-lg">Email:</label>
            <input type="email" class="border-2 border-gray-600 rounded p-2" placeholder="john@example.com" name="email"
                value="{{ old('email') }}" required>
            @error('email')
                <p class="text-sm text-red-500 text-semibold">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col mb-5">
            <label for="" class="text-lg">Password:</label>
            <input type="password" class="border-2 border-gray-600 rounded p-2" placeholder="******" name="password"
                minlength="6" required>
            @error('password')
                <p class="text-sm text-red-500 text-semibold">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col mb-5">
            <label for="" class="text-lg">Confirm Password:</label>
            <input type="password" class="border-2 border-gray-600 rounded p-2" placeholder="******"
                name="password_confirmation" minlength="6" required>
        </div>
        <div class="mb-5">
            <button type="submit"
                class="bg-gray-900 rounded p-3 text-xl font-semibold text-white cursor-pointer w-full">Register</button>
            <a href="{{ route('login') }}" class="text-center hover:underline mt-1 flex justify-center">Existing user?
                login to your account
                here</a>
        </div>
    </form>
@endsection
