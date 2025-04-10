@extends('layouts.app')

@section('title', 'Create post')

@section('content')
    <div class="w-1/2 mx-auto bg-gray-100 rounded p-6">

        <h1 class="text-3xl font-bold text-center mb-5 text-gray-900">
            Create a New Post
        </h1>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="flex flex-col mb-5">
                <label for="" class="text-lg">Title:</label>
                <input type="text" class="border-2 border-gray-600 rounded p-2" placeholder="My awesome Post" name="title"
                    value="{{ old('title') }}" required>
                @error('title')
                    <p class="text-sm text-red-500 text-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col mb-5">
                <label for="" class="text-lg">Content:</label>
                <textarea rows="6" class="border-2 border-gray-600 rounded p-2" placeholder="Write something awesome..."
                    name="content" required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-sm text-red-500 text-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <button type="submit"
                    class="bg-gray-900 rounded p-3 text-xl font-semibold text-white cursor-pointer w-full">Save
                    Post</button>
            </div>
        </form>
    </div>
@endsection
