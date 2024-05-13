<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SiGaji BCP</title>
    @vite('template\assets\css\tailwind.output.css')
    @include('assets.style')
    @include('assets.script')
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('layouts.sidebar-' . $user->role)
        <div class="flex flex-col flex-1 w-full">
            @include('layouts.headbar')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <div class="mt-6">
                        <h2 class="my-2 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            Profile
                        </h2>
                    </div>
                    <!-- Profile Information -->
                    <div class="px-4 py-3 mt-6 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <h4 class="mt-4 mb-2 text-xl font-semibold text-gray-600 dark:text-gray-300">
                            Profile Information
                        </h4>
                        <p class="mb-4 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Update your account's profile information and email address.
                        </p>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <label class="block text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Name</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    placeholder="Jane Doe" value={{ old('name', $user->name) }} required autofocus
                                    autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </label>

                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Email</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    placeholder="Jane Doe" value={{ old('email', $user->email) }} required
                                    autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </label>
                            <div class="mt-4 mb-4">
                                <button type="submit"
                                    class="px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                    Save
                                </button>

                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Update Password -->
                    <div class="px-4 py-3 mt-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <h4 class="mt-4 mb-2 text-xl font-semibold text-gray-600 dark:text-gray-300">
                            Update Password
                        </h4>
                        <p class="mb-4 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Ensure your account is using a long, random password to stay secure.
                        </p>

                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <label for="update_password_current_password" class="block text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Current Password</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="update_password_current_password" name="current_password" type="password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </label>

                            <label for="update_password_password" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">New Password</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="update_password_password" name="password" type="password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </label>

                            <label for="update_password_password_confirmation" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Confirm Password</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="update_password_password_confirmation" name="password_confirmation"
                                    type="password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </label>

                            <div class="mt-4 mb-4">
                                <button type="submit"
                                    class="px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                    Save
                                </button>

                                @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
