@section('seo')
    {!! SEO::generate() !!}
@endsection
<div class="w-full md:w-4/6 mx-auto flex flex-col">
    <div class="mx-auto">
        <div class="text-2xl">
            <img class="rounded mb-4" src={{ $user->avatar }} />
            {{ $user->name }}
        </div>
        <p class="text-sm text-gray-400">
            Joined {{ $user->memberSince() }}
        </p>
        <p>
            {{ $user->summary }}
        </p>
    </div>

    <div>
        @foreach($user->posts as $post)
            <ul class="divide-y divide-gray-200">
                <li class="py-12">
                    <article class="space-y-2 xl:grid xl:grid-cols-4 xl:space-y-0 xl:items-baseline">
                        <dl>
                            <dt class="sr-only">Published on</dt>
                            <dd class="text-base leading-6 font-medium text-gray-500">
                                <time datetime="2021-02-16T16:05:00.000Z">{{ $post->published_at->diffForHumans() }}</time>
                            </dd>
                        </dl>
                        <div class="space-y-5 xl:col-span-3">
                            <div class="space-y-6">
                                <h2 class="text-2xl leading-8 font-bold tracking-tight">
                                    <a class="text-gray-900" href="{{ route('story.read',$post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <div class="prose max-w-none text-gray-500">
                                    <p>{{ $post->summary }}</p>
                                </div>
                            </div>
                            <div class="text-base leading-6 font-medium">
                                <a class="text-teal-500 hover:text-teal-600" aria-label="{{ $post->title }}" href="{{ route('story.read',$post->slug) }}">Read more →</a>
                            </div>
                        </div>
                    </article>
                </li>
            </ul>
        @endforeach
    </div>
</div>


