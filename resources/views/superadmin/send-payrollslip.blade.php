<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Slip Gaji {{ \Carbon\Carbon::parse($payrollSlip->payrollPeriod->payrollMonth)->format('F Y') }}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="template\assets\img\logo-bcp.png" style="width: 50%; max-width: 120px" />
                            </td>

                            <td>
                                No. Slip Gaji : #{{ str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT) }}<br />
                                Tanggal:
                                {{ \Carbon\Carbon::parse($payrollSlip->payrollPeriod->payrollSchedule)->format('d/m/Y') }}<br />
                                Periode:
                                {{ \Carbon\Carbon::parse($payrollSlip->payrollPeriod->payrollMonth)->format('F Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                PT. Bhineka Ciptabahana Pura<br />
                                Rukan Grand Aries Niaga, Jl. Taman Aries No.1J<br />
                                Kembangan, Jakarta Barat 11620
                            </td>

                            <td>
                                {{ $payrollSlip->employee->name }}<br />
                                NIP. {{ $payrollSlip->employee->nip }}<br />
                                No Rekening: {{ $payrollSlip->employee->bankAccount }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Keterangan</td>

                <td>Nominal</td>
            </tr>

            <tr class="item">
                <td>Gaji</td>

                <td>{{ $payrollSlip->brutoSalary != 0 ? 'Rp. ' . number_format($payrollSlip->brutoSalary, 0, ',', '.') : '0' }}
                </td>
            </tr>

            <tr class="heading">
                <td>Potongan</td>

                <td>Nominal</td>
            </tr>

            <tr class="item">
                <td>PPH21</td>

                <td>{{ $payrollSlip->taxAmount != 0 ? 'Rp. ' . number_format($payrollSlip->taxAmount, 0, ',', '.') : '0' }}
                </td>
            </tr>

            <tr class="item">
                <td>BPJS Ketenagakerjaan (2%)</td>

                <td>{{ $payrollSlip->bpjsTkAmount != 0 ? 'Rp. ' . number_format($payrollSlip->bpjsTkAmount, 0, ',', '.') : '0' }}
                </td>
            </tr>

            <tr class="item">
                <td>BPJS Kesehatan</td>

                <td>{{ $payrollSlip->bpjsKesAmount != 0 ? 'Rp. ' . number_format($payrollSlip->bpjsKesAmount, 0, ',', '.') : '0' }}
                </td>
            </tr>

            <tr class="item">
                <td>Iuran Pensiun</td>

                <td>{{ $payrollSlip->pensionAmount != 0 ? 'Rp. ' . number_format($payrollSlip->pensionAmount, 0, ',', '.') : '0' }}
                </td>
            </tr>

            <tr class="item last">
                <td>Angsuran Hutang</td>

                <td>Rp. 0</td>
            </tr>

            <tr class="total">
                <td></td>

                <td>Total:
                    {{ $payrollSlip->netSalary != 0 ? 'Rp. ' . number_format($payrollSlip->netSalary, 0, ',', '.') : '0' }}
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Mengetahui<br />
                                Manager HRD<br /><br /><br /><br />
                                Chuswatin
                            </td>

                            <td>
                                Jakarta, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}<br />
                                Penerima<br /><br /><br /><br />
                                {{ $payrollSlip->employee->name }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
