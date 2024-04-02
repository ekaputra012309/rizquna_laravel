<script>
    $(document).ready(function() {
        checkTokenExpiration();
        // Agent modal script
        $('#searchButton').on('click', function() {
            // AJAX call to retrieve data from agent API route
            $.ajax({
                url: '{{ route('agent') }}',
                type: 'GET',
                beforeSend: function(xhr) {
                    // Set the Authorization header with JWT token
                    var jwtToken = localStorage.getItem('jwtToken');
                    xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                },
                success: function(response) {
                    // Populate data into modal table
                    var agentTableBody = $('#agentTable tbody');
                    agentTableBody.empty(); // Clear previous data
                    $.each(response, function(index, agent) {
                        // Append each agent as a row in the table
                        agentTableBody.append(
                            '<tr><td><button class="selectAgentBtn btn btn-primary" data-agent-id="' +
                            agent.id_agent + '" data-agent-name="' + agent
                            .nama_agent +
                            '" data-agent-contact="' + agent.contact_person +
                            '">Pilih</button></td><td>' + agent.nama_agent +
                            '</td><td>' + agent.contact_person + '</td><td>' +
                            agent.telepon + '</td><td>' +
                            agent.alamat + '</td></tr>');
                    });
                    // Show modal
                    $('#agentModal').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).on('click', '.selectAgentBtn', function() {
            // Get agent details from the button's data attributes
            var agentId = $(this).data('agent-id');
            var agentName = $(this).data('agent-name');
            var agentContact = $(this).data('agent-contact');

            // Set agent details in the input field
            $('#agent_id').val(agentId);
            $('#agent_nama').val(agentName + ' - ' + agentContact);

            // Close the modal
            $('#agentModal').modal('hide');
        });

        $('#agentModal').on('shown.bs.modal', function() {
            if (!$.fn.DataTable.isDataTable('#agentTable')) {
                $('#agentTable').DataTable({
                    "searching": true,
                    "ordering": true,
                    "paging": true
                });
            }
        });

        $('#closeModalBtnAgent').click(function() {
            $('#agentModal').modal('hide');
        });
        $('#closeModalBtnAgent1').click(function() {
            $('#agentModal').modal('hide');
        });
    });
</script>
