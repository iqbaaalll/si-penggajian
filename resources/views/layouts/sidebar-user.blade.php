<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="inline-flex ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href={{ route('admin.dashboard') }}>
            <img src={{ asset('template\assets\img\logo-bcp.png') }} alt="" class="w-8 h-8">
            <span class="mt-1 ml-1">SiGaji BCP</span>
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span
                    class="{{ request()->is('user/dashboard') ? 'absolute' : 'hidden' }} inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                <a class="{{ request()->is('user/dashboard') ? 'text-gray-800 dark:text-gray-100' : '' }} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href={{ route('user.dashboard') }}>
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul>
            <li class="relative px-6 py-3">
                <span
                    class="{{ request()->is('user/payslip*') ? 'absolute' : 'hidden' }} inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                <a class="{{ request()->is('user/payslip*') ? 'text-gray-800 dark:text-gray-100' : '' }} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href={{ route('user.payslip') }}>
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    <span class="ml-4">Payslip</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                <span
                    class="{{ request()->is('user/payroll-history*') ? 'absolute' : 'hidden' }} inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                <a class="{{ request()->is('user/payroll-history*') ? 'text-gray-800 dark:text-gray-100' : '' }} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href={{ route('user.payrollHistory') }}>
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                    <span class="ml-4">Payroll History</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
