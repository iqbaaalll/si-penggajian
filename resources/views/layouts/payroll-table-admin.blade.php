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
                    <th class="px-4 py-3">Take Home Pay</th>
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
                            {{ $payroll->bonus != 0 ? 'Rp. ' . number_format($payroll->bonus, 0, ',', '.') : '0' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $payroll->thr != 0 ? 'Rp. ' . number_format($payroll->thr, 0, ',', '.') : '0' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $payroll->brutoSalary != 0 ? 'Rp. ' . number_format($payroll->brutoSalary, 0, ',', '.') : '0' }}
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
                            Rp. {{ number_format($payroll->netSalary, 0, ',', '.') }}
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
