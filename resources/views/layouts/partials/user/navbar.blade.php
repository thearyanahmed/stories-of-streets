<!-- This example requires Tailwind CSS v2.0+ -->
<nav x-data="{
            showDropdown: false,
            showMenuItems: false,
            showAuthDropdown: false,
        }"
     class="bg-white">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <!-- <button @click="showMenuItems = ! showMenuItems" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-black hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button> -->
                <img class="block lg:hidden h-8 w-auto" src="{{ asset('img/logo/stories_of_streets_1500_500.png') }}" alt="{{ config('app.name') }}">
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <!-- <a href="{{ route('welcome') }}" class="flex-shrink-0 flex items-center">
                    <img class="block lg:hidden h-8 w-auto" src="{{ asset('img/logo/stories_of_streets_1500_500.png') }}" alt="{{ config('app.name') }}">
                    <img class="hidden lg:block h-8 w-auto" src="{{ asset('img/logo/stories_of_streets_1500_500.png') }}" alt="{{ config('app.name') }}">
                </a> -->
                <div class="hidden md:block sm:ml-20 md:w-full md:flex md:justify-center">
                    <div class="flex space-x-4">
                        @include('layouts.partials.user.navbar-menu-items')
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <!-- @if(auth()->check())
                    <a href="#" class="bg-white p-1 rounded-full text-gray-400 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </a>
                @endif -->

                <!-- Profile dropdown -->
                <div class="ml-3 relative">
                    @if(auth()->check())
                        <div>
                            <button @click="showDropdown = true" class="bg-white flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-haspopup="true">
                                <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                            </button>
                        </div>
                        <div @click.away="showDropdown = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             :class="{ 'hidden' : showDropdown === false }"
                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>
                            <a href="{{ route('canvas.logout') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                        </div>
                    @else
                        <!-- <a @click="showAuthDropdown = true" href="#" class="md:hidden bg-white p-1 rounded-full text-gray-400 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" aria-haspopup="true">
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </a> -->

                        <!-- <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                            <div class="hidden sm:block sm:ml-6">
                                <div class="flex space-x-4">
                                    <a href="{{ route('login') }}" class="text-black hover:bg-gray-200 hover:text-black px-3 py-2 rounded-md text-sm font-medium">Login</a>
                                    <a href="{{ route('register') }}" class="text-black hover:bg-gray-200 hover:text-black px-3 py-2 rounded-md text-sm font-medium">Register</a>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div x-show="showAuthDropdown" @click.away="showAuthDropdown = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Login</a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Register</a>
                        </div> -->
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="sm:block md:hidden" x-show="showMenuItems">
        <div class="px-2 pt-2 pb-3 space-y-1 flex flex-col">
            @include('layouts.partials.user.navbar-menu-items')
        </div>
    </div>
</nav>
