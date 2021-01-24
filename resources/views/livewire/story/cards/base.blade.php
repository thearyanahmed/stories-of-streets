<a href="{{ route('story.read',$story->slug) }}" class="rounded-lg overflow-hidden mx-3 mb-10">
    <div class="relative cursor-pointer">
        <img class="min-w-sm rounded" src={{ $story->featured_image }} />
        <div class="story-card-banner overlay absolute top-0 w-full p-4 pt-2">
            <div class="text-gray-400 text-xs">
                {{ optional($story->published_at)->format('jS M, Y') }}
                | <span class="text-white text-sm">{{ $story->user->name }}</span>
            </div>
            <div class="text-white text-3xl">{{ $story->title }}</div>
            <div class="text-white text-xs">{{ $story->summary }}</div>
        </div>
    </div>
</a>
