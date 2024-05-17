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
                            Employee Detail
                        </h2>
                        <a href={{ route('superadmin.employee') }}
                            class="flex font-medium text-gray-600 dark:text-gray-200 hover:text-red-800 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                            </svg>
                            <span class="ml-2 text-sm">Back to Employee Table</span>
                        </a>
                    </div>
                    <div>
                        <!-- Employee Information -->
                        <div class="px-4 py-3 mb-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <h4
                                class="mt-2 mb-2 text-xl font-semibold text-gray-900 underline underline-offset-0 dark:text-gray-300">
                                Employee Information
                            </h4>

                            <label for="name" class="block text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Name</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    {{ $employee->name }}
                                </div>
                            </label>

                            <label for="initialName" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Initial Name</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>{{ $employee->initialName }}</span>
                                </div>
                            </label>

                            <label for="birth" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Birth Date</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>{{ \Carbon\Carbon::parse($employee->birth)->format('d F Y') }}</span>
                                </div>
                            </label>

                            <label for="phoneNumber" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Phone Number</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>{{ $employee->phoneNumber }}</span>
                                </div>
                            </label>
                        </div>

                        <!-- Payroll Information -->
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <h4
                                class="mt-2 mb-2 text-xl font-semibold text-gray-900 underline underline-offset-0 dark:text-gray-300">
                                Payroll Information
                            </h4>

                            <label for="startWork" class="block text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Start Work</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>{{ \Carbon\Carbon::parse($employee->startWork)->format('d F Y') }}</span>
                                </div>
                            </label>

                            <label for="salaryMonth" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Salary per Month</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>Rp. {{ number_format($employee->salaryMonth, 0, ',', '.') }}</span>
                                </div>
                            </label>

                            <label for="salaryMonth" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Bonus</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>Rp. {{ number_format($employee->bonus, 0, ',', '.') }}</span>
                                </div>
                            </label>

                            <label for="salaryMonth" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">THR (Tunjangan Hari
                                    Raya)</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>Rp. {{ number_format($employee->thr, 0, ',', '.') }}</span>
                                </div>
                            </label>

                            <label for="taxStatus" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Tax Status</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>{{ $employee->taxStatus }}</span>
                                </div>
                            </label>

                            <label for="nip" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">NIP (Nomor Induk
                                    Pegawai)</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>{{ $employee->nip }}</span>
                                </div>
                            </label>

                            <label for="nik" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">NIK (Nomor Induk
                                    Kependudukan)</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>{{ $employee->nik }}</span>
                                </div>
                            </label>

                            <label for="npwp" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">NPWP (Nomor Pokok Wajib
                                    Pajak)</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>{{ $employee->npwp }}</span>
                                </div>
                            </label>

                            <label for="bpjsKes" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Nomor BPJS Kesehatan</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>{{ $employee->bpjsKes }}</span>
                                </div>
                            </label>

                            <label for="bpjsTk" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Nomor BPJS
                                    Ketenagakerjaan</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>{{ $employee->bpjsTk }}</span>
                                </div>
                            </label>

                            <label for="bankAccount" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Bank Account</span>
                                <div class="block w-full mt-1 dark:text-gray-300">
                                    <span>{{ $employee->bankAccount }}</span>
                                </div>
                            </label>

                            <div class="flex mt-4 mb-4 justify-end">
                                <a href="{{ route('superadmin.editEmployee', ['id' => $employee->id]) }}"
                                    class="px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                    Edit Employee Data
                                </a>
                            </div>
                        </div>
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
