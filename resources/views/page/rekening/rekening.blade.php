@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Rekening</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Rekening</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0"> </h5>
                        <div>
                            <a href="{{ route('p.rekening.tambah') }}" class="btn btn-primary btn-sm"><i
                                    class="bi bi-plus-square"></i> Add Rekening</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Rekening ID</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>

    </div>

    <script>
        $(document).ready(function() {
            checkTokenExpiration();
            var token = localStorage.getItem('jwtToken');

            $.ajax({
                url: "{{ route('rekening') }}",
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
                                        "{{ route('p.rekening.edit', ['id' => ':id']) }}";
                                    var rekeningIdBase64 = btoa(row.id_rekening);
                                    editHref = editHref.replace(':id',
                                    rekeningIdBase64);
                                    return '<a href="' + editHref +
                                        '" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bi bi-pencil-square"></i></a> ' +
                                        '<button class="btn btn-danger btn-sm delete-btn" data-id="' +
                                        row
                                        .id_rekening +
                                        '" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="bi bi-trash"></i></button>';
                                }
                            },
                            {
                                "data": "rekening_id"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    return row.no_rek + ' ' + row.keterangan;
                                }
                            }
                        ]
                    });

                    // Add click event listener to delete buttons
                    $('#table1').on('click', '.delete-btn', function() {
                        var rekeningId = $(this).data('id');
                        if (confirm('Are you sure you want to delete this rekening?')) {
                            // Perform deletion using AJAX
                            $.ajax({
                                url: "{{ route('rekening') }}/" + rekeningId,
                                type: "DELETE",
                                headers: {
                                    'Authorization': 'Bearer ' + token
                                },
                                success: function(response) {
                                    // Reload the DataTable
                                    $('#table1').DataTable().ajax.reload();
                                    alert('rekening deleted successfully!');
                                },
                                error: function(xhr, status, error) {
                                    alert(
                                        'An error occurred while deleting the rekening.');
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching rekening data:', error);
                }
            });
        });
    </script>
@endsection
