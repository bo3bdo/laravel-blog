<x-layouts.app :title="$post->title" :description="$post->excerpt">
    <article class="prose prose-lg dark:prose-invert max-w-none">
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4 text-sm text-gray-500 dark:text-gray-400">
                <time datetime="{{ $post->published_at?->toIso8601String() }}">
                    {{ $post->published_at?->format('F j, Y') ?? 'Draft' }}
                </time>
                <span>•</span>
                <span>{{ $post->author->name }}</span>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $post->title }}</h1>
            @if ($post->excerpt)
                <p class="text-xl text-gray-600 dark:text-gray-400 leading-relaxed">{{ $post->excerpt }}</p>
            @endif
        </div>

        @if ($post->featured_image)
            <div class="mb-8 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800">
                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-auto">
            </div>
        @endif

        <div class="prose prose-lg dark:prose-invert max-w-none">
            <div class="text-gray-700 dark:text-gray-300 leading-relaxed">
                {!! $post->formatted_content !!}
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-800">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Back to Posts
                    </a>
                </div>
                @can('update', $post)
                    <div class="flex items-center gap-4">
                        <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/30 transition-colors text-sm font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                @endcan
            </div>
        </div>
    </article>
</x-layouts.app>


