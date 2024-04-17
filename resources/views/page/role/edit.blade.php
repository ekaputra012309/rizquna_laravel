@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Role</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="roleForm" class="form" method="POST" action="#" data-parsley-validate>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="nama-role-column" class="form-label">Kode Role</label>
                                                <input type="text" id="kode_role" class="form-control"
                                                    placeholder="Kode Role" name="kode_role" data-parsley-required="true" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="nama-role-column" class="form-label">Nama Role</label>
                                                <input type="text" id="nama_role" class="form-control"
                                                    placeholder="Nama Role" name="nama_role" data-parsley-required="true" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">
                                                Update
                                            </button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                Reset
                                            </button>
                                            <a href="{{ route('p.role') }}" class="btn btn-secondary me-1 mb-1">
                                                Back
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            checkTokenExpiration();
            // Retrieve JWT token from localStorage
            var jwtToken = localStorage.getItem('jwtToken');
            // Retrieve the role ID from the URL or any other source
            var roleIdBase64 = "{{ $data['idpage'] }}"; // Assuming the role ID is Base64 encoded
            var roleId = atob(roleIdBase64);
            // Check if JWT token exists
            if (jwtToken) {
                // Send GET request to fetch role data
                $.ajax({
                    url: "{{ route('role') }}/" + roleId,
                    type: 'GET',
                    beforeSend: function(xhr) {
                        // Set the Authorization header with JWT token
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        // Populate form fields with retrieved role data
                        $('#kode_role').val(response.kode_role);
                        $('#nama_role').val(response.nama_role);
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

            // Submit form handler
            $('#roleForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Get the form data
                var formData = $(this).serialize();

                // Send PUT request with AJAX
                $.ajax({
                    url: "{{ route('role') }}/" + roleId,
                    type: 'POST',
                    data: formData,
                    beforeSend: function(xhr) {
                        // Set the Authorization header with JWT token
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        // Request was successful, handle response
                        window.location.href = "{{ url('/pages/role') }}";
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Request failed, handle error
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
