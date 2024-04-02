<script>
    $(document).ready(function() {
        // Function to check token expiration
        checkTokenExpiration();

        // Click event handler for printing payment
        $('#cetakPembayaran').on('click', function() {
            var selectedBank = $('#bankSelect').val();
            console.log(selectedBank);
            printPayment(selectedBank);
        });

        // Click event handler for adding detail pembayaran
        $('#addDetailPembayaran').on('click', function() {
            $('#detailPembayaranModal').modal('show');
            $('#deposit').focus();
        });

        // Retrieve JWT token from localStorage
        var jwtToken = localStorage.getItem('jwtToken');

        // Fetch payment data
        fetchPaymentData(jwtToken);

        // Submit event handler for detail pembayaran form
        $('#detailPembayaranForm').submit(function(event) {
            event.preventDefault();
            submitDetailPembayaranForm(jwtToken);
        });

        // Retrieve booking details and populate table
        fetchBookingDetails(jwtToken);

        // Function to format currency ID
        function formatCurrencyID(value) {
            var numericValue = parseFloat(value);
            if (isNaN(numericValue)) {
                return '';
            }
            return numericValue.toLocaleString('id-ID');
        }

        function formatCurrencyID1(value) {
            var numericValue = parseFloat(value);
            if (isNaN(numericValue)) {
                return '';
            }
            var roundedValue = Math.round(numericValue); // Round the numeric value
            return roundedValue.toLocaleString('id-ID');
        }


        function printPayment(selectedBank) {
            var id = '{{ $data['idpage'] }}';
            var url = "{{ route('p.payment.cetak', ['id' => ':id', 'bank' => '']) }}";
            url = url.replace(':id', id) + '&bank=' + selectedBank;

            // Open the URL in a new tab
            window.open(url, '_blank');
        }

        // Function to refresh table with pembayaran data
        refreshTable();

        function refreshTable() {
            var id = "{{ $data['idpage'] }}";
            var idpay = atob(id);
            $.ajax({
                url: "{{ route('payment_d_inv', ['id' => ':id']) }}".replace(':id', idpay),
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                },
                success: function(response) {
                    if (response.length > 0) {
                        $('#listPembayaran tbody').empty();
                        var totalDeposit = 0;

                        $.each(response, function(index, pembayaran) {
                            var tagihan = $('#kanan').val();
                            // console.log('tagihan: ' + tagihan);
                            var formattedPaymentDate = formatDate(pembayaran.tgl_payment);
                            var formattedDeposit = formatCurrencyID(pembayaran.deposit);

                            // Append the row to the table
                            var row =
                                '<tr>' +
                                '<td><button class="btn btn-danger btn-sm delete-btn" data-id="' +
                                pembayaran.id_payment_detail +
                                '" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="bi bi-trash"></i></button></td>' +
                                '<td>' + formattedPaymentDate + '</td>' +
                                '<td>' + formattedDeposit + '</td>' +
                                '<td>' + pembayaran.metode_bayar + '</td>' +
                                '</tr>';
                            $('#listPembayaran tbody').append(row);

                            // Accumulate deposit amount
                            totalDeposit += parseFloat(pembayaran.deposit);
                        });

                        // Calculate remaining balance
                        var tagihan = parseFloat($('#kanan').val());
                        var sisa_tagihan = tagihan - totalDeposit;
                        console.log('Sisa Tagihan: ' + sisa_tagihan);
                        $('#bawah').html(formatCurrencyID1(sisa_tagihan));
                        var bookingId = $('#booking_id').val();
                        var idWithHyphens = bookingId.replace(/\//g, '-');
                        // console.log(idWithHyphens);
                        // disable button add pembayaran
                        if (sisa_tagihan === 0) {
                            $('#addDetailPembayaran').prop('disabled',
                                true);
                            $.ajax({
                                url: "{{ route('booking_up', ['id' => ':id', 'status' => 'Lunas']) }}"
                                    .replace(
                                        ':id', idWithHyphens),
                                type: 'POST',
                                headers: {
                                    'Authorization': 'Bearer ' + jwtToken
                                },
                                success: function(response) {
                                    // console.log(response);
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error updating status:', error);
                                }
                            });
                        } else {
                            $.ajax({
                                url: "{{ route('booking_up', ['id' => ':id', 'status' => 'Piutang']) }}"
                                    .replace(':id', idWithHyphens),
                                type: 'POST',
                                headers: {
                                    'Authorization': 'Bearer ' + jwtToken
                                },
                                success: function(response) {
                                    // console.log(response);
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error updating status:', error);
                                }
                            });
                        }

                        $('.delete-btn').click(function() {
                            var paymentId = $(this).data('id');
                            if (confirm('Are you sure you want to delete this payment?')) {
                                $.ajax({
                                    url: "{{ route('payment_d') }}/" + paymentId,
                                    type: "DELETE",
                                    headers: {
                                        'Authorization': 'Bearer ' + jwtToken
                                    },
                                    success: function(response) {
                                        location.reload();
                                    },
                                    error: function(xhr, status, error) {
                                        alert(
                                            'An error occurred while deleting the pemesanan.'
                                        );
                                        console.error(xhr.responseText);
                                    }
                                });
                            }
                        });
                    } else {
                        showNoDataMessage();
                    }

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Function to show "No data" message
        function showNoDataMessage() {
            $('#listPembayaran tbody').html(
                '<tr><td colspan="4" style="text-align:center">No data record</td></tr>'
            );
        }

        // Function to fetch payment data
        function fetchPaymentData(jwtToken) {
            var paymentIdBase64 = "{{ $data['idpage'] }}"; // Assuming the payment ID is Base64 encoded
            var paymentId = atob(paymentIdBase64);
            if (jwtToken) {
                $.ajax({
                    url: "{{ route('payment') }}/" + paymentId,
                    type: 'GET',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        var namaAgen = response.booking.agent.nama_agent + ' - ' + response.booking
                            .agent
                            .contact_person;
                        var namaHotel = response.booking.hotel.nama_hotel + ' - ' + response.booking
                            .hotel
                            .contact_person;
                        var simbol = (response.pilih_konversi === 'USD' ? '$' : '');
                        $('#tgl_booking').val(formatDate2(response.booking.tgl_booking));
                        $('#agent_id').val(response.booking.agent_id);
                        $('#agent_nama').val(namaAgen);
                        $('#namahotel').html(namaHotel);
                        $('#checkin').html(formatDate3(response.booking.check_in));
                        $('#checkout').html(formatDate3(response.booking.check_out));
                        $('#keterangan').val(response.booking.keterangan);
                        $('#atas').html(response.pilih_konversi);
                        $('#kiri').html(simbol);
                        $('#bawah').html(formatCurrencyID1(response.hasil_konversi));
                        $('#kanan').val(response.hasil_konversi);
                        refreshTable();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                console.error('JWT token not found in localStorage.');
            }
        }

        // Function to fetch booking details
        function fetchBookingDetails(jwtToken) {
            var id = '{{ $data['autoId'] }}';
            var idWithHyphens = id.replace(/\//g, '-');
            $.ajax({
                url: "{{ route('booking_d_inv', ['id' => ':id']) }}".replace(':id', idWithHyphens),
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                },
                success: function(response) {
                    if (response.length > 0) {
                        populateTable(response);
                    } else {
                        showNoDataMessage();
                    }
                },
                error: function(xhr, status, error) {
                    handleAjaxError();
                }
            });
        }

        function submitDetailPembayaranForm(token) {
            if (jwtToken) {
                var formData = $('#detailPembayaranForm').serialize();
                // Send POST request with AJAX
                $.ajax({
                    url: "{{ route('payment_d') }}",
                    type: 'POST',
                    data: formData,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        $('#detailPembayaranModal').modal('hide');
                        $('#detailPembayaranForm')[0].reset();
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                console.error('JWT token not found in localStorage.');
            }
        }

        // Function to populate table with booking details
        function populateTable(data) {
            var totalDiscount = 0;
            var totalSubtotal = 0;
            var tableBody = $('#detailPesananTable tbody');
            tableBody.empty(); // Clear previous data

            $.each(data, function(index, detail) {
                totalDiscount += parseFloat(detail.discount);
                totalSubtotal += parseFloat(detail.subtotal);

                var formattedCheckInDate = formatDate(detail.check_in);
                var formattedCheckOutDate = formatDate(detail.check_out);
                var row = '<tr>' +
                    '<td>' + detail.room.keterangan + '</td>' +
                    '<td>' + detail.qty + '</td>' +
                    '<td>' + detail.malam + '</td>' +
                    '<td>' + detail.tarif + '</td>' +
                    '<td>' + formatCurrencyID(detail.discount) + '</td>' +
                    '<td>' + formatCurrencyID(detail.subtotal) + '</td>' +
                    '</tr>';
                tableBody.append(row);
            });

            $('#total_discount').val(totalDiscount.toFixed(2));
            $('#total_subtotal').val(formatCurrencyID(totalSubtotal));

        }

        // Function to handle AJAX errors
        function handleAjaxError() {
            // Handle errors here, e.g., display an error message
            $('#detailPesananTable tbody').html(
                '<tr><td colspan="10" style="text-align:center">An error occurred while retrieving data</td></tr>'
            );
        }

        function formatDate(dateTimeString) {
            var dateTime = new Date(dateTimeString);
            var day = ('0' + dateTime.getDate()).slice(-2);
            var month = ('0' + (dateTime.getMonth() + 1)).slice(-2);
            var year = dateTime.getFullYear();
            return day + '/' + month + '/' + year;
        }

        function formatDate2(dateTimeString) {
            var dateTime = new Date(dateTimeString);
            var day = ('0' + dateTime.getDate()).slice(-2);
            var month = ('0' + (dateTime.getMonth() + 1)).slice(-2);
            var year = dateTime.getFullYear();
            return year + '-' + month + '-' + day;
        }

        function formatDate3(dateTimeString) {
            var dateTime = new Date(dateTimeString);
            var day = ('0' + dateTime.getDate()).slice(-2);
            var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            var monthIndex = dateTime.getMonth();
            var year = dateTime.getFullYear();
            return day + ' ' + monthNames[monthIndex] + ' ' + year;
        }

        $('#metode_bayar_toggle').change(function() {
            var hiddenInput = $('#metode_bayar');
            hiddenInput.val($(this).prop('checked') ? 'Kredit' : 'Tunai');
        });

        $('#closeModalBtnPayment').click(function() {
            $('#detailPembayaranModal').modal('hide');
        });
        $('#closeModalBtnPayment1').click(function() {
            $('#detailPembayaranModal').modal('hide');
        });

    });
</script>
