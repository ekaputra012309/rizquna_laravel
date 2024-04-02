@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Agent</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Agent</li>
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
                                <form id="agentForm" class="form" method="POST" action="#" data-parsley-validate>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="nama-agent-column" class="form-label">Nama Agent</label>
                                                <input type="text" id="nama_agent" class="form-control"
                                                    placeholder="Nama Agent" name="nama_agent"
                                                    data-parsley-required="true" />
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                                <label for="alamat-column" class="form-label">Alamat</label>
                                                <input type="text" id="alamat" class="form-control"
                                                    placeholder="Alamat" name="alamat" data-parsley-required="true" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="contact-person-column" class="form-label">Contact Person</label>
                                                <input type="text" id="contact_person" class="form-control"
                                                    name="contact_person" placeholder="Contact Person"
                                                    data-parsley-required="true" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="telepon-column" class="form-label">Telepon</label>
                                                <input type="number" id="telepon" class="form-control" name="telepon"
                                                    placeholder="Telepon" data-parsley-required="true" />
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
                                            <a href="{{ route('p.agent') }}" class="btn btn-secondary me-1 mb-1">
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
            // Retrieve the agent ID from the URL or any other source
            var agentIdBase64 = "{{ $data['idpage'] }}"; // Assuming the agent ID is Base64 encoded
            var agentId = atob(agentIdBase64);
            // Check if JWT token exists
            if (jwtToken) {
                // Send GET request to fetch agent data
                $.ajax({
                    url: "{{ route('agent') }}/" + agentId,
                    type: 'GET',
                    beforeSend: function(xhr) {
                        // Set the Authorization header with JWT token
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        // Populate form fields with retrieved agent data
                        $('#nama_agent').val(response.nama_agent);
                        $('#alamat').val(response.alamat);
                        $('#contact_person').val(response.contact_person);
                        $('#telepon').val(response.telepon);
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
            $('#agentForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Get the form data
                var formData = $(this).serialize();

                // Send PUT request with AJAX
                $.ajax({
                    url: "{{ route('agent') }}/" + agentId,
                    type: 'POST',
                    data: formData,
                    beforeSend: function(xhr) {
                        // Set the Authorization header with JWT token
                        xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                    },
                    success: function(response) {
                        // Request was successful, handle response
                        window.location.href = "{{ url('/pages/agent') }}";
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
