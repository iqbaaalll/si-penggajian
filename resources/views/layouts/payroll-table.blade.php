<div class="w-full overflow-hidden rounded-lg shadow-xs mb-8">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="sticky-column px-4 py-3">Name</th>
                    <th class="px-4 py-3">Tax Status</th>
                    <th class="px-4 py-3">Salary per Month</th>
                    <th class="px-4 py-3">Bonus</th>
                    <th class="px-4 py-3">THR</th>
                    <th class="px-4 py-3">Bruto Salary</th>
                    <th class="px-4 py-3">Tax21 Deduction</th>
                    <th class="px-4 py-3">BPJS Kesehatan</th>
                    <th class="px-4 py-3">BPJS Ketenagakerjaan</th>
                    <th class="px-4 py-3">Pension Deduction</th>
                    <th class="px-4 py-3">Debt Deduction</th>
                    <th class="px-4 py-3">Take Home Pay</th>
                    <th
                        class="{{ request()->is('superadmin/report-payroll/report-details/*') ? 'hidden' : '' }} px-4 py-3">
                        Actions</th>
                    <th class="{{ request()->is('superadmin/payroll/payroll-details/*') ? 'hidden' : '' }} px-4 py-3">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($payrolls as $payroll)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="sticky-column px-4 py-3 text-sm">
                            {{ $payroll->employee->name }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span
                                class="{{ Str::startsWith($payroll->employee->taxStatus, 'TK/') ? 'text-orange-700 bg-orange-100 dark:bg-orange-600 dark:text-blue-100' : 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' }} px-2 py-1 font-semibold leading-tight rounded-full">
                                {{ $payroll->employee->taxStatus }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($payroll->basicSalary, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ $payroll->bonus != 0 ? number_format($payroll->bonus, 0, ',', '.') : '0' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ $payroll->thr != 0 ? number_format($payroll->thr, 0, ',', '.') : '0' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp.
                            {{ $payroll->brutoSalary != 0 ? number_format($payroll->brutoSalary, 0, ',', '.') : '0' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($payroll->taxAmount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($payroll->bpjsKesAmount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($payroll->bpjsTkAmount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($payroll->pensionAmount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($payroll->debtAmount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($payroll->netSalary, 0, ',', '.') }}
                        </td>
                        <td
                            class="{{ request()->is('superadmin/report-payroll/report-details/*') ? 'hidden' : '' }} px-6 py-3 text-sm">
                            <a href="{{ route('superadmin.editPayroll', ['id' => $payroll->employee->id]) }}"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400"
                                aria-label="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5">
                                    <path
                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path
                                        d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                </svg>
                            </a>
                        </td>
                        <td
                            class="{{ request()->is('superadmin/payroll/payroll-details/*') ? 'hidden' : '' }} px-1 py-3 text-sm ">
                            <div class="flex items-center space-x-2 text-sm">
                                <a href={{ route('superadmin.viewPayrollSlip', ['id' => $payroll->employee->id]) }}
                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400"
                                    aria-label="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-5 h-5">
                                        <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        <path fill-rule="evenodd"
                                            d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href={{ route('superadmin.downloadPayrollSlip', ['id' => $payroll->employee->id]) }}
                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400"
                                    aria-label="Download">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                            d="M19.5 21a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3h-5.379a.75.75 0 0 1-.53-.22L11.47 3.66A2.25 2.25 0 0 0 9.879 3H4.5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h15Zm-6.75-10.5a.75.75 0 0 0-1.5 0v4.19l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V10.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href=""
                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400"
                                    aria-label="Download">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5">
                                        <path
                                            d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
        <span class="flex items-center col-span-3">
            Showing {{ $payrolls->firstItem() }}-{{ $payrolls->lastItem() }} of {{ $payrolls->total() }}
        </span>
        <span class="col-span-2"></span>
        <!-- Pagination -->
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">
                    @if ($payrolls->onFirstPage())
                        <li>
                            <button
                                class="px-3 py-1 mr-1 rounded-md bg-gray-300 text-gray-600 dark:text-gray-400 dark:bg-gray-800"
                                aria-label="Previous" disabled>
                                Previous
                            </button>
                        </li>
                    @else
                        <li>
                            <a href="{{ $payrolls->previousPageUrl() }}"
                                class="px-3 py-1 mr-1 rounded-md bg-gray-300 text-gray-600 dark:text-gray-400 dark:bg-gray-800 hover:underline"
                                aria-label="Previous">
                                Previous
                            </a>
                        </li>
                    @endif

                    @if ($payrolls->hasMorePages())
                        <li>
                            <a href="{{ $payrolls->nextPageUrl() }}"
                                class="px-3 py-1 ml-1 rounded-md bg-gray-300 text-gray-600 dark:text-gray-400 dark:bg-gray-800 hover:underline"
                                aria-label="Next">
                                Next
                            </a>
                        </li>
                    @else
                        <li>
                            <button
                                class="px-3 py-1 ml-1 rounded-md bg-gray-300 text-gray-600 dark:text-gray-400 dark:bg-gray-800"
                                aria-label="Next" disabled>
                                Next
                            </button>
                        </li>
                    @endif
                </ul>
            </nav>
        </span>
    </div>
</div>

<style>
    .sticky-column {
        position: -webkit-sticky;
        position: sticky;
        left: 0;
        background-color: inherit;
        z-index: 1;
    }

    thead .sticky-column {
        background-color: #f9fafb;
    }

    tbody .sticky-column {
        background-color: #fff;
    }
</style>
