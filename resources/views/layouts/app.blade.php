<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-50">
    <header class="bg-gray-900 p-6 flex justify-between items-center text-white">
        <h1 class="text-xl font-semibold tracking-wide">{{ auth()->user()->name }}
            @if (auth()->user()->isAdmin())
                <span class="bg-green-700 text-white font-semibold rounded p-2">Admin</span>
            @else
                <span class="bg-orange-700 text-white font-semibold rounded p-2">Tenant</span>
            @endif
        </h1>
        <nav class="">
            <a href="{{ route('posts.index') }}" class="hover:underline mr-4">All Posts</a>

            @if (auth()->user()->isAdmin())
                <a href="{{ route('users.index') }}" class="hover:underline mr-4">All Tenants</a>
            @else
                <a href="{{ route('posts.create') }}" class="hover:underline mr-4">New Post</a>
                <a href="{{ route('api-token.index') }}" class="hover:underline mr-4">Api Token</a>
            @endif
            <form action="{{ route('sessions.destroy') }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="cursor-pointer hover:underline">Logout</button>
            </form>

        </nav>
    </header>

    <div class="container mx-auto mt-12">
        @yield('content')
    </div>
</body>

</html>
