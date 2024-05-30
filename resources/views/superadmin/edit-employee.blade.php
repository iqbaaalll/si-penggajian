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
                            Edit Employee Data
                        </h2>
                        <a href="{{ route('superadmin.viewEmployee', ['id' => Crypt::encryptString($employee->id)]) }}"
                            class="flex font-medium text-gray-600 dark:text-gray-200 hover:text-red-800 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                            </svg>
                            <span class="ml-2 text-sm">Back to Employee Detail</span>
                        </a>
                    </div>
                    <!-- Employee Information -->
                    <form method="POST" action="{{ route('superadmin.updateEmployee', Crypt::encryptString($employee->id)) }}">
                        @csrf
                        @method('PUT')
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <h4 class="mt-4 mb-2 text-xl font-semibold text-gray-600 dark:text-gray-300">
                                Employee Information
                            </h4>
                            <p class="mb-4 text-sm font-medium text-gray-600 dark:text-gray-300">
                                Update data related to the employee's personal profile.
                            </p>

                            <label for="name" class="block text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Name</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="name" name="name" type="text" autofocus autocomplete="name"
                                    value={{ $employee->name }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </label>

                            <label for="initialName" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Initial Name</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="initialName" name="initialName" type="text"
                                    value={{ old('name', $employee->initialName) }} required
                                    oninput="this.value = this.value.toUpperCase()" />
                                <x-input-error class="mt-2" :messages="$errors->get('initialName')" />
                            </label>

                            <label for="birth" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Birth Date</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="birth" name="birth" type="date"
                                    value={{ old('name', $employee->birth) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('birth')" />
                            </label>

                            <label for="phoneNumber" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Phone Number</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="phoneNumber" name="phoneNumber" type="text"
                                    value={{ old('name', $employee->phoneNumber) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('phoneNumber')" />
                            </label>

                            <h4 class="mt-8 mb-2 text-xl font-semibold text-gray-600 dark:text-gray-300">
                                Payroll Information
                            </h4>
                            <p class="mb-4 text-sm font-medium text-gray-600 dark:text-gray-300">
                                Update data related to employee payroll information.
                            </p>

                            <label for="startWork" class="block text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Start Work</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="startWork" name="startWork" type="date"
                                    value={{ old('name', $employee->startWork) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('startWork')" />
                            </label>

                            <label for="salaryMonth" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Salary per Month</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="salaryMonth" name="salaryMonth" type="number"
                                    value={{ old('name', $employee->salaryMonth) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('salaryMonth')" />
                            </label>

                            <label for="bonus" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Bonus</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="bonus" name="bonus" type="number"
                                    value={{ old('name', $employee->bonus) }} />
                                <x-input-error class="mt-2" :messages="$errors->get('bonus')" />
                            </label>

                            <label for="thr" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">THR (Tungjangan Hari Raya)</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="thr" name="thr" type="number"
                                    value={{ old('name', $employee->thr) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('thr')" />
                            </label>

                            <label for="taxStatus" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Tax Status</span>
                                <select id="taxStatus" name="taxStatus"
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input">
                                    <option value="" selected disabled>Select Tax Status</option>
                                    <option value="TK/0"
                                        {{ old('taxStatus', $employee->taxStatus) == 'TK/0' ? 'selected' : '' }}>TK/0
                                        (Tidak kawin tanpa tanggungan)</option>
                                    <option value="TK/1"
                                        {{ old('taxStatus', $employee->taxStatus) == 'TK/1' ? 'selected' : '' }}>TK/1
                                        (Tidak kawin dengan satu tanggungan)</option>
                                    <option value="TK/2"
                                        {{ old('taxStatus', $employee->taxStatus) == 'TK/2' ? 'selected' : '' }}>TK/2
                                        (Tidak kawin dengan dua tanggungan)</option>
                                    <option value="TK/3"
                                        {{ old('taxStatus', $employee->taxStatus) == 'TK/3' ? 'selected' : '' }}>TK/3
                                        (Tidak kawin dengan tiga tanggungan)</option>
                                    <option value="K/0"
                                        {{ old('taxStatus', $employee->taxStatus) == 'K/0' ? 'selected' : '' }}>K/0
                                        (Kawin tanpa tanggungan)</option>
                                    <option value="K/1"
                                        {{ old('taxStatus', $employee->taxStatus) == 'K/1' ? 'selected' : '' }}>K/1
                                        (Kawin dengan satu tanggungan)</option>
                                    <option value="K/2"
                                        {{ old('taxStatus', $employee->taxStatus) == 'K/2' ? 'selected' : '' }}>K/2
                                        (Kawin dengan dua tanggungan)</option>
                                    <option value="K/3"
                                        {{ old('taxStatus', $employee->taxStatus) == 'K/3' ? 'selected' : '' }}>K/3
                                        (Kawin dengan tiga tanggungan)</option>
                                </select>
                            </label>

                            <label for="nip" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">NIP (Nomor Induk
                                    Pegawai)</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="nip" name="nip" type="text"
                                    value={{ old('name', $employee->nip) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('nip')" />
                            </label>

                            <label for="nik" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">NIK (Nomor Induk
                                    Kependudukan)</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="nik" name="nik" type="text"
                                    value={{ old('name', $employee->nik) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik')" />
                            </label>

                            <label for="npwp" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">NPWP (Nomor Pokok Wajib
                                    Pajak)</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="npwp" name="npwp" type="text"
                                    value={{ old('name', $employee->npwp) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('npwp')" />
                            </label>

                            <label for="bpjsKes" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Nomor BPJS Kesehatan</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="bpjsKes" name="bpjsKes" type="text"
                                    value={{ old('name', $employee->bpjsKes) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('bpjsKes')" />
                            </label>

                            <label for="bpjsTk" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Nomor BPJS
                                    Ketenagakerjaan</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="bpjsTk" name="bpjsTk" type="text"
                                    value={{ old('name', $employee->bpjsTk) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('bpjsTk')" />
                            </label>

                            <label for="bankAccount" class="block mt-4 text-sm">
                                <span class="text-gray-700 font-medium dark:text-gray-400">Bank Account</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input"
                                    id="bankAccount" name="bankAccount" type="text"
                                    value={{ old('name', $employee->bankAccount) }} required />
                                <x-input-error class="mt-2" :messages="$errors->get('bankAccount')" />
                            </label>

                            <div class="mt-4 mb-4">
                                <button type="submit"
                                    class="px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                    Update Employee Data
                                </button>
                            </div>
                        </div>
                    </form>
            </main>
        </div>
    </div>
</body>

</html>
