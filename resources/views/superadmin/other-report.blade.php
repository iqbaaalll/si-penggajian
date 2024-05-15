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
                            Other Report
                            {{ \Carbon\Carbon::parse($payrollPeriod->payrollMonth)->format('F Y') }}
                        </h2>
                        <a href={{ route('superadmin.payrollReport') }}
                            class="flex font-medium text-gray-600 dark:text-gray-200 hover:text-red-800 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                            </svg>
                            <span class="ml-2 mr-4 text-sm">Back to Payroll Report</span>
                        </a>
                    </div>
                    <div class="inline-flex mb-4">
                        <select id="reportType" name="reportType"
                            class="block w-full mt-1 text-sm dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-gray dark:text-gray-300 form-input">
                            <option value="" selected disabled>Select Report Type</option>
                            <option value="transferList"
                                data-url="{{ route('superadmin.exportTransferList', ['id' => $payrollPeriod->id]) }}">
                                Transfer List Report</option>
                            <option value="taxReport"
                                data-url="{{ route('superadmin.exportTaxReport', ['id' => $payrollPeriod->id]) }}">Tax
                                Report</option>
                            <option value="bpjsReport"
                                data-url="{{ route('superadmin.exportBpjsReport', ['id' => $payrollPeriod->id]) }}">BPJS
                                Report</option>
                        </select>
                        <a id="exportLink" href="#"
                            class="flex px-3 py-3 text-center ml-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-800 focus:outline-none focus:shadow-outline-red">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.0" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                            </svg>
                        </a>
                    </div>
                    <div id="reportContent" />
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reportTypeSelect = document.getElementById('reportType');
            const reportContentDiv = document.getElementById('reportContent');

            reportTypeSelect.addEventListener('change', function() {
                const selectedValue = this.value;

                reportContentDiv.innerHTML = '';

                if (selectedValue === 'transferList') {
                    reportContentDiv.innerHTML = `
                @include('layouts.transferlist-table')`;
                } else if (selectedValue === 'taxReport') {
                    reportContentDiv.innerHTML = `
                @include('layouts.taxreport-table')`;
                } else if (selectedValue === 'bpjsReport') {
                    reportContentDiv.innerHTML = `
                @include('layouts.bpjsreport-table')`;
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reportTypeSelect = document.getElementById('reportType');
            const exportLink = document.getElementById('exportLink');

            reportTypeSelect.addEventListener('change', function() {
                const selectedOption = reportTypeSelect.options[reportTypeSelect.selectedIndex];
                const url = selectedOption.getAttribute('data-url');

                if (url) {
                    exportLink.href = url;
                } else {
                    exportLink.href = '#';
                }
            });
        });
    </script>
</body>

</html>
