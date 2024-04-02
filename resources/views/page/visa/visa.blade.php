@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Payment Visa</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Payment Visa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-md-flex justify-content-between align-items-center">
                    <div class="w-100">
                        <form id="kursVisa" class="form" method="POST" action="#" data-parsley-validate>
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group mandatory">
                                        <label for="no-inv-column" class="form-label">No Invoice</label>
                                        <input type="text" id="no_inv" class="form-control" placeholder="No Invoice"
                                            data-parsley-required="true" readonly />
                                        <input type="hidden" id="id_visa" name="id_visa" placeholder="id visa">
                                        <input type="hidden" id="hasil_konversi" name="hasil_konversi"
                                            placeholder="konversi">
                                        <input type="hidden" id="total" placeholder="total">
                                        <input type="hidden" value="1" name="status">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mandatory">
                                        <label for="kurs-bsi-column" class="form-label">KURS BSI</label>
                                        <input type="text" id="kurs_bsi" class="form-control" placeholder="0.00"
                                            step="0.01" name="kurs_bsi" data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mandatory">
                                        <label for="kurs-riyal-column" class="form-label">KURS RIYAL</label>
                                        <input type="text" id="kurs_riyal" class="form-control" placeholder="0.00"
                                            step="0.01" name="kurs_riyal" data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mandatory">
                                        <br>
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            <i class="bi bi-save"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="ml-md-3 mt-2 mt-md-0">
                        <a href="{{ route('p.visa.tambah') }}" class="btn btn-primary" style="width: 250px"><i
                                class="bi bi-plus-square"></i> Add
                            Transaction</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Tanggal Invoice</th>
                                <th>Tgl Keberangkatan</th>
                                <th>Agen</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            var token = localStorage.getItem('jwtToken');

            $('#kursVisa').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var formData = $(this).serialize(); // Serialize the form data

                $.ajax({
                    url: "{{ route('kurs') }}",
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    data: formData,
                    success: function(response) {

                        var idVisa = $('#id_visa').val();
                        $('#kursVisa')[0].reset();
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error submitting form:', error);
                    }
                });
            });

            $.ajax({
                url: "{{ route('visa') }}",
                type: "GET",
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                dataType: "json",
                success: function(data) {
                    $('#table1').DataTable({
                        "data": data,
                        "columns": [{
                                "data": null,
                                "render": function(data, type, row) {
                                    var editHref =
                                        "{{ route('p.visa.edit', ['id' => ':id']) }}";
                                    var deleteButtonDisabled = row.status === 'Lunas' ?
                                        'disabled' : '';
                                    var editButtonDisabled = row.status === 'Lunas' ?
                                        'disabled' : '';

                                    var lihatHref =
                                        "{{ route('p.visa.lihat', ['id' => ':id']) }}";
                                    var visaIdBase64 = btoa(row.id_visa);
                                    editHref = editHref.replace(':id', visaIdBase64);
                                    lihatHref = lihatHref.replace(':id', visaIdBase64);

                                    // Conditional rendering for btn-cari based on kurs.status
                                    var cariButton = row.kurs && row.kurs && row
                                        .kurs.status == '1' ? '<a href="' +
                                        lihatHref +
                                        '" class="btn btn-light btn-sm btn-cari" data-idvisa="' +
                                        row.id_visa +
                                        '" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="bi bi-search"></i></a>' :
                                        '';

                                    // Conditional rendering for btn-tambah based on kurs.status
                                    var tambahButton = row.kurs && row.kurs && row
                                        .kurs.status == '1' ? '' :
                                        '<button class="btn btn-light btn-sm btn-tambah" data-id="' +
                                        row.visa_id +
                                        '" data-idvisa="' +
                                        row.id_visa +
                                        '" data-total="' +
                                        row.total +
                                        '" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah"><i class="bi bi-plus-circle"></i></button>';

                                    var editButtonHtml = '<a href="' + editHref +
                                        '" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" ' +
                                        editButtonDisabled;
                                    if (editButtonDisabled) {
                                        editButtonHtml +=
                                            ' onclick="return false;"'; // Disable link click
                                    }
                                    editButtonHtml +=
                                        '><i class="bi bi-pencil-square"></i></a>';

                                    return cariButton + tambahButton +
                                        ' ' + editButtonHtml +
                                        ' <button class="btn btn-danger btn-sm delete-btn" data-id="' +
                                        row.id_visa +
                                        '" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus" ' +
                                        deleteButtonDisabled +
                                        '><i class="bi bi-trash"></i></button>';
                                }
                            },
                            {
                                "data": "visa_id"
                            },
                            {
                                "data": "tgl_visa",
                                "render": function(data, type, row) {
                                    return formatDate(
                                        data); // Use formatDate function to format date
                                }
                            },
                            {
                                "data": "tgl_keberangkatan",
                                "render": function(data, type, row) {
                                    return formatDate(
                                        data); // Use formatDate function to format date
                                }
                            },
                            {
                                "data": "agent.nama_agent"
                            },
                            {
                                "data": "total",
                                "render": function(data, type, row) {
                                    return '$ ' + formatCurrencyID1(data);
                                }
                            },
                            {
                                "data": "status",
                                "render": function(data, type, row) {
                                    var buttonColor = data === 'Piutang' ? 'danger' :
                                        'success';
                                    var statusLabel = data === 'Piutang' ? 'Piutang' :
                                        'Lunas';
                                    return '<button class="btn btn-' + buttonColor +
                                        ' btn-sm">' + statusLabel + '</button>';
                                }
                            },
                        ]
                    });

                    // Add click event listener to delete buttons
                    $('#table1').on('click', '.delete-btn', function() {
                        var visaId = $(this).data('id');
                        if (confirm('Are you sure you want to delete this visa?')) {
                            // Perform deletion using AJAX
                            $.ajax({
                                url: "{{ route('visa') }}/" + visaId,
                                type: "DELETE",
                                headers: {
                                    'Authorization': 'Bearer ' + token
                                },
                                success: function(response) {
                                    location.reload();
                                },
                                error: function(xhr, status, error) {
                                    alert(
                                        'An error occurred while deleting the visa.'
                                    );
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });

                    $('#table1').on('click', '.btn-tambah', function() {
                        var NoInv = $(this).data('id');
                        var visaId = $(this).data('idvisa');
                        var stotal = $(this).data('total');
                        $('#no_inv').val(NoInv);
                        $('#id_visa').val(visaId);
                        $('#total').val(stotal);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching visa data:', error);
                }
            });

            function formatDate(dateString) {
                // Parse datetime string to Date object
                var date = new Date(dateString);
                // Get date components
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                // Format date as "DD/MM/YYYY"
                var formattedDate = (day < 10 ? '0' : '') + day + '/' + (month < 10 ? '0' : '') + month + '/' +
                    year;
                return formattedDate;
            }

            function formatCurrencyID1(value) {
                var numericValue = parseFloat(value);
                if (isNaN(numericValue)) {
                    return '';
                }
                var roundedValue = Math.round(numericValue); // Round the numeric value
                return roundedValue.toLocaleString('id-ID');
            }

            $('#kurs_bsi').on('keyup', function() {
                var kurs_bsi = parseFloat($(this).val());
                var tagihan_awal = parseFloat($('#total').val());
                var tagihan = tagihan_awal * kurs_bsi;
                $('#hasil_konversi').val(tagihan);
            });
        });
    </script>
@endsection
