<script>
    $(document).ready(function() {
        checkTokenExpiration();
        var jwtToken = localStorage.getItem('jwtToken');

        // Handle booking form submission
        $('#bookingForm').submit(function(event) {
            event.preventDefault();
            if (jwtToken) {
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('booking') }}",
                    type: 'POST',
                    data: formData,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        window.location.href = "{{ route('p.booking') }}";
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                console.error('JWT token not found in localStorage.');
            }
        });

        // Retrieve booking details and populate table
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
                    '<td>' +
                    '<button class="btn btn-danger btn-sm delete-btn" data-id="' +
                    detail.id_booking_detail +
                    '" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="bi bi-trash"></i></button>' +
                    '</td>' +
                    '<td>' + detail.room.keterangan + '</td>' +
                    '<td>' + detail.qty + '</td>' +
                    '<td>' + detail.malam + '</td>' +
                    '<td>' + detail.tarif + '</td>' +
                    '<td>' + detail.discount + '</td>' +
                    '<td>' + detail.subtotal + '</td>' +
                    '</tr>';
                tableBody.append(row);
            });

            $('#total_discount').val(totalDiscount.toFixed(2));
            $('#total_subtotal').val(totalSubtotal.toFixed(2));

            $('.delete-btn').click(function() {
                var bookingId = $(this).data('id');
                deleteBooking(bookingId);
            });
        }

        // Function to display "No data" message
        function showNoDataMessage() {
            $('#detailPesananTable tbody').html(
                '<tr><td colspan="7" style="text-align:center">No data record</td></tr>'
            );
        }

        // Function to handle AJAX errors
        function handleAjaxError() {
            // Handle errors here, e.g., display an error message
            $('#detailPesananTable tbody').html(
                '<tr><td colspan="7" style="text-align:center">An error occurred while retrieving data</td></tr>'
            );
        }

        // Function to delete a booking detail
        function deleteBooking(bookingId) {
            $.ajax({
                url: "{{ route('booking_d') }}/" + bookingId,
                type: "DELETE",
                headers: {
                    'Authorization': 'Bearer ' + jwtToken
                },
                success: function(response) {
                    location.reload(); // Reload the page after deletion
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while deleting the pemesanan.');
                    console.error(xhr.responseText);
                }
            });
        }

        // Function to format date
        function formatDate(dateTimeString) {
            var dateTime = new Date(dateTimeString);
            var day = ('0' + dateTime.getDate()).slice(-2);
            var month = ('0' + (dateTime.getMonth() + 1)).slice(-2);
            var year = dateTime.getFullYear();
            return day + '/' + month + '/' + year;
        }
    });
</script>
