<script>
    $(document).ready(function() {
        checkTokenExpiration();
        var jwtToken = localStorage.getItem('jwtToken');
        $('#searchButtonHotel').on('click', function() {
            // AJAX call to retrieve data from hotel API route
            $.ajax({
                url: '{{ route('hotel') }}',
                type: 'GET',
                beforeSend: function(xhr) {
                    // Set the Authorization header with JWT token
                    xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                },
                success: function(response) {
                    // Populate data into modal table
                    var hotelTableBody = $('#hotelTable tbody');
                    hotelTableBody.empty(); // Clear previous data
                    $.each(response, function(index, hotel) {
                        // Append each hotel as a row in the table
                        hotelTableBody.append(
                            '<tr><td><button class="selecthotelBtn btn btn-primary" data-hotel-id="' +
                            hotel.id_hotel + '" data-hotel-name="' + hotel
                            .nama_hotel +
                            '" data-hotel-contact="' + hotel.contact_person +
                            '">Pilih</button></td><td>' + hotel.nama_hotel +
                            '</td><td>' + hotel.contact_person + '</td><td>' +
                            hotel.telepon + '</td><td>' +
                            hotel.alamat + '</td></tr>');
                    });
                    // Show modal
                    $('#hotelSearchModal').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).on('click', '.selecthotelBtn', function() {
            // Get hotel details from the button's data attributes
            var hotelId = $(this).data('hotel-id');
            var hotelName = $(this).data('hotel-name');
            var hotelContact = $(this).data('hotel-contact');

            // Set hotel details in the input field
            $('#hotel_id').val(hotelId);
            $('#hotel_nama').val(hotelName + ' - ' + hotelContact);

            // Close the modal
            $('#hotelSearchModal').modal('hide');
        });

        $('#hotelSearchModal').on('shown.bs.modal', function() {
            if (!$.fn.DataTable.isDataTable('#hotelTable')) {
                $('#hotelTable').DataTable({
                    "searching": true,
                    "ordering": true,
                    "paging": true
                });
            }
        });

        $('#closeModalBtnHotel').click(function() {
            $('#hotelSearchModal').modal('hide');
        });
        $('#closeModalBtnHotel1').click(function() {
            $('#hotelSearchModal').modal('hide');
        });
    });
</script>
