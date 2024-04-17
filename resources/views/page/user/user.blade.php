@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data User</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data User</li>
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
                            <a href="{{ route('p.user.tambah') }}" class="btn btn-primary btn-sm"><i
                                    class="bi bi-plus-square"></i> Add User</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama User</th>
                                    <th>Email</th>
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
                url: "{{ route('user') }}",
                type: "GET",
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function(data) {
                    $.each(data, function(index, user) {
                        var editHref = "{{ route('p.user.edit', ['id' => ':id']) }}";
                        var userIdBase64 = btoa(user.id);
                        editHref = editHref.replace(':id', userIdBase64);

                        var row = '<tr>' +
                            '<td><a href="' + editHref +
                            '" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bi bi-pencil-square"></i></a> ' +
                            '<button class="btn btn-danger btn-sm delete-btn" data-id="' + user
                            .id +
                            '" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="bi bi-trash"></i></button> ' +
                            '<button class="btn btn-success btn-sm reset-btn" data-id="' + user
                            .id +
                            '" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset Password"><i class="bi bi-arrow-clockwise"></i> Reset Password</button>' +
                            '<td>' + user.name + '</td>' +
                            '<td>' + user.email + '</td>' +
                            '</tr>';
                        $('#table1 tbody').append(row);
                    });

                    // Initialize DataTable after populating the table
                    $('#table1').DataTable({
                        "searching": true,
                        "ordering": true,
                        "paging": true
                    });

                    // Add click event listener to delete buttons
                    $('.delete-btn').click(function() {
                        var userId = $(this).data('id');
                        if (confirm('Are you sure you want to delete this user?')) {
                            // Perform deletion using AJAX
                            $.ajax({
                                url: "{{ route('user') }}/" + userId,
                                type: "DELETE",
                                headers: {
                                    'Authorization': 'Bearer ' + token
                                },
                                success: function(response) {
                                    // Reload the page or update the table as needed
                                    alert('user deleted successfully!');
                                    location
                                        .reload(); // Reload the page after deletion
                                },
                                error: function(xhr, status, error) {
                                    alert(
                                        'An error occurred while deleting the user.'
                                    );
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });

                    // Add click event listener to reset buttons
                    $('.reset-btn').click(function() {
                        var userId = $(this).data('id');
                        if (confirm('Are you sure you want to reset this user password ?')) {
                            // Perform deletion using AJAX
                            $.ajax({
                                url: "{{ route('user.reset', ['id' => ':id']) }}"
                                    .replace(':id', userId),
                                type: "POST",
                                headers: {
                                    'Authorization': 'Bearer ' + token
                                },
                                success: function(response) {
                                    // Reload the page or update the table as needed
                                    alert('reset password successfully!');
                                    location
                                        .reload(); // Reload the page after deletion
                                },
                                error: function(xhr, status, error) {
                                    alert(
                                        'An error occurred while deleting the user.'
                                    );
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
