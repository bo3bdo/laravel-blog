<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ $description ?? 'A clean and simple blog' }}">

        <title>{{ $title ?? 'Blog' }} - {{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased">
        <header class="sticky top-0 z-50 w-full border-b border-gray-200 dark:border-gray-800 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm">
            <nav class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-8">
                        <a href="{{ route('posts.index') }}" class="text-xl font-bold text-gray-900 dark:text-gray-100 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            {{ config('app.name', 'Blog') }}
                        </a>
                        <div class="hidden md:flex items-center gap-6">
                            <a href="{{ route('posts.index') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
                                Posts
                            </a>
                            <a href="{{ route('posts.create') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
                                New Post
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-8">
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4">
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-4">
                    <ul class="list-disc list-inside text-sm text-red-800 dark:text-red-200">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </main>

        <footer class="mt-16 border-t border-gray-200 dark:border-gray-800">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col items-center justify-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Blog') }}. All rights reserved.</p>
                    <p class="text-xs">Powered by Laravel & Tailwind CSS</p>
                </div>
            </div>
        </footer>

        @livewireScripts
    </body>
</html>

