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
                            Payroll Detail
                            {{ \Carbon\Carbon::parse($payrollPeriod->payrollMonth)->format('F Y') }}
                        </h2>
                        <a href={{ route('superadmin.payroll') }}
                            class="flex font-medium text-gray-600 dark:text-gray-200 hover:text-red-800 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                            </svg>
                            <span class="ml-2 text-sm">Back to Payroll Period</span>
                        </a>
                    </div>
                    @include('layouts.payroll-table')
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alertSuccess = document.getElementById('alert-success');

            if (alertSuccess) {
                setTimeout(function() {
                    alertSuccess.classList.add('opacity-0');
                    setTimeout(function() {
                        alertSuccess.remove();
                    }, 300);
                }, 1500);
            }
        });
    </script>
</body>

</html>
