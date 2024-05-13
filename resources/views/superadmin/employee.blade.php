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
                <div class="container px-6 mx-auto grid">
                    <div class="container mx-auto flex justify-between items-center">
                        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            Employee
                        </h2>
                        <a href={{ route('superadmin.addEmployee') }}
                            class="flex px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="w-4 h-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>Add Employee</span>
                        </a>
                    </div>
                    <!-- Employee Table -->
                    @include('layouts.employee-table')
                </div>
            </main>
        </div>
    </div>
</body>

</html>
