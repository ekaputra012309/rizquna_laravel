@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit User</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
                                <form id="userForm" class="form" method="POST" action="#" data-parsley-validate>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="nama-user-column" class="form-label">Nama User</label>
                                                <input type="text" id="name" class="form-control"
                                                    placeholder="Nama User" name="name" data-parsley-required="true" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="email-user-column" class="form-label">Email</label>
                                                <input type="email" id="email" class="form-control"
                                                    placeholder="Email" name="email" data-parsley-required="true" />
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
                                            <a href="{{ route('p.user.management') }}" class="btn btn-secondary me-1 mb-1">
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
            // Retrieve the user ID from the URL or any other source
            var userIdBase64 = "{{ $data['idpage'] }}"; // Assuming the user ID is Base64 encoded
            var userId = atob(userIdBase64);
            // Check if JWT token exists
            if (jwtToken) {
                // Send GET request to fetch user data
                $.ajax({
                    url: "{{ route('user') }}/" + userId,
                    type: 'GET',
                    beforeSend: function(xhr) {
                        // Set the Authorization header with JWT token
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        // Populate form fields with retrieved user data
                        $('#name').val(response.name);
                        $('#email').val(response.email);
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
            $('#userForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Get the form data
                var formData = $(this).serialize();

                // Send PUT request with AJAX
                $.ajax({
                    url: "{{ route('user') }}/" + userId,
                    type: 'POST',
                    data: formData,
                    beforeSend: function(xhr) {
                        // Set the Authorization header with JWT token
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        // Request was successful, handle response
                        window.location.href = "{{ url('/pages/user') }}";
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
