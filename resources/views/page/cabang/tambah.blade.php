@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Cabang</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Cabang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h4 class="card-title">Multiple Column</h4>
                        </div> --}}
                        <div class="card-content">
                            <div class="card-body">
                                <form id="cabangForm" class="form" method="POST" action="#" data-parsley-validate>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                                <label for="nama-cabang-column" class="form-label">Nama Cabang</label>
                                                <input type="text" id="nama_cabang" class="form-control"
                                                    placeholder="Nama Cabang" name="nama_cabang"
                                                    data-parsley-required="true" />
                                                <input type="hidden" id="user_id" class="form-control" name="user_id" />
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                Reset
                                            </button>
                                            <a href="{{ route('p.cabang') }}" class="btn btn-secondary me-1 mb-1">
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
            $('#cabangForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Retrieve JWT token from localStorage
                var jwtToken = localStorage.getItem('jwtToken');

                // Check if JWT token exists
                if (jwtToken) {
                    // Get the form data
                    var formData = $(this).serialize();

                    // Send POST request with AJAX
                    $.ajax({
                        url: "{{ route('cabang') }}",
                        type: 'POST',
                        data: formData,
                        beforeSend: function(xhr) {
                            // Set the Authorization header with JWT token
                            xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                        },
                        success: function(response) {
                            // Request was successful, handle response
                            window.location.href = "{{ url('/pages/cabang') }}";
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            // Request failed, handle error
                            console.error(error);
                        }
                    });
                } else {
                    // Handle case where JWT token is not found in localStorage
                    console.error('JWT token not found in localStorage.');
                }
            });
        });
    </script>
@endsection
