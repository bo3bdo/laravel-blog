<x-layouts.app title="Settings">
    <div class="max-w-3xl mx-auto animate-fade-in">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">Site Settings</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage your site configuration</p>
        </div>

        <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 space-y-6">
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Site Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings['site_name']) }}" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent transition-all duration-200">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">This will appear in the header and page titles</p>
                    @error('site_name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400 animate-fade-in">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="site_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Site Description
                    </label>
                    <textarea name="site_description" id="site_description" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent transition-all duration-200 resize-none">{{ old('site_description', $settings['site_description']) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Meta description for SEO (optional)</p>
                    @error('site_description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400 animate-fade-in">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="home_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Home Page Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="home_title" id="home_title" value="{{ old('home_title', $settings['home_title']) }}" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent transition-all duration-200">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Main heading on the home page</p>
                    @error('home_title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400 animate-fade-in">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="home_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Home Page Description
                    </label>
                    <textarea name="home_description" id="home_description" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent transition-all duration-200 resize-none">{{ old('home_description', $settings['home_description']) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Subtitle or description below the home page title</p>
                    @error('home_description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400 animate-fade-in">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="footer_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Footer Text
                    </label>
                    <input type="text" name="footer_text" id="footer_text" value="{{ old('footer_text', $settings['footer_text']) }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent transition-all duration-200">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Text displayed in the footer (optional)</p>
                    @error('footer_text')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400 animate-fade-in">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" 
                    class="px-6 py-2 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-200 transition-all duration-200 font-medium hover:shadow-lg">
                    Save Settings
                </button>
                <a href="{{ route('posts.index') }}" 
                    class="px-6 py-2 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-200 font-medium hover:shadow-md">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
