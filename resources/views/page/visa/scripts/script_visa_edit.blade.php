<script>
    $(document).ready(function() {
        var jwtToken = localStorage.getItem('jwtToken');

        var visaIdBase64 = "{{ $data['idpage'] }}"; // Assuming the visa ID is Base64 encoded
        var visaId = atob(visaIdBase64);
        // Check if JWT token exists
        if (jwtToken) {
            // Send GET request to fetch visa data
            $.ajax({
                url: "{{ route('visa') }}/" + visaId,
                type: 'GET',
                beforeSend: function(xhr) {
                    // Set the Authorization header with JWT token
                    xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                },
                success: function(response) {
                    function formatDate(dateString) {
                        var dateParts = dateString.split(' ')[0].split('-');
                        var year = dateParts[0];
                        var month = dateParts[1];
                        var day = dateParts[2];
                        return year + '-' + month + '-' + day;
                    }
                    var namaAgen = response.agent.nama_agent + ' - ' + response.agent
                        .contact_person;
                    var ttl = response.jumlah_pax * response.harga_pax;
                    $('#tgl_visa').val(formatDate(response.tgl_visa));
                    $('#agent_id').val(response.agent_id);
                    $('#agent_nama').val(namaAgen);
                    $('#tgl_keberangkatan').val(formatDate(response.tgl_keberangkatan));
                    $('#jumlah_pax').val(response.jumlah_pax);
                    $('#harga_pax').val(response.harga_pax);
                    $('#total').val(ttl);
                },

                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                }
            });
        } else {
            // Handle case where JWT token is not found in localStorage
            console.error('JWT token not found in localStorage.');
        }

        $('#visaEditForm').submit(function(event) {
            event.preventDefault();
            if (jwtToken) {
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('visa') }}/" + visaId,
                    type: 'POST',
                    data: formData,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        window.location.href = "{{ url('/pages/visa') }}";
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                console.error('JWT token not found in localStorage.');
            }
        });

        function calculateSubtotal() {
            var harga_pax = parseFloat($('#harga_pax').val());
            var jumlah_pax = parseInt($('#jumlah_pax').val());
            var subtotal = harga_pax * jumlah_pax;
            $('#total').val(subtotal);
        }

        // Event listeners for 'harga_pax', 'jumlah_pax', and 'malam' input fields
        $('#harga_pax, #jumlah_pax').change(function() {
            calculateSubtotal();
        });

        calculateSubtotal();
    });
</script>
