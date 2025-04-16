@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Akses Cabang</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Akses Cabang</li>
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
                                <form id="cabangroleForm" class="form" method="POST" action="#" data-parsley-validate>
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
                                                <label for="role-id-column" class="form-label">Cabang</label>
                                                <select name="cabang_id" id="cabang_id" class="form-control">
                                                    <option value="">Pilih</option>
                                                    @foreach ($data['role'] as $cabang)
                                                        <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                                                    @endforeach
                                                </select>
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
                                            <a href="{{ route('p.cabangrole') }}" class="btn btn-secondary me-1 mb-1">
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
            @include('page.cabangrole.modals.modal_user')
        </section>
    </div>
    <!-- Scripts -->
    @include('page.cabangrole.scripts.script_user_modal')

    <script>
        $(document).ready(function() {
            checkTokenExpiration();
            $('#cabangroleForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Retrieve JWT token from localStorage
                var jwtToken = localStorage.getItem('jwtToken');

                // Check if JWT token exists
                if (jwtToken) {
                    // Get the form data
                    var formData = $(this).serialize();

                    // Send POST request with AJAX
                    $.ajax({
                        url: "{{ route('cabangrole') }}",
                        type: 'POST',
                        data: formData,
                        beforeSend: function(xhr) {
                            // Set the Authorization header with JWT token
                            xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                        },
                        success: function(response) {
                            // Request was successful, handle response
                            window.location.href = "{{ url('/pages/cabangrole') }}";
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            // Request failed, handle erro
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
