@props([
    'leadingAddOn' => false,
])
<div class="flex {{ $attributes['fullsizeinput'] ? 'w-full' :'' }} rounded-md shadow-sm">
    @if ($leadingAddOn)
        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm lg:text-md">
            {{ $leadingAddOn }}
        </span>
    @endif

    <input type="password" {{ $attributes->merge(['class' => 'rounded-md flex-1 form-input border-cool-gray-300 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5' . ($leadingAddOn ? ' rounded-none rounded-r-md' : '')]) }}/>
</div>
