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
                            Payroll
                        </h2>
                        <button @click="openModal"
                            class="flex px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-800 focus:outline-none focus:shadow-outline-red">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="w-4 h-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>Add New Payroll</span>
                        </button>
                    </div>
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Payroll Period</th>
                                        <th class="px-4 py-3">Payroll Schedule</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($payrollPeriod as $period)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3 text-sm font-semibold">
                                                {{ \Carbon\Carbon::parse($period->payrollMonth)->format('F Y') }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ \Carbon\Carbon::parse($period->payrollSchedule)->format('d F Y') }}
                                            </td>
                                            <td class="px-6 py-3">
                                                <a href="{{ route('superadmin.payrollDetails', ['id' => $period->id]) }}"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400"
                                                    aria-label="View">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                        <path fill-rule="evenodd"
                                                            d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
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
                    Setup Run Payroll
                </h4>
                <p class="mb-4 text-sm font-medium text-gray-600 dark:text-gray-300 text-center">
                    Setup payroll time by month and year and schedule details.
                </p>
                <!-- Modal form -->
                <form id="payrollForm" method="POST" action="{{ route('superadmin.runPayroll') }}">
                    @csrf
                    <label for="payrollMonth" class=" text-sm flex flex-col ">
                        <span class="text-gray-700 font-semibold dark:text-gray-400">Payroll Period</span>
                        <input
                            class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-300 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                            id="payrollMonth" name="payrollMonth" type="month" required />
                        <x-input-error class="mt-2" :messages="$errors->get('payrollMonth')" />
                    </label>

                    <label for="payrollSchedule" class=" text-sm mt-6 flex flex-col">
                        <span class="text-gray-700 font-semibold dark:text-gray-400">Payroll Schedule</span>
                        <input
                            class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-300 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                            id="payrollSchedule" name="payrollSchedule" type="date" required />
                        <x-input-error class="mt-2" :messages="$errors->get('payrollSchedule')" />
                    </label>

                    <div class="inline-flex  mt-4">
                        <input type="checkbox" id="bonus" name="bonus" value="true">
                        <label for="bonus" class="mr-2 px-2 text-sm text-gray-800 dark:text-gray-300">with
                            Bonus</label>
                        <input type="checkbox" id="thr" name="thr" value="true">
                        <label for="thr" class="px-2 text-sm text-gray-800 dark:text-gray-300">with THR</label>
                    </div>

                    <p class="text-sm text-gray-400">* make sure you have checked the bonus and THR data for each
                        employee</p>

                    <footer
                        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-white dark:bg-gray-800">
                        <button @click="closeModal"
                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                            Cancel
                        </button>
                        <button type="submit"
                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            Run Payroll
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('payrollForm');
            var payrollMonth = document.getElementById('payrollMonth');
            var payrollSchedule = document.getElementById('payrollSchedule');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                if (payrollMonth.value === '' || payrollSchedule.value === '') {
                    alert('Please fill in all fields');
                    return false;
                }

                this.submit();
            });
        });
    </script>
</body>

</html>
