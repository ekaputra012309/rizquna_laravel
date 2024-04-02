<script>
    $(document).ready(function() {
        checkTokenExpiration();
        var jwtToken = localStorage.getItem('jwtToken');

        // Handle visa form submission
        $('#visaForm').submit(function(event) {
            event.preventDefault();
            if (jwtToken) {
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('visa') }}",
                    type: 'POST',
                    data: formData,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        window.location.href = "{{ route('p.visa') }}";
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
