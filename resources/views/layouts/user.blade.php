<x-layouts.base>
    <div >
        @include('layouts.partials.user.navbar')

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <main class="flex-1 relative z-0 overflow-y-auto pt-2 pb-6 focus:outline-none md:py-6" tabindex="0" x-init="$el.focus()">
                <div class="max-w-full mx-auto px-4 sm:px-6 md:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <x-notification />
    </div>
</x-layouts.base>
