<script>
    $(document).ready(function() {
        checkTokenExpiration();
        var jwtToken = localStorage.getItem('jwtToken');

        // Show the detail pemesanan modal and reset the form
        $('#addDetailButton').on('click', function() {
            if (!$('#malam').val()) {
                alert("Mohon input data check in dan check out terlebih dahulu");
            } else {
                $('#check_in_m').val($('#check_in').val());
                $('#check_out_m').val($('#check_out').val());
                $('#mata_uang_m').val($('#mata_uang').val());
                calculateNights();
                $('#detailPemesananModal').modal('show');
            }
        });

        // Form submission for detail pemesanan
        $('#detailPemesananForm').submit(function(event) {
            event.preventDefault();
            if (jwtToken) {
                var formData = $(this).serialize();
                // Send POST request with AJAX
                $.ajax({
                    url: "{{ route('booking_d') }}",
                    type: 'POST',
                    data: formData,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        $('#detailPemesananForm')[0].reset();
                        $('#detailPemesananModal').modal('hide');
                        refreshTable();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                console.error('JWT token not found in localStorage.');
            }
        });

        // Additional actions when the modal is shown
        $('#detailPemesananModal').on('shown.bs.modal', function() {
            // Additional actions to perform when the modal is shown
        });

        // Function to populate room dropdown
        function populateRoomDropdown() {
            $.ajax({
                url: "{{ route('room') }}",
                type: "GET",
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                },
                success: function(response) {
                    var dropdown = $('#room_id');
                    dropdown.empty();
                    $.each(response, function(index, room) {
                        dropdown.append('<option value="' + room.id_kamar + '">' + room
                            .keterangan + '</option>');
                    });
                    dropdown.prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        populateRoomDropdown();

        // Function to calculate nights
        function calculateNights() {
            var checkInDate = new Date($('#check_in').val());
            var checkOutDate = new Date($('#check_out').val());
            var timeDifference = checkOutDate.getTime() - checkInDate.getTime();
            var nights = Math.ceil(timeDifference / (1000 * 3600 * 24));
            $('#malam').val(nights);
            $('#malam1').val(nights);
        }

        // Event listener for 'check_in' and 'check_out' input fields
        $('#check_in, #check_out').change(function() {
            calculateNights();
        });

        calculateNights(); // Initial calculation

        // Function to calculate subtotal
        function calculateSubtotal() {
            var tarif = parseFloat($('#tarif').val());
            var qty = parseInt($('#qty').val());
            var malam = parseInt($('#malam').val());
            var subtotal = (tarif * qty) * malam;
            $('#subtotal').val(subtotal);
        }

        // Event listeners for 'tarif', 'qty', and 'malam' input fields
        $('#tarif, #qty, #malam').change(function() {
            calculateSubtotal();
        });

        calculateSubtotal(); // Initial calculation

        // Function to refresh table
        function refreshTable() {
            var id = '{{ $data['autoId'] }}';
            var idWithHyphens = id.replace(/\//g, '-');

            $.ajax({
                url: "{{ route('booking_d_inv', ['id' => ':id']) }}".replace(':id', idWithHyphens),
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                },
                success: function(response) {
                    $('#detailPesananTable tbody').empty();
                    $.each(response, function(index, detail) {
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
                        $('#detailPesananTable tbody').append(row);
                    });
                    $('.delete-btn').click(function() {
                        var bookingId = $(this).data('id');
                        $.ajax({
                            url: "{{ route('booking_d') }}/" + bookingId,
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
                    });
                    calculateTotal();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        refreshTable(); // Initial table refresh

        // Function to calculate total discount and subtotal
        function calculateTotal() {
            var totalDiscount = 0;
            var totalSubtotal = 0;
            $('#detailPesananTable tbody tr').each(function() {
                totalDiscount += parseFloat($(this).find('td:eq(5)').text());
                totalSubtotal += parseFloat($(this).find('td:eq(6)').text());
            });
            $('#total_discount').val(totalDiscount.toFixed(2));
            $('#total_subtotal').val(totalSubtotal.toFixed(2));
        }

        // Function to format date
        function formatDate(dateTimeString) {
            var dateTime = new Date(dateTimeString);
            var day = ('0' + dateTime.getDate()).slice(-2);
            var month = ('0' + (dateTime.getMonth() + 1)).slice(-2);
            var year = dateTime.getFullYear();
            return day + '/' + month + '/' + year;
        }

        $('#closeModalBtnBooking').click(function() {
            $('#detailPemesananForm')[0].reset();
            $('#detailPemesananModal').modal('hide');
        });
        $('#closeModalBtnBooking1').click(function() {
            $('#detailPemesananForm')[0].reset();
            $('#detailPemesananModal').modal('hide');
        });
    });
</script>
