@extends('layouts.app')

@section('title', 'Api Token')

@section('content')
    <div class="w-1/2 mx-auto bg-gray-100 rounded p-6">

        <h1 class="text-3xl font-bold text-center mb-5 text-gray-900">
            Api Token
        </h1>

        @forelse (auth()->user()->tokens as $token)
            <input type="text" class="border-2 border-gray-600 rounded p-2 w-full" value="{{ $token->token }}" readonly>
        @empty
            <form method="POST" action="{{ route('api-token.store') }}">
                @csrf
                <button type="submit"
                    class="bg-gray-900 rounded p-3 text-xl font-semibold text-white cursor-pointer w-full">Create
                    Token</button>
            </form>
        @endforelse
    </div>
@endsection
