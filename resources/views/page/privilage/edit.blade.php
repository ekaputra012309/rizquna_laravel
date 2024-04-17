@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Privilage</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Privilage</li>
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
                                <form id="privilageForm" class="form" method="POST" action="#" data-parsley-validate>
                                    <div class="row">
                                        <div class="col-md-8 col-12">
                                            <div class="form-group mandatory">
                                                <label for="nama-user-column" class="form-label">Nama User</label>
                                                <div class="input-group">
                                                    <input type="hidden" id="user_id" class="form-control"
                                                        placeholder="Nama User" name="user_id" data-parsley-required="true"
                                                        readonly />
                                                    <input type="text" id="user_nama" class="form-control"
                                                        placeholder="Nama User" readonly />
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            id="searchButton">
                                                            <i class="bi bi-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label for="role-id-column" class="form-label">Role</label>
                                                <select name="role_id" id="role_id" class="form-control">
                                                    <option value="">Pilih</option>
                                                    @foreach ($data['role'] as $role)
                                                        <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                                                    @endforeach
                                                </select>
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
                                            <a href="{{ route('p.privilage') }}" class="btn btn-secondary me-1 mb-1">
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
            <!-- Modals -->
            @include('page.privilage.modals.modal_user')
        </section>
    </div>
    <!-- Scripts -->
    @include('page.privilage.scripts.script_user_modal')

    <script>
        $(document).ready(function() {
            checkTokenExpiration();
            // Retrieve JWT token from localStorage
            var jwtToken = localStorage.getItem('jwtToken');
            // Retrieve the privilage ID from the URL or any other source
            var privilageIdBase64 = "{{ $data['idpage'] }}"; // Assuming the privilage ID is Base64 encoded
            var privilageId = atob(privilageIdBase64);
            // Check if JWT token exists
            if (jwtToken) {
                // Send GET request to fetch privilage data
                $.ajax({
                    url: "{{ route('privilage') }}/" + privilageId,
                    type: 'GET',
                    beforeSend: function(xhr) {
                        // Set the Authorization header with JWT token
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        // Populate form fields with retrieved privilage data
                        var namaUser = response.user.name + ' - ' + response.user
                            .email;
                        // Populate form fields with retrieved agent data
                        $('#user_id').val(response.user_id);
                        $('#user_nama').val(namaUser);
                        $('#role_id').val(response.role_id);
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
            $('#privilageForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Get the form data
                var formData = $(this).serialize();

                // Send PUT request with AJAX
                $.ajax({
                    url: "{{ route('privilage') }}/" + privilageId,
                    type: 'POST',
                    data: formData,
                    beforeSend: function(xhr) {
                        // Set the Authorization header with JWT token
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        // Request was successful, handle response
                        window.location.href = "{{ url('/pages/privilage') }}";
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
