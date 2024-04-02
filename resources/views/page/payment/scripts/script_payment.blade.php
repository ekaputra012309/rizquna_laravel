<script>
    $(document).ready(function() {
        // Function to format date
        function formatDate(dateTimeString) {
            var dateTime = new Date(dateTimeString);
            var day = ('0' + dateTime.getDate()).slice(-2); // Get day and pad with leading zero if needed
            var month = ('0' + (dateTime.getMonth() + 1)).slice(-
                2); // Get month and pad with leading zero if needed
            var year = dateTime.getFullYear(); // Get full year
            return day + '/' + month + '/' + year;
        }

        // Function to construct edit URL
        function constructEditURL(paymentId) {
            var editHref = "{{ route('p.payment.lihat', ['id' => ':id']) }}";
            var paymentIdBase64 = btoa(paymentId);
            return editHref.replace(':id', paymentIdBase64);
        }

        // Function to add rows to the table
        function addRowToTable(payment) {
            var editHref = constructEditURL(payment.id_payment);
            if (payment.booking.status === 'Piutang') {
                statusLabel = 'Piutang';
                buttonColor = 'danger';
            } else {
                statusLabel = 'Lunas';
                buttonColor = 'success';
            }
            var row = '<tr>' +
                '<td><a href="' + editHref +
                '" class="btn btn-light btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="bi bi-search"></i></a> ' +
                '<td>' + payment.id_booking + '</td>' +
                '<td>' + formatDate(payment.booking.tgl_booking) + '</td>' +
                '<td>' + payment.booking.agent.nama_agent + '</td>' +
                '<td>' +
                '<span style="float: left;">' +
                (payment.pilih_konversi === 'USD' ? '$' : '') +
                payment.hasil_konversi +
                '</span>' +
                // Align hasil_konversi to the left
                '<span style="float: right;">' + payment.pilih_konversi +
                '</span>' + // Align pilih_konversi to the right
                '</td>' +
                '<td><button class="btn btn-' + buttonColor + ' btn-sm">' +
                statusLabel + '</button></td>' +
                '</tr>';
            $('#table1 tbody').append(row);
        }

        var token = localStorage.getItem('jwtToken');

        $.ajax({
            url: "{{ route('payment') }}",
            type: "GET",
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(data) {
                $.each(data, function(index, payment) {
                    // console.log(payment);
                    addRowToTable(payment);
                });

                // Initialize DataTable after populating the table
                $('#table1').DataTable({
                    "searching": true,
                    "ordering": true,
                    "paging": true
                });
            }
        });
    });
</script>
