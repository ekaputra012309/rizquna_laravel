@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Jamaah {{ $data['namacabang'] }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Jamaah</li>
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
                            <form id="jamaahForm" class="form" method="POST" action="#" data-parsley-validate>
                                @csrf
                                <div class="row">
                                    {{-- NIK --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input type="number" id="nik" class="form-control" name="nik" required placeholder="Nomor Induk Kependudukan">
                                        </div>
                                    </div>

                                    {{-- Nama --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" id="nama" class="form-control" name="nama" required placeholder="Nama Jamaah">
                                        </div>
                                    </div>

                                    {{-- Alamat --}}
                                    <div class="col-12">
                                        <div class="form-group mandatory">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" id="alamat" class="form-control" name="alamat" required placeholder="Alamat Lengkap">
                                        </div>
                                    </div>

                                    {{-- No. HP --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="phone" class="form-label">No. HP</label>
                                            <input type="text" id="phone" class="form-control" name="phone" required placeholder="08xxxxxxxxxx">
                                        </div>
                                    </div>

                                    {{-- Nomor Passport --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="passpor" class="form-label">No. Passport</label>
                                            <input type="number" id="passpor" class="form-control" name="passpor" required placeholder="Nomor Passport">
                                        </div>
                                    </div>

                                    {{-- DP (optional) --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="dp" class="form-label">DP (Uang Muka)</label>
                                            <input type="number" id="dp" class="form-control" name="dp" placeholder="DP jika ada">
                                        </div>
                                    </div>

                                    {{-- Hidden Inputs --}}
                                    <input type="hidden" name="user_id" id="user_id">
                                    <input type="hidden" name="cabang_id" value="{{ $data['cabangId'] }}">
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        <a href="{{ route('p.bcabang') }}?cabang={{ $data['cabangId'] }}" class="btn btn-secondary me-1 mb-1">Back</a>
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
            $('#jamaahForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Retrieve JWT token from localStorage
                var jwtToken = localStorage.getItem('jwtToken');

                // Check if JWT token exists
                if (jwtToken) {
                    // Get the form data
                    var formData = $(this).serialize();

                    // Send POST request with AJAX
                    $.ajax({
                        url: "{{ route('jamaah') }}",
                        type: 'POST',
                        data: formData,
                        beforeSend: function(xhr) {
                            // Set the Authorization header with JWT token
                            xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                        },
                        success: function(response) {
                            // Request was successful, handle response
                            window.location.href = "{{ url('/pages/bcabang') }}?cabang={{ $data['cabangId'] }}";
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
