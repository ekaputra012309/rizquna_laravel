<script>
    $(document).ready(function() {
        var dataTable = $('#table1').DataTable({
            "searching": false,
            "ordering": true,
            "paging": true,
            "columns": [{
                    "data": "agent.nama_agent"
                },
                {
                    "data": "booking_id"
                },
                {
                    "data": "tgl_booking",
                    "render": function(data, type, row) {
                        // Convert datetime string to Date object
                        var dateTime = new Date(data);
                        // Extract date portion (YYYY-MM-DD)
                        var date = formatDate(dateTime);
                        return date;
                    }
                },
                { // Representing the merged "Total" column
                    "data": function(row, type, set, meta) {
                        return formatCurrencyID(row.total_subtotal) + ' ' + row
                            .mata_uang; // Concatenate subtotal and mata_uang
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        var statusLabel = (row.status === 'Piutang') ? 'danger' : 'success';
                        return '<button class="btn btn-' + statusLabel + ' btn-sm">' + row
                            .status + '</button>';
                    }
                }
            ],
            dom: 'Bfrtip', // Add buttons to the DataTable
            buttons: [{
                extend: 'print',
                customize: function(win) {
                    var fromDate = $('#tgl_from').val();
                    var toDate = $('#tgl_to').val();
                    if (fromDate && toDate) {
                        fromDate = formatDate(new Date(fromDate));
                        toDate = formatDate(new Date(toDate));
                        var dateRange = fromDate + ' s/d ' + toDate;
                    } else {
                        var dateRange = '';
                    }
                    $(win.document.body).find('h1').text('Laporan Agent');
                    if (dateRange) {
                        $(win.document.body).find('h1').after('<p>' + dateRange + '</p>');
                    }
                }
            }],
            columnDefs: [{
                targets: 3, // Targeting the fourth column (index 3)
                className: 'dt-right' // Apply the class for right alignment
            }]
        });

        $('#reportAgentForm').submit(function(event) {
            // Prevent the form from submitting normally
            event.preventDefault();

            // Get the form data
            var formData = {
                'tgl_from': $('#tgl_from').val(),
                'tgl_to': $('#tgl_to').val(),
                'agent_id': $('#agent_id').val()
            };

            var token = localStorage.getItem('jwtToken');

            // Submit the form data via AJAX
            $.ajax({
                url: "{{ route('booking') }}",
                type: "GET",
                data: formData,
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function(data) {
                    // Clear existing data and populate the DataTable
                    dataTable.clear().rows.add(data).draw();
                },
                error: function(xhr, status, error) {
                    // Your error callback code here
                    console.error(xhr.responseText);
                }
            });
        });

        // Add event listener to the "Reset" button
        $('#reportAgentForm').on('reset', function() {
            // Clear the form fields
            $(this).find('input[type="date"]').val('');
            $(this).find('input[type="hidden"]').val('');
            $(this).find('input[type="text"]').val('');

            // Clear the DataTable data
            dataTable.clear().draw();
        });

        function formatDate(date) {
            var months = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();

            return day + ' ' + months[monthIndex] + ' ' + year;
        }

        function formatCurrencyID(value) {
            var numericValue = parseFloat(value);
            if (isNaN(numericValue)) {
                return '';
            }
            var roundedValue = Math.round(numericValue); // Round the numeric value
            return roundedValue.toLocaleString('id-ID');
        }
    });
</script>
