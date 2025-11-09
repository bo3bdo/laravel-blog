<x-layouts.app title="Edit Post">
    <div class="max-w-3xl mx-auto animate-fade-in">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">Edit Post</h1>
            <p class="text-gray-600 dark:text-gray-400">Update your post</p>
        </div>

        <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Title <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent">
                @error('title')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Excerpt
                </label>
                <textarea name="excerpt" id="excerpt" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent">{{ old('excerpt', $post->excerpt) }}</textarea>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">A short summary of your post (optional)</p>
                @error('excerpt')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Content <span class="text-red-500">*</span>
                </label>
                <textarea name="content" id="content" rows="15" required
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent font-mono text-sm">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Featured Image URL
                </label>
                <input type="url" name="featured_image" id="featured_image" value="{{ old('featured_image', $post->featured_image) }}"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent">
                @error('featured_image')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                        class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 dark:focus:ring-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="is_published" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Publish immediately
                    </label>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" 
                    class="px-6 py-2 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-200 transition-all duration-200 font-medium hover:shadow-lg">
                    Update Post
                </button>
                <a href="{{ route('posts.show', $post) }}" 
                    class="px-6 py-2 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-200 font-medium hover:shadow-md">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>


