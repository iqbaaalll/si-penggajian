<div class="w-full overflow-hidden rounded-lg shadow-xs mb-8">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($payrollHistory as $payroll)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            Name
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $payroll->employee->name }}
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            Tax Status
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span
                                class="{{ Str::startsWith($payroll->employee->taxStatus, 'TK/') ? 'text-orange-700 bg-orange-100 dark:bg-orange-600 dark:text-blue-100' : 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' }} px-2 py-1 font-semibold leading-tight rounded-full">
                                {{ $payroll->employee->taxStatus }}
                            </span>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            Basic Salary
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($payroll->basicSalary, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            Bonus
                        </td>
                        <td class="px-4 py-3 text-sm">
                            RP. {{ $payroll->bonus != 0 ? number_format($payroll->bonus, 0, ',', '.') : '0' }}
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            THR
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ $payroll->thr != 0 ? number_format($payroll->thr, 0, ',', '.') : '0' }}
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            Bruto Salary
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $payroll->brutoSalary != 0 ? 'Rp. ' . number_format($payroll->brutoSalary, 0, ',', '.') : '0' }}
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            Tax Amount
                        </td>
                        <td class="px-4 py-3 text-sm">
                            - (Rp. {{ number_format($payroll->taxAmount, 0, ',', '.') }})
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            BPJS Kesehatan
                        </td>
                        <td class="px-4 py-3 text-sm">
                            - (Rp. {{ number_format($payroll->bpjsKesAmount, 0, ',', '.') }})
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            BPJS Kesetenagakerjaan
                        </td>
                        <td class="px-4 py-3 text-sm">
                            - (Rp. {{ number_format($payroll->bpjsTkAmount, 0, ',', '.') }})
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            Pension Deduction
                        </td>
                        <td class="px-4 py-3 text-sm">
                            - (Rp. {{ number_format($payroll->pensionAmount, 0, ',', '.') }})
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            Debt Deduction
                        </td>
                        <td class="px-4 py-3 text-sm">
                            - (Rp. 0)
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            Take Home Pay
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($payroll->netSalary, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
