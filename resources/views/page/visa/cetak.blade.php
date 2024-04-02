<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['pageTitle'] }} - {{ $data['autoId'] }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
        }

        span.header {
            font-size: 24pt;
        }

        span.subheader {
            font-size: 16pt;
        }

        .horizontal-rule {
            background-color: transparent;
            margin: 5px 0;
        }

        .horizontal-rule.black {
            border-top: 4px solid black;
        }

        .horizontal-rule.red {
            border-top: 4px solid #fdd911;
        }

        .no-border {
            border-left: 1px solid rgb(255, 255, 255);
            border-bottom: 1px solid white;
        }

        @media print {
            @page {
                size: auto;
                /* auto is the default value, which adjusts page size based on content */
                margin: 0.15in 0.5in;

                /* Remove default margin */
                /* To exclude headers and footers, set display: none */
                header,
                footer {
                    display: none;
                }
            }
        }
    </style>
</head>

<body>
    <div style="font-size: 11pt">
        <table border="0">
            <thead>
                <tr>
                    <th>
                        <img src="{{ asset('assets/compiled/png/logo.png') }}" alt="logo" width="120px"
                            style="border-radius: 50%;">
                    </th>
                    <th>
                        <span class="header">PT RIZQUNA MEKKAH MADINAH</span> <br>
                        <span class="subheader">IZIN : 02350009222460004</span> <br>
                        <span style="font-size: 11pt">Ruko Graha Aziz, Unit B. Jl.KH. Abdullah Syafei No. 12, RT/TW
                            012/009, <br>Kel.Bukit
                            Duri,
                            Kec.Tebet Jakarta Selatan</span> <br>
                        <span style="font-size: 10pt"><img src="{{ asset('assets/compiled/png/email.png') }}"
                                alt="email" width="15px"> rizqunamekkahmadinahjkt@gmail.com , <img
                                src="{{ asset('assets/compiled/png/wa.png') }}" alt="email" width="15px">
                            081999940934</span>
                    </th>
                </tr>
            </thead>
        </table>
        <div class="horizontal-rule red"></div>
        <div class="horizontal-rule black"></div>
        <u>
            <h2 style="text-align: center">INVOICE</h2>
        </u> <br> <br>
        <table style="border-collapse: collapse" border="0">
            <thead>
                <tr>
                    <th style="text-align: left" colspan="8">Customer</th>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>: <b><span id="namaagen">Em Abror</span></b></td>
                    <td colspan="3" width="20%"></td>
                    <td colspan="2">Number</td>
                    <td>: <span id="noinvoice">003/INV</span></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td colspan="2">Invoice Date</td>
                    <td>: <span id="tglinvoice">2 Feb</span></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td colspan="2">Payment Term</td>
                    <td>: <span id="metodebayar">Cash</span> / Transfer</td>
                </tr>
            </thead>
        </table>
        <br>
        <table border="1" style="width: 80%; border-collapse: collapse;" cellpadding="3px">
            <thead>
                <tr>
                    <th>Tanggal Keberangkatan</th>
                    <th>Jumlah Pax</th>
                    <th colspan="2">Harga / Pax</th>
                    <th colspan="2">Total</th>
                </tr>
            </thead>
            <tbody id="invoiceDetailsBody" style="vertical-align: bottom">
            </tbody>
            <tfoot id="myTfoot">
                <tr>
                    <th colspan="2" rowspan="3" class="no-border"></th>
                    <th colspan="2">Total</th>
                    <th style="text-align: left; border-right: 1px solid rgba(0, 0, 0, 0)">$</th>
                    <th style="text-align: right"><span id="totalusd">25.924.600</span></th>
                </tr>
                <tr>
                    <th colspan="2"><span id="deposito"></span></th>
                    <th style="text-align: left; border-right: 1px solid rgba(0, 0, 0, 0)"><span id="rupiah"></span>
                    </th>
                    <th style="text-align: right"><span id="hasildeposito"></span></th>
                </tr>
                <tr>
                    <th colspan="2"><span id="sstatus">TEST</span></th>
                    <th style="text-align: left; border-right: 1px solid rgba(0, 0, 0, 0)">IDR</th>
                    <th style="text-align: right"><span id="sisadeposit">-</span></th>
                </tr>
            </tfoot>
        </table>
        <p>
            <b>
                <i>*note : kurs mengikuti kurs BSI pada saat hari pembayaran</i> <br>
                * KURS BSI <span id="tglkurs"></span> Rp. <span id="bsi_kurs"></span> <br>
                * KURS RIYAL <span id="tglkurs1"></span> SAR <span id="sar_kurs"></span>
            </b>
        </p>
        <table>
            <tbody>
                <tr>
                    <td>
                        <table border="1" style="border-collapse: collapse; text-align: left;" cellpadding="5px">
                            <tbody>
                                <tr>
                                    <th>
                                        <u>Transfer ke : </u> <br>
                                        No. Rek <br>
                                        A/n <br>
                                        Bank
                                    </th>
                                    <th>
                                        <br>
                                        : <span id="norek1">isi no rekening</span><br>
                                        : PT. RIZQUNA MEKKAH MADINAH<br>
                                        : <span id="norekid1">isi nama bank</span>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        No. Rek <br>
                                        A/n <br>
                                        Bank
                                    </th>
                                    <th>
                                        : <span id="norek2">isi no rekening</span><br>
                                        : PT. RIZQUNA MEKKAH MADINAH<br>
                                        : <span id="norekid2">isi nama bank</span>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table style="text-align: center">
                            <tbody>
                                <tr>
                                    <td style="width: 10%"></td>
                                    <td style="width: 50%; text-align: center;">
                                        <span>Approve By</span> <br>
                                        <img src="{{ asset('assets/compiled/png/logo.png') }}" alt="logo"
                                            width="120px" style="border-radius: 50%;"> <br>
                                        <span><b><u>Fatimah Az zahra</u></b></span> <br>
                                        <span>Finance</span>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            var jwtToken = localStorage.getItem('jwtToken');
            fetchPaymentData(jwtToken);
            var bank = '{{ $data['bank'] }}';
            fetchRekenings(bank);

            function fetchPaymentData(jwtToken) {
                var paymentIdBase64 = "{{ $data['idpage'] }}";
                var paymentId = atob(paymentIdBase64);
                if (jwtToken) {
                    $.ajax({
                        url: "{{ route('visa') }}/" + paymentId,
                        type: 'GET',
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                        },
                        success: function(response) {
                            $('#namaagen').html(response.agent.nama_agent);
                            $('#noinvoice').html(response.visa_id);
                            $('#tglinvoice').html(formatDate(response.tgl_visa));
                            $('#sstatus').html(response.status);

                            var detailpay = response.details;
                            var sumDeposit = 0;
                            var formattedSumDeposit = 0;
                            var sisaDeposit = 0;

                            detailpay.forEach(function(detail, index) {
                                sumDeposit += parseFloat(detail
                                    .deposit
                                ); // Convert deposit to a number and accumulate the total

                                // Update the content of the deposito span
                                var depositSpan = $('#deposito');
                                depositSpan.append('<span id="deposit' + (index + 1) +
                                    '">Deposit ' + (index + 1) + ' ' + formatDate2(detail
                                        .tgl_payment_visa) + '</span><br>');
                                var rupiahSpan = $('#rupiah');
                                rupiahSpan.append('<span id="rupiah' + (index + 1) +
                                    '">IDR</span><br>');

                                // Update the content of the hasildeposito span with formatted deposit value
                                var hasildepositSpan = $('#hasildeposito');
                                hasildepositSpan.append('<span id="hasildeposito' + (index +
                                        1) + '">' + formatCurrencyID(detail.deposit) +
                                    '</span><br>');
                            });
                            // Calculate sisaDeposit
                            sisaDeposit = parseFloat(response.kurs.hasil_konversi) - sumDeposit;

                            // Format sumDeposit and sisaDeposit for display
                            formattedSumDeposit = formatCurrencyID(sumDeposit);
                            sisaDeposit = formatCurrencyID(sisaDeposit);

                            // Update the HTML content of sisadeposit and sumdeposit elements
                            $('#sisadeposit').html(sisaDeposit);
                            $('#sumdeposit').html(formattedSumDeposit);
                            setTimeout(function() {
                                window.print();
                            }, 1000);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    console.error('JWT token not found in localStorage.');
                }
            }

            getDetail();

            function getDetail() {
                var paymentIdBase64 = "{{ $data['idpage'] }}";
                var paymentId = atob(paymentIdBase64);
                $.ajax({
                    url: "{{ route('visa') }}/" + paymentId,
                    type: 'GET',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(data) {
                        // Clear existing rows
                        $('#invoiceDetailsBody').empty();

                        var tglKeberangkatan = formatDate(data.tgl_keberangkatan);
                        var jumlahPax = formatCurrencyID(data.jumlah_pax);
                        var hargaPax = formatCurrencyID(data.harga_pax);
                        var total = formatCurrencyID(data.total);
                        var kurs_bsi = formatCurrencyID(data.kurs.kurs_bsi);
                        var kurs_riyal = formatCurrencyID(data.kurs.kurs_riyal);
                        var tgl_kurs = formatDate(data.kurs.created_at);

                        // Creating table row
                        var row = '<tr>' +
                            '<td style="text-align: center">VISA <br>' + tglKeberangkatan + '</td>' +
                            '<td style="text-align: center">' + jumlahPax + '</td>' +
                            '<td style="text-align: left; border-right: 1px solid rgba(0, 0, 0, 0)">$</td>' +
                            '<td style="text-align: right">' + hargaPax + '</td>' +
                            '<td style="text-align: left; border-right: 1px solid rgba(0, 0, 0, 0)">$</td>' +
                            '<td style="text-align: right">' + total + '</td>' +
                            '</tr>';

                        // Appending row to table body
                        $('#invoiceDetailsBody').append(row);

                        // Update total USD
                        $('#totalusd').html(total);
                        $('#bsi_kurs').html(kurs_bsi);
                        $('#sar_kurs').html(kurs_riyal);
                        $('#tglkurs').html(tgl_kurs);
                        $('#tglkurs1').html(tgl_kurs);
                    },
                    error: function(xhr, status, error) {
                        console.error(status + ': ' + error);
                    }
                });
            }

            function fetchRekenings(rekening_id) {
                $.ajax({
                    url: "{{ route('rekening') }}",
                    type: 'GET',
                    data: {
                        rekening_id: rekening_id
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(data) {
                        $('#norek1').html(data[0].no_rek);
                        $('#norekid1').html(data[0].rekening_id);
                        $('#norek2').html(data[1].no_rek);
                        $('#norekid2').html(data[1].rekening_id);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function formatCurrencyID1(value) {
                var numericValue = parseFloat(value);
                if (isNaN(numericValue)) {
                    return '';
                }
                return numericValue.toLocaleString('id-ID');
            }

            function formatCurrencyID(value) {
                var numericValue = parseFloat(value);
                if (isNaN(numericValue)) {
                    return '';
                }
                var roundedValue = Math.round(numericValue); // Round the numeric value
                return roundedValue.toLocaleString('id-ID');
            }

            function formatDate(dateTimeString) {
                var dateTime = new Date(dateTimeString);
                var day = ('0' + dateTime.getDate()).slice(-2);
                var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];
                var monthIndex = dateTime.getMonth();
                var year = dateTime.getFullYear();
                return day + ' ' + monthNames[monthIndex] + ' ' + year;
            }

            function formatDate2(dateTimeString) {
                var dateTime = new Date(dateTimeString);
                var day = ('0' + dateTime.getDate()).slice(-2);
                var month = ('0' + (dateTime.getMonth() + 1)).slice(-2);
                var year = dateTime.getFullYear();
                return day + '/' + month + '/' + year;
            }

        });
    </script>
</body>

</html>
