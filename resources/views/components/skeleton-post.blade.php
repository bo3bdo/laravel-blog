@props(['count' => 3])

@for ($i = 0; $i < $count; $i++)
    <div class="animate-pulse space-y-4">
        <div class="flex flex-col sm:flex-row gap-6 p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50">
            <div class="flex-shrink-0 w-full sm:w-48 h-48 skeleton rounded-lg"></div>
            <div class="flex-1 space-y-3">
                <div class="h-4 skeleton w-1/3"></div>
                <div class="h-6 skeleton w-2/3"></div>
                <div class="h-4 skeleton w-full"></div>
                <div class="h-4 skeleton w-5/6"></div>
                <div class="h-4 skeleton w-1/4"></div>
            </div>
        </div>
        @if ($i < $count - 1)
            <hr class="border-gray-200 dark:border-gray-800">
        @endif
    </div>
@endfor

