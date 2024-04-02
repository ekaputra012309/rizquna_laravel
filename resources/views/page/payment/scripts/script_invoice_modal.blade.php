<script>
    $(document).ready(function() {
        // Retrieve JWT token from localStorage
        var jwtToken = localStorage.getItem('jwtToken');

        // Function to fetch invoice data and populate modal
        $('#searchInv').on('click', function() {
            fetchInvoiceData();
        });

        // Function to handle click on select invoice button
        $(document).on('click', '.selectinvoiceBtn', function() {
            handleSelectInvoice($(this));
        });

        // Function to initialize DataTable for invoice modal table
        $('#invoiceModal').on('shown.bs.modal', function() {
            initializeInvoiceTable();
        });

        // Event listener for currency conversion selection
        $('#pilih_konversi').change(function() {
            $('#hasil').html($(this).val());
            konversiHasil();
        });

        // Function to handle closing invoice modal
        $('#closeModalBtninvoice, #closeModalBtninvoice1').click(function() {
            $('#invoiceModal').modal('hide');
        });

        // Form submit event handler for payment
        $('#paymentForm').submit(function(event) {
            event.preventDefault();
            submitPaymentForm(jwtToken);
        });

        // Function to fetch invoice data and populate modal
        function fetchInvoiceData() {
            $.ajax({
                url: '{{ route('booking_notin') }}',
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                },
                success: function(response) {
                    populateInvoiceModal(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Function to populate invoice modal with data
        function populateInvoiceModal(response) {
            var invoiceTableBody = $('#invoiceTable tbody');
            invoiceTableBody.empty();
            $.each(response, function(index, invoice) {
                invoiceTableBody.append(
                    '<tr><td><button class="selectinvoiceBtn btn btn-primary" data-invoice-id="' +
                    invoice.booking_id + '" data-mata-uang="' + invoice
                    .mata_uang + '" data-subtotal="' + invoice
                    .total_subtotal +
                    '">Pilih</button></td><td>' + invoice.booking_id +
                    '</td><td>' + formatDate(invoice.tgl_booking) + '</td><td>' +
                    invoice.agent.nama_agent + '</td><td>' +
                    invoice.total_subtotal + '</td></tr>'
                );
            });
            $('#invoiceModal').modal('show');
        }

        // Function to handle click on select invoice button
        function handleSelectInvoice(btn) {
            var invoiceId = btn.data('invoice-id');
            var mataUang = btn.data('mata-uang');
            var subTotal = btn.data('subtotal');

            $('#id_booking').val(invoiceId);
            $('#inv_number').val(invoiceId);
            $('#mata_uang').val(mataUang);
            $('#dari').html(mataUang);
            $('#subtotal').val(subTotal);
            $('#subtotal1').val(formatCurrencyID(subTotal));

            $('#invoiceModal').modal('hide');
        }

        // Function to initialize DataTable for invoice modal table
        function initializeInvoiceTable() {
            if (!$.fn.DataTable.isDataTable('#invoiceTable')) {
                $('#invoiceTable').DataTable({
                    "searching": true,
                    "ordering": true,
                    "paging": true
                });
            }
        }

        // Function to handle currency conversion
        function konversiHasil() {
            var pilihkonversi = $('#pilih_konversi').val();
            var mata_uang = $('#mata_uang').val();
            var sar_idr = $('#sar_idr').val();
            var sar_usd = $('#sar_usd').val();
            var usd_idr = $('#usd_idr').val();
            var tarif = parseFloat($('#subtotal').val());
            var hasilKonversi = 0;

            if (pilihkonversi == 'SAR' && mata_uang == 'SAR') {
                hasilKonversi = tarif;
            } else if (pilihkonversi == 'USD' && mata_uang == 'SAR') {
                hasilKonversi = tarif / sar_usd;
            } else if (pilihkonversi == 'IDR' && mata_uang == 'SAR') {
                hasilKonversi = (tarif / sar_usd) * usd_idr;
            } else if (pilihkonversi == 'USD' && mata_uang == 'USD') {
                hasilKonversi = tarif;
            } else if (pilihkonversi == 'IDR' && mata_uang == 'USD') {
                hasilKonversi = tarif * usd_idr;
            }

            $('#hasil_konversi').val(hasilKonversi.toFixed(0));
            $('#hasil_konversi1').val(formatCurrencyID(hasilKonversi));
        }


        // Function to handle payment form submission
        function submitPaymentForm(token) {
            if (token) {
                var formData = $('#paymentForm').serialize();
                $.ajax({
                    url: "{{ route('payment') }}",
                    type: 'POST',
                    data: formData,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                    },
                    success: function(response) {
                        $('#paymentForm')[0].reset();
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

        function formatCurrencyID(value) {
            var numericValue = parseFloat(value);
            if (isNaN(numericValue)) {
                return '';
            }
            return numericValue.toLocaleString('id-ID');
        }

        function formatDate(dateTimeString) {
            var dateTime = new Date(dateTimeString);
            var day = ('0' + dateTime.getDate()).slice(-2);
            var month = ('0' + (dateTime.getMonth() + 1)).slice(-2);
            var year = dateTime.getFullYear();
            return day + '/' + month + '/' + year;
        }
    });
</script>
