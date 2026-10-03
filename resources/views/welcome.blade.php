<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Daycare</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <span class="text-xl font-bold text-amber-600">🐾 Furtopia</span>
            <div class="space-x-4">
                @auth
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-amber-600">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-amber-600">Log in</a>
                <a href="{{ route('register') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6">
        <section class="min-h-[70vh] flex flex-col items-center justify-center text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                A safe, fun day out for your pet 🐾
            </h1>
            <p class="text-gray-600 text-lg max-w-xl mb-8">
                Book trusted daycare, boarding, grooming, and more - all in one place.
            </p>
            <div class="space-x-4">
                <a href="{{ route('register') }}"
                    class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg shadow">
                    Get Started
                </a>
                <a href="{{ route('login') }}"
                    class="inline-block text-gray-700 hover:text-amber-600 font-semibold px-6 py-3">
                    Log in
                </a>
            </div>
        </section>
    </main>

</body>

</html>