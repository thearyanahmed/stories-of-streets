<div>
    <form wire:submit.prevent="login" action="#" method="POST">
        <div>
            <label for="email" class="block text-sm font-medium leading-5 text-white">
                Email address
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input wire:model="email" placeholder="email@example.com" id="email" type="email" required autofocus class="@error('email') border-red-500 @enderror appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
            </div>
            @error('email') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>
        <div class="mt-2">
            <label for="password" class="block text-sm font-medium leading-5 text-white">
                Password
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input wire:model.lazy="password" placeholder="******" id="password" type="password" required class="@error('password') border-red-500 @enderror appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
            </div>
            @error('password') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mt-2">
            <div class="sm:flex md:flex justify-between">
                <a class="sm:w-full md:w-1/2 rounded-md shadow-sm py-2 px-4 flex justify-center text-center bg-white cursor-pointer sm:border-2 sm:border-gray-200 sm:border-opacity-75 md:border-0">
                    <img class="h-6 bg-white rounded-sm" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="{{ config('app.name') }} - Signin with google">
                    <span class="ml-1 text-gray-800 text-sm">Join with google</span>
                </a>
                <span class="sm:w-full md:w-1/2 rounded-md shadow-sm ml-1">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-300 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition duration-150 ease-in-out">
                        Log In
                    </button>
                </span>
            </div>
        </div>
    </form>

    <div class="mt-2">
        <div class="flex justify-between">
            <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
                <a href="{{ route('register') }}" class="font-medium text-green-400 hover:text-green-300 focus:outline-none focus:underline transition ease-in-out duration-150">
                    Haven't signed up yet?
                </a>
            </p>
            <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
                <a href="{{ route('password.request') }}" class="font-medium text-green-400 hover:text-green-300 focus:outline-none focus:underline transition ease-in-out duration-150">
                    Forgot your password?
                </a>
            </p>
        </div>
    </div>
</div>
