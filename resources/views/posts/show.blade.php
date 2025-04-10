@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="w-1/2 mx-auto bg-gray-100 rounded p-6">

        <h1 class="text-3xl font-bold text-center mb-3 text-gray-900">
            {{ $post->title }}
        </h1>

        <div class="flex space-x-2 justify-center mb-5">
            <a href="{{ route('posts.edit', $post->id) }}" class="text-orange-500 hover:underline ml-1">Edit Post</a>|
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                onsubmit="return confirm('Do you really want to delete the post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 cursor-pointer hover:underline ml-1">Delete Post</button>
            </form>

        </div>

        {{ $post->content }}
    </div>
@endsection
