<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">Create New Post</h1>
        <p class="text-gray-600 dark:text-gray-400">Share your thoughts with the world</p>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Title <span class="text-red-500">*</span>
            </label>
            <input type="text" wire:model="title" id="title" required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent">
            @error('title')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Excerpt
            </label>
            <textarea wire:model="excerpt" id="excerpt" rows="3"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent"></textarea>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">A short summary of your post (optional)</p>
            @error('excerpt')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Content <span class="text-red-500">*</span>
            </label>
            <textarea wire:model="content" id="content" rows="15" required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent font-mono text-sm"></textarea>
            @error('content')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="featured_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Featured Image URL
            </label>
            <input type="url" wire:model="featured_image" id="featured_image"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent">
            @error('featured_image')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center">
                <input type="checkbox" wire:model="is_published" id="is_published"
                    class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 dark:focus:ring-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="is_published" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Publish immediately
                </label>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                class="px-6 py-2 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-200 transition-colors font-medium"
                wire:loading.attr="disabled"
                wire:target="save">
                <span wire:loading.remove wire:target="save">Create Post</span>
                <span wire:loading wire:target="save" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Creating...
                </span>
            </button>
            <a href="{{ route('posts.index') }}" 
                class="px-6 py-2 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors font-medium">
                Cancel
            </a>
        </div>
    </form>
</div>
