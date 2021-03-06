@section('seo')
    {!! SEO::generate() !!}
@endsection

<div class="w-full md:w-4/6 mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        @foreach($stories as $story)
            @livewire('story.cards.base', ['story' => $story])
        @endforeach
    </div>
</div>
