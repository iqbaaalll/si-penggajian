<div class="w-full overflow-hidden rounded-lg shadow-xs mb-8">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Salary per Month</th>
                    <th class="px-4 py-3">Tax Status</th>
                    <th class="px-4 py-3">Start Work</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($employees as $employee)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold">
                                        {{ $employee->name }}
                                    </p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        {{ $employee->initialName }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp. {{ number_format($employee->salaryMonth, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span
                                class="{{ Str::startsWith($employee->taxStatus, 'TK/') ? 'text-orange-700 bg-orange-100 dark:bg-orange-600 dark:text-blue-100' : 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' }} px-2 py-1 font-semibold leading-tight rounded-full">
                                {{ $employee->taxStatus }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ \Carbon\Carbon::parse($employee->startWork)->format('d F Y') }}
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ route('admin.viewEmployee', ['id' => $employee->id]) }}"
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
        <span class="flex items-center col-span-3">
            Showing {{ $employees->firstItem() }}-{{ $employees->lastItem() }} of {{ $employees->total() }}
        </span>
        <span class="col-span-2"></span>
        <!-- Pagination -->
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">
                    @if ($employees->onFirstPage())
                        <li>
                            <button
                                class="px-3 py-1 mr-1 rounded-md bg-gray-300 text-gray-600 dark:text-gray-400 dark:bg-gray-800"
                                aria-label="Previous" disabled>
                                Previous
                            </button>
                        </li>
                    @else
                        <li>
                            <a href="{{ $employees->previousPageUrl() }}"
                                class="px-3 py-1 mr-1 rounded-md bg-gray-300 text-gray-600 dark:text-gray-400 dark:bg-gray-800 hover:underline"
                                aria-label="Previous">
                                Previous
                            </a>
                        </li>
                    @endif

                    @if ($employees->hasMorePages())
                        <li>
                            <a href="{{ $employees->nextPageUrl() }}"
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
