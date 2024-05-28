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
                            Edit Payroll Attributes
                        </h2>
                        <a href=""
                            class="flex font-medium text-gray-600 dark:text-gray-200 hover:text-red-800 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                            </svg>
                            <span class="ml-2 text-sm">Back to Payroll Period</span>
                        </a>
                    </div>
                    <!-- Employee Information -->
                    <form method="POST" action="{{ route('superadmin.updatePayroll', $payroll->employee->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <h4 class="mt-4 mb-2 text-xl font-semibold text-gray-900 dark:text-gray-300 underline underline-offset-0">
                                Payroll Attributes
                            </h4>
                            <p class="mb-4 text-sm font-medium text-gray-600 dark:text-gray-300">
                                Update data related to the pension deduction and debt deduction.
                            </p>

                            <label for="name" class="block text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Name</span>
                                <span
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300">{{ $payroll->employee->name }}</span>
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </label>

                            <label for="pensionAmount" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Pension Deduction</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="pensionAmount" name="pensionAmount" type="number"
                                    value={{ old('pensionAmount', $payroll->pensionAmount) }} required
                                    oninput="this.value = this.value.toUpperCase()" />
                                <x-input-error class="mt-2" :messages="$errors->get('pensionAmount')" />
                            </label>


                            <label for="debtAmount" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Debt Deduction</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="debtAmount" name="debtAmount" type="number"
                                    value={{ old('debtAmount', $payroll->debtAmount) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('debtAmount')" />
                            </label>

                            <div class="mt-4 mb-4">
                                <button type="submit"
                                    class="px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                    Update Payroll Attributes
                                </button>
                            </div>
                        </div>
                    </form>
            </main>
        </div>
    </div>
</body>

</html>
