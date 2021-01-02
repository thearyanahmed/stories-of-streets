<x-layouts.base>
    <div class="min-h-screen bg-white flex flex-col justify-center pt-6 sm:px-6 lg:px-8">

        @include('layouts.partials.user.navbar')

        <div class="w-full h-screen items-center" style="background-image: url('{{ asset('img/background/dreamer.svg') }}');background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover; /">
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md md:mx-20 md:my-64">
                <div class=" py-8 px-4 sm:rounded-lg sm:px-10" style="background-image: linear-gradient(to left bottom, #07bfa6, #16ad9e, #249b94, #308988, #38787a);">
                    {{ $slot }}
                </div>
            </div>
        </div>
{{--        {{ $slot }}--}}
    </div>
</x-layouts.base>
