<!-- Login Page -->
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SiGaji BCP</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href={{ asset('template\assets\css\tailwind.output.css') }} />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src={{ asset('template\assets\js\init-alpine.js') }}></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    @vite('template\assets\css\tailwind.output.css')
</head>

<body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img aria-hidden="true" class=" block object-cover w-fulls h-full"
                        src={{ asset('template\assets\img\login-office-dark.jpeg') }} alt="Office" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-2 text-2xl font-bold text-gray-700 dark:text-gray-200">
                            Login
                        </h1>
                        <h2 class="mb-4 text-sm font-medium text-gray-400 dark:text-gray-200">
                            Welcome back! Please Login to your account</h2>
                        </h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <label for="email" class="block text-sm">
                                <span class="text-gray-700 font-semibold dark:text-gray-400">Email</span>
                                <input
                                    class="block w-full mt-2 px-3 text-sm py-2 rounded-md dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="email" type="email" name="email" placeholder="Enter your email" required
                                    autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </label>
                            <label for="password" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-semibold dark:text-gray-400">Password</span>
                                <input
                                    class="block w-full mt-2 px-3 text-sm py-2 rounded-md dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="password" type="password" name="password" placeholder="Enter your password"
                                    autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </label>

                            <button type="submit"
                                class="block w-full px-4 py-2 mt-6 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                Log in
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
