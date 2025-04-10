<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-50">
    <header class="bg-gray-900 p-6 flex justify-between text-white">
        <h1 class="text-3xl font-semibold tracking-wide">Blog App</h1>
        <nav>
            <a href="{{ route('posts.index') }}">Posts</a>
        </nav>
    </header>

    <div class="container mx-auto mt-12">
        @yield('content')
    </div>
</body>

</html>
