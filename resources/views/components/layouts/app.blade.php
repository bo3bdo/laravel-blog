<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ $description ?? $siteDescription }}">

        <title>{{ $title ?? 'Blog' }} - {{ $siteName }}</title>

        <script>
            // Prevent flash of unstyled content (FOUC) for dark mode
            (function() {
                const getTheme = () => {
                    const stored = localStorage.getItem('theme');
                    if (stored) return stored;
                    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                };
                const theme = getTheme();
                document.documentElement.classList.add(theme);
            })();
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

    </head>
    <body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased transition-colors duration-200">
        <header class="sticky top-0 z-50 w-full border-b border-gray-200 dark:border-gray-800 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm transition-colors duration-200">
            <nav class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-8">
                        <a href="{{ route('posts.index') }}" 
                            class="text-xl font-bold text-gray-900 dark:text-gray-100 hover:text-gray-600 dark:hover:text-gray-300 transition-all duration-200 hover:scale-105">
                            {{ $siteName }}
                        </a>
                        <div class="hidden md:flex items-center gap-6">
                            <a href="{{ route('posts.index') }}" 
                                class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-all duration-200 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-gray-900 dark:after:bg-gray-100 after:transition-all after:duration-200 hover:after:w-full">
                                Posts
                            </a>
                            @auth
                                <a href="{{ route('posts.create') }}" 
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-all duration-200 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-gray-900 dark:after:bg-gray-100 after:transition-all after:duration-200 hover:after:w-full">
                                    New Post
                                </a>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('settings.index') }}" 
                                        class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-all duration-200 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-gray-900 dark:after:bg-gray-100 after:transition-all after:duration-200 hover:after:w-full">
                                        Settings
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <button id="theme-toggle" onclick="toggleTheme()" 
                            class="p-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                            aria-label="Toggle dark mode">
                            <svg class="w-5 h-5 sun-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <svg class="w-5 h-5 moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                        </button>
                        @auth
                            <span class="text-sm text-gray-600 dark:text-gray-400 px-3 py-1 rounded-lg bg-gray-100 dark:bg-gray-800">{{ auth()->user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" 
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-all duration-200 px-3 py-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" 
                                class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-all duration-200 px-3 py-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                                Login
                            </a>
                            <a href="{{ route('register') }}" 
                                class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-all duration-200 px-3 py-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>

        <main class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-8">
            @if (session('success'))
                <div data-flash-message data-flash-type="success" class="mb-6 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4">
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div data-flash-message data-flash-type="error" class="mb-6 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-4">
                    <ul class="list-disc list-inside text-sm text-red-800 dark:text-red-200">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="animate-fade-in">
                {{ $slot }}
            </div>
        </main>

        <footer class="mt-16 border-t border-gray-200 dark:border-gray-800">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col items-center justify-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                    <p>&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
                    <p class="text-xs">{{ $footerText }}</p>
                </div>
            </div>
        </footer>

        @livewireScripts
    </body>
</html>

