<div>
    <form wire:submit.prevent="register" action="#" method="POST">
        <div>
            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                Name
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input wire:model="name" id="name" type="text" required autofocus class="@error('name') border-red-500 @enderror appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-green focus:border-green-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
            </div>
            @error('name') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>
        <div class="mt-3">
            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                Email address
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input wire:model="email" id="email" type="email" autofocus class="@error('email') border-red-500 @enderror appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-green focus:border-green-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
            </div>
            @error('email') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mt-3" x-data="{ showPassword: false }">
            <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                Password <span class="cursor-pointer" @click="showPassword = !showPassword">(
                    <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    )</span>
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input wire:model.lazy="password" id="password" :type="showPassword ? 'text' : 'password'" required class="@error('password') border-red-500 @enderror appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-green focus:border-green-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
            </div>
            @error('password') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mt-6">
            <span class="block w-full rounded-md shadow-sm">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-300 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition duration-150 ease-in-out">
                    Register
                </button>
            </span>
        </div>

        <div class="mt-6">
            <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
                <a href="/login" class="font-medium text-green-400 hover:text-green-300 focus:outline-none focus:underline transition ease-in-out duration-150">
                    Already Have An Account?
                </a>
            </p>
        </div>
    </form>
</div>