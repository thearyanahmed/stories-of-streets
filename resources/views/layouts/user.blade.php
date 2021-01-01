<x-layouts.base>
    <div >
        @include('layouts.partials.user.navbar')

        <div>
            {{ $slot }}
        </div>

        <x-notification />
    </div>
</x-layouts.base>
