<x-layouts.base>
    <div class="min-h-screen bg-white flex flex-col justify-center sm:px-6 lg:px-8">

        @include('layouts.partials.user.navbar')

        <div class="w-full h-screen items-center sm:bg-none md:bg-auth" style="background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 1000px 1000px; /">
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md md:mx-20 md:my-64">
                <div class=" py-8 px-4 sm:rounded-lg sm:px-10 sm:bg-none md:bg-auth-form">
                    {{ $slot }}
                </div>
            </div>
        </div>
{{--        {{ $slot }}--}}
    </div>
</x-layouts.base>
