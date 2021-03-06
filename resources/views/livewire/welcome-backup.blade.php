<div class="w-full md:w-2/6 mx-auto flex flex-col" id="masonry">
    @foreach($stories as $story)
        @livewire('story.cards.base', ['story' => $story])
    @endforeach
</div>
