<div class="w-full md:w-4/6 mx-auto flex flex-col">
    <div class="text-2xl md:text-5xl text-center">
        {{ $story->title }}
    </div>
    <div class="text-center mb-4">
       <span class="text-sm text-gray-400"> {{ optional($story->published_at)->format('jS M, Y') }} | {{ $story->user->name }} </span>
    </div>
    <div class="mb-4">
        <img class="min-w-sm rounded mb-4" src={{ $story->featured_image }} />
        <figcaption class="text-center">{{ $story->featured_image_caption }}</figcaption>
    </div>

    <div class="w-full p-4 md:w-4/6 md:p-0 mx-auto">
        <div class="story-body text-xl tracking-wide">
            {!! $story->body !!}
        </div>
    </div>
</div>
