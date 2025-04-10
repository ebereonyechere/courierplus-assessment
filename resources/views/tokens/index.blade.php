@extends('layouts.app')

@section('title', 'Api Token')

@section('content')
    <div class="w-1/2 mx-auto bg-gray-100 rounded p-6">

        <h1 class="text-3xl font-bold text-center mb-5 text-gray-900">
            Api Token
        </h1>

        @if ($token)
            <h3 class="mb-1 font-semibold">Please copy & stoe your API TOKEN in a save place as it won't be displayed to you
                again.</h3>
            <input type="text" class="border-2 border-gray-600 rounded p-2 w-full mb-4" value="{{ $token }}"
                readonly>
        @else
            <h3>Token: ******</h3>
            @if (count(auth()->user()->tokens))
                <p class="mb-3 mt-1">Click the button to regenerate your token</p>
            @else
                <p class="mb-3 mt-1">Click the button to generate your token</p>
            @endif
        @endif

        <form method="POST" action="{{ route('api-token.store') }}">
            @csrf
            <button type="submit" class="bg-gray-900 rounded p-3 text-xl font-semibold text-white cursor-pointer w-full">
                @if (count(auth()->user()->tokens))
                    Regenerate
                @else
                    Create
                @endif
                Token
            </button>
        </form>


    </div>
@endsection
