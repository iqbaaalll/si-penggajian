<div class="w-full overflow-hidden rounded-lg shadow-xs mb-8">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Tax Status</th>
                    <th class="px-4 py-3">Tax21 Deduction</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($payrolls as $payroll)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            {{ $payroll->employee->name }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span
                                class="{{ Str::startsWith($payroll->employee->taxStatus, 'TK/') ? 'text-orange-700 bg-orange-100 dark:bg-orange-600 dark:text-blue-100' : 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' }} px-2 py-1 font-semibold leading-tight rounded-full">
                                {{ $payroll->employee->taxStatus }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($payroll->taxAmount, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                <tr class="font-semibold text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-md" colspan="2">Total</td>
                    <td class="px-4 py-3 text-md">
                        Rp. {{ number_format($totalTaxDeduction, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
