<div class="w-full overflow-hidden rounded-lg shadow-xs mb-8">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Bank Account</th>
                    <th class="px-4 py-3">Take Home Pay</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($payrolls as $payroll)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            {{ $payroll->employee->name }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $payroll->employee->bankAccount }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($payroll->netSalary, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                <tr class="font-semibold text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-md" colspan="2">Total</td>
                    <td class="px-4 py-3 text-md">
                        Rp. {{ number_format($totalNetSalary, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
