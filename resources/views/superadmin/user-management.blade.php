<!-- Dahboard -->
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
        <!-- Desktop sidebar -->
        @include('layouts.sidebar-superadmin')
        <div class="flex flex-col flex-1 w-full">
            @include('layouts.headbar')
            <main class="h-full overflow-y-auto">
                <!-- Alert -->
                @if (session('success'))
                    <div id="alert-success"
                        class="items-center justify-center fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg transition-opacity duration-300 z-50"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <div class="container px-6 mx-auto grid">
                    <div class="container mx-auto flex justify-between items-center">
                        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            User Management
                        </h2>
                        <button @click="openModal"
                            class="flex px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-800 focus:outline-none focus:shadow-outline-red">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="w-4 h-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>Add User</span>
                        </button>
                    </div>
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Name</th>
                                        <th class="px-4 py-3">Email</th>
                                        <th class="px-4 py-3">Role</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($users as $user)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3 text-sm">{{ ucwords($user->name) }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $user->email }}</td>
                                            <td class="px-4 py-3 text-sm">{{ ucwords($user->role) }}</td>
                                            <td class="px-3 py-3">
                                                <div class="flex items-center px-3 text-sm">
                                                    <form method="POST"
                                                        action="{{ route('superadmin.userDelete', $user->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                            aria-label="Delete">
                                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        <!-- Modal -->
        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal"
            @keydown.escape="closeModal"
            class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
            role="dialog" id="modal">
            <!-- Modal body -->
            <div class="mt-4 mb-6">
                <!-- Modal title -->
                <h4 class="mt-4 mb-2 text-xl font-semibold text-gray-800 dark:text-gray-300 text-center">
                    Add New Users
                </h4>
                <p class="mb-4 text-sm font-medium text-gray-600 dark:text-gray-300 text-center">
                    Register new users according to their roles.
                </p>

                <!-- Modal form -->
                <form id="addUserForm" method="POST" action="{{ route('superadmin.addUser') }}">
                    @csrf
                    <label class="block text-sm" for="name">
                        <span class="text-gray-700 font-medium dark:text-gray-400">Name</span>
                        <input
                            class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                            id="name" type="text" name="name" autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </label>

                    <label for="email" class="block mt-4 text-sm">
                        <span class="text-gray-700 font-medium dark:text-gray-400">Email</span>
                        <input
                            class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                            id="email" type="email" name="email" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </label>

                    <label for="role" class="block mt-4 text-sm">
                        <span class="text-gray-700 font-medium dark:text-gray-400">Role</span>
                        <select id="role" name="role"
                            class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input">
                            <option value="" selected disabled>Select User Role</option>
                            <option value="superadmin">Superadmin (HRD, Divisi Keuangan)</option>
                            <option value="admin">Admin (Direktur)</option>
                            <option value="user">User (Karyawan)</option>
                        </select>
                    </label>

                    <label for="password" class="block mt-4 text-sm">
                        <span class="text-gray-700 font-medium dark:text-gray-400">Password</span>
                        <input
                            class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                            id="password" name="password" type="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </label>

                    <label for="password_confirmation" class="block mt-4 text-sm">
                        <span class="text-gray-700 font-medium dark:text-gray-400">Confirm Password</span>
                        <input
                            class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                            id="password_confirmation" name="password_confirmation" type="password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </label>

                    <footer
                        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                        <button @click="closeModal" type="button" id="cancelButton"
                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                            Cancel
                        </button>
                        <button type="submit"
                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            Add User
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var cancelButton = document.getElementById('cancelButton');
            var form = document.getElementById('addUserForm');
            var alertSuccess = document.getElementById('alert-success');

            if (alertSuccess) {
                setTimeout(function() {
                    alertSuccess.classList.add('opacity-0');
                    setTimeout(function() {
                        alertSuccess.remove();
                    }, 300);
                }, 1500);
            }

            cancelButton.addEventListener('click', function() {
                form.reset();
                closeModal();
            });
        });
    </script>
</body>

</html>
