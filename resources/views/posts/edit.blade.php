@extends('layouts.app')

@section('title', 'Edit ' . $post->title)

@section('content')
    <div class="w-1/2 mx-auto bg-gray-100 rounded p-6">

        <h1 class="text-3xl font-bold text-center mb-5 text-gray-900">
            Edit {{ $post->title }}
        </h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="flex flex-col mb-5">
                <label for="" class="text-lg">Title:</label>
                <input type="text" class="border-2 border-gray-600 rounded p-2" placeholder="My awesome Post" name="title"
                    value="{{ $post->title }}" required>
                @error('title')
                    <p class="text-sm text-red-500 text-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col mb-5">
                <label for="" class="text-lg">Content:</label>
                <textarea rows="6" class="border-2 border-gray-600 rounded p-2" placeholder="Write something awesome..."
                    name="content" required>{{ $post->content }}</textarea>
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
