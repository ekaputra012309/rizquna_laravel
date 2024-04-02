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
        });

        // Retrieve JWT token from localStorage
        var jwtToken = localStorage.getItem('jwtToken');


        // Fetch payment data
        fetchvisaData(jwtToken);

        // Submit event handler for detail pembayaran form
        $('#detailPembayaranForm').submit(function(event) {
            event.preventDefault();
            submitDetailPembayaranForm(jwtToken);
        });

        function printPayment(selectedBank) {
            var id = '{{ $data['idpage'] }}';
            var url = "{{ route('p.visa.cetak', ['id' => ':id', 'bank' => '']) }}";
            url = url.replace(':id', id) + '&bank=' + selectedBank;

            // Open the URL in a new tab
            window.open(url, '_blank');
        }

        // Function to fetch visa data
        function fetchvisaData(jwtToken) {
            var visaIdBase64 = "{{ $data['idpage'] }}"; // Assuming the visa ID is Base64 encoded
            var visaId = atob(visaIdBase64);
            if (jwtToken) {
                $.ajax({
                    url: "{{ route('visa') }}/" + visaId,
                    type: 'GET',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        var namaAgen = response.agent.nama_agent + ' - ' + response.agent
                            .contact_person;
                        $('#tgl_visa').val(formatDate2(response.tgl_visa));
                        $('#agent_id').val(response.agent_id);
                        $('#agent_nama').val(namaAgen);
                        $('#kiri').html('');
                        $('#atas').html('IDR');
                        $('#bawah').html(formatCurrencyID1(response.kurs.hasil_konversi));
                        $('#kanan').val(response.kurs.hasil_konversi);

                        const data = response;
                        const formattedDate = formatDate3(data.tgl_keberangkatan);
                        const tbody = $("#detailPesananTable tbody");
                        const newRow = $("<tr>");
                        newRow.html(`
                            <td>${formattedDate}</td>
                            <td>${formatCurrencyID1(data.jumlah_pax)}</td>
                            <td>${formatCurrencyID1(data.harga_pax)}</td>
                            <td>${formatCurrencyID1(data.total)}</td>
                        `);
                        tbody.append(newRow);
                        $('#total_subtotal').val(formatCurrencyID(data.total));
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

        function submitDetailPembayaranForm(token) {
            if (jwtToken) {
                var formData = $('#detailPembayaranForm').serialize();
                // Send POST request with AJAX
                $.ajax({
                    url: "{{ route('visa_d') }}",
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

        function refreshTable() {
            var id = "{{ $data['idpage'] }}";
            var idpay = atob(id);
            $.ajax({
                url: "{{ route('visa_d_inv', ['id' => ':id']) }}".replace(':id', idpay),
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
                            // $('#1kanan').val(tagihan)
                            // console.log('tagihan: ' + tagihan);
                            var formattedPaymentDate = formatDate(pembayaran
                                .tgl_payment_visa);
                            var formattedDeposit = formatCurrencyID(pembayaran.deposit);

                            // Append the row to the table
                            var row =
                                '<tr>' +
                                '<td><button class="btn btn-danger btn-sm delete-btn" data-id="' +
                                pembayaran.id_visa_detail +
                                '" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="bi bi-trash"></i></button></td>' +
                                '<td>' + formattedPaymentDate + '</td>' +
                                '<td>' + formattedDeposit + '</td>' +
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
                        var id = "{{ $data['idpage'] }}";
                        var visaId = atob(id);
                        if (sisa_tagihan === 0) {
                            $('#addDetailPembayaran').prop('disabled',
                                true);
                            $.ajax({
                                url: "{{ route('visa_up', ['id' => ':id', 'status' => 'Lunas']) }}"
                                    .replace(
                                        ':id', visaId),
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
                                url: "{{ route('visa_up', ['id' => ':id', 'status' => 'Piutang']) }}"
                                    .replace(':id', visaId),
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
                            var visaId = $(this).data('id');
                            if (confirm('Are you sure you want to delete this visa?')) {
                                $.ajax({
                                    url: "{{ route('visa_d') }}/" + visaId,
                                    type: "DELETE",
                                    headers: {
                                        'Authorization': 'Bearer ' + jwtToken
                                    },
                                    success: function(response) {
                                        location.reload();
                                        $('#addDetailPembayaran').prop(
                                            'disabled',
                                            false);
                                        // upStatusPiutang();
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
                '<tr><td colspan="3" style="text-align:center">No data record</td></tr>'
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

        $('#closeModalBtnPayment').click(function() {
            $('#detailPembayaranModal').modal('hide');
            $('#detailPembayaranForm')[0].reset();
        });
        $('#closeModalBtnPayment1').click(function() {
            $('#detailPembayaranModal').modal('hide');
            $('#detailPembayaranForm')[0].reset();
        });

        $('#kurs_bsi').on('keyup', function() {
            var kurs_bsi = parseFloat($(this).val());
            var tagihan_awal = $('#kanan').val();
            var tagihan = tagihan_awal * kurs_bsi;
            $('#tagihan').val(tagihan);
            $('#1kanan').val(tagihan);
        });

    });
</script>
