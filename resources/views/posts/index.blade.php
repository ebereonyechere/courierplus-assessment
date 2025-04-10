@extends('layouts.app')

@section('title', 'All posts')

@section('content')
    <div class="w-1/2 mx-auto bg-gray-100 rounded p-6">

        <h1 class="text-3xl font-bold text-center mb-5 text-gray-900">
            All Posts
        </h1>


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-white uppercase bg-gray-900">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        @if (auth()->user()->isAdmin())
                            <th scope="col" class="px-6 py-3">
                                Tenant
                            </th>
                        @endif
                        <th scope="col" class="px-6 py-3">
                            Date Posted
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $post->title }}
                            </th>
                            @if (auth()->user()->isAdmin())
                                <td class="px-6 py-4">
                                    {{ $post->user->name }}
                                </td>
                            @endif
                            <td class="px-6 py-4">
                                {{ $post->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('posts.show', $post->id) }}"
                                        class="text-blue-500 hover:underline">View</a>|
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                        class="text-orange-500 hover:underline ml-1">Edit</a>|
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                        onsubmit="return confirm('Do you really want to delete the post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 cursor-pointer hover:underline ml-1">Delete</button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
