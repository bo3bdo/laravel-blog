<x-layouts.app title="Posts">
    <div class="space-y-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">Blog Posts</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">Discover our latest articles and insights</p>
        </div>

        <div class="flex justify-end mb-6">
            <a href="{{ route('posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-200 transition-colors text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Post
            </a>
        </div>

        @if ($posts->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-600 dark:text-gray-400">No posts yet. Be the first to create one!</p>
            </div>
        @else
            <div class="space-y-8">
                @foreach ($posts as $post)
                    <article class="group">
                        <div class="flex flex-col sm:flex-row gap-6">
                            @if ($post->featured_image)
                                <div class="flex-shrink-0 w-full sm:w-48 h-48 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800">
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @endif
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2 text-sm text-gray-500 dark:text-gray-400">
                                    <time datetime="{{ $post->published_at?->toIso8601String() }}">
                                        {{ $post->published_at?->format('F j, Y') ?? 'Draft' }}
                                    </time>
                                    <span>•</span>
                                    <span>{{ $post->author->name }}</span>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                </h2>
                                @if ($post->excerpt)
                                    <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $post->excerpt }}</p>
                                @endif
                                <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center gap-1 text-sm font-medium text-gray-900 dark:text-gray-100 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    Read more
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @if (!$loop->last)
                        <hr class="border-gray-200 dark:border-gray-800">
                    @endif
                @endforeach
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>


