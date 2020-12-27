<x-layouts.base>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center pt-6 sm:px-6 lg:px-8">
        <div class="mx-auto">
            <img src="{{ asset('img/logo/base_logo_bg_transparent.svg') }}" style="width: 200px;" alt="farmland">
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layouts.base>
