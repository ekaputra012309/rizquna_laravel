<script>
    $(document).ready(function() {
        checkTokenExpiration();
        // user modal script
        $('#searchButton').on('click', function() {
            // AJAX call to retrieve data from user API route
            $.ajax({
                url: '{{ route('user') }}',
                type: 'GET',
                beforeSend: function(xhr) {
                    // Set the Authorization header with JWT token
                    var jwtToken = localStorage.getItem('jwtToken');
                    xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                },
                success: function(response) {
                    // Populate data into modal table
                    var userTableBody = $('#userTable tbody');
                    userTableBody.empty(); // Clear previous data
                    $.each(response, function(index, user) {
                        // Append each user as a row in the table
                        userTableBody.append(
                            '<tr><td><button class="selectuserBtn btn btn-primary" data-user-id="' +
                            user.id + '" data-user-name="' + user
                            .name +
                            '" data-user-email="' + user.email +
                            '">Pilih</button></td><td>' + user.name +
                            '</td><td>' + user.email + '</td></tr>');
                    });
                    // Show modal
                    $('#userModal').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).on('click', '.selectuserBtn', function() {
            // Get user details from the button's data attributes
            var userId = $(this).data('user-id');
            var userName = $(this).data('user-name');
            var useremail = $(this).data('user-email');

            // Set user details in the input field
            $('#user_id').val(userId);
            $('#user_nama').val(userName + ' - ' + useremail);

            // Close the modal
            $('#userModal').modal('hide');
        });

        $('#userModal').on('shown.bs.modal', function() {
            if (!$.fn.DataTable.isDataTable('#userTable')) {
                $('#userTable').DataTable({
                    "searching": true,
                    "ordering": true,
                    "paging": true
                });
            }
        });

        $('#closeModalBtnuser').click(function() {
            $('#userModal').modal('hide');
        });
        $('#closeModalBtnuser1').click(function() {
            $('#userModal').modal('hide');
        });
    });
</script>
