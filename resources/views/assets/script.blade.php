<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src={{ asset('template\assets\js\init-alpine.js') }}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
<script src={{ asset('template\assets\js\charts-lines.js') }} defer></script>
<script src={{ asset('template\assets\js/charts-pie.js') }} defer></script>
<script src={{ asset('template\assets\js\focus-trap.js') }} defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const payrollMonth = document.getElementById('payrollMonth');
        const payrollSchedule = document.getElementById('payrollSchedule');

        // Fungsi untuk mengatur nilai default pada input payrollSchedule
        function setPayrollScheduleValue() {
            const selectedYearMonth = payrollMonth.value.split('-');
            const year = selectedYearMonth[0];
            const month = selectedYearMonth[1];

            // Mengatur nilai default pada input payrollSchedule
            payrollSchedule.value = `${year}-${month}-25`;
        }

        // Panggil fungsi setPayrollScheduleValue saat halaman dimuat
        setPayrollScheduleValue();

        // Tambahkan event listener untuk mengubah nilai payrollSchedule saat payrollMonth diubah
        payrollMonth.addEventListener('change', setPayrollScheduleValue);
    });
</script>
