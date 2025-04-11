@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $pageTitle }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0"> Tambah Jamaah {{ $namacabang }} </h5>
                </div>
                <div class="card-body">
                    <form id="jamaahForm" class="form" method="POST" action="#" data-parsley-validate>
                        @csrf
                        <div class="row">
                            {{-- NIK --}}
                            <div class="col-md-6 col-12">
                                <div class="form-group mandatory">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="number" id="nik" class="form-control" name="nik" required placeholder="Nomor Induk Kependudukan">
                                    <input type="hidden" name="jamaah_id" id="jamaah_id">
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
                                    <label for="dp" class="form-label">DP (Uang Muka) Rp</label>
                                    <input type="number" id="dp" class="form-control" name="dp" placeholder="DP jika ada">
                                </div>
                            </div>

                            {{-- Tanggal Berangkat --}}
                            <div class="col-md-6 col-12">
                                <div class="form-group mandatory">
                                    <label for="tgl_berangkat" class="form-label">Tanggal Berangkat</label>
                                    <input type="date" id="tgl_berangkat" class="form-control" name="tgl_berangkat" required placeholder="Pilih Tanggal">
                                </div>
                            </div>

                            {{-- Hidden Inputs --}}
                            <input type="hidden" name="user_id" id="user_id">
                            <input type="hidden" name="cabang_id" value="{{ $cabangId }}">
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary btn-reset me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Jamaah</th>
                                    <th>Alamat</th>
                                    <th>Phone</th>
                                    <th>DP</th>
                                    <th>Tgl Keberangkatan</th>
                                    <th>Actions</th>
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
        $(document).ready(function () {
            checkTokenExpiration();
            var token = localStorage.getItem('jwtToken');
            var dataTable = $('#table1').DataTable({
                "searching": true,
                "ordering": true,
                "paging": true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 100]
            });

            $('.btn[type="reset"]').on('click', function () {
                $('.btn[type="submit"]').text('Submit');
            });

            function formatTanggalIndo(dateString) {
                if (!dateString) return "-";
                const bulanIndo = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];

                const date = new Date(dateString);
                const day = date.getDate();
                const month = bulanIndo[date.getMonth()];
                const year = date.getFullYear();

                return `${day} ${month} ${year}`;
            }

            function formatRupiah(angka) {
                if (!angka) return "-";
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(angka);
            }

            function loadJamaahTable() {
                $.ajax({
                    url: "{{ route('jamaah') }}?cabang_id={{ $cabangId }}",
                    type: "GET",
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function (data) {
                        dataTable.clear().draw(); // Clear existing data

                        $.each(data, function (index, jamaah) {
                            var editHref = "{{ route('p.jamaah.edit', ['id' => ':id']) }}";
                            var jamaahIdBase64 = btoa(jamaah.id);
                            editHref = editHref.replace(':id', jamaahIdBase64);

                            dataTable.row.add([
                                index + 1,
                                jamaah.nama,
                                jamaah.alamat,
                                jamaah.phone,
                                formatRupiah(jamaah.dp)?? "-",
                                formatTanggalIndo(jamaah.tgl_berangkat),
                                '<button type="button" class="btn btn-primary btn-sm edit-btn" data-id="' + jamaah.id + '" title="Edit"><i class="bi bi-pencil-square"></i></button> ' +
                                '<button class="btn btn-danger btn-sm delete-btn" data-id="' + jamaah.id + '" title="Hapus"><i class="bi bi-trash"></i></button> ' +
                                '<button type="button" class="btn btn-success btn-sm get-btn" data-id="' + jamaah.id + '" title="Get data"><i class="bi bi-arrow-right-square"></i></button> '
                            ]).draw(false);
                        });
                    }
                });
            }

            // Initial load
            loadJamaahTable();

            // Submit Form
            $('#jamaahForm').submit(function (event) {
                event.preventDefault();
                var jwtToken = localStorage.getItem('jwtToken');
                if (jwtToken) {
                    var formData = $(this).serialize();

                    var jamaahId = $('#jamaah_id').val(); // Check if there's an ID
                    var url = "{{ route('jamaah') }}";
                    var method = 'POST';

                    if (jamaahId) {
                        url += '/' + jamaahId;
                        method = 'POST';
                    }

                    $.ajax({
                        url: url,
                        type: method,
                        data: formData,
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('Authorization', 'Bearer ' + jwtToken);
                        },
                        success: function (response) {
                            $('#jamaahForm')[0].reset();     // Clear form
                            $('#jamaah_id').val('');         // Reset ID to switch back to insert
                            loadJamaahTable(); 
                            $('.btn[type="submit"]').text('Submit');
                            console.log('Added:', response);
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });

            // Use event delegation for dynamic buttons
            $('#table1 tbody').on('click', '.delete-btn', function () {
                var jamaahId = $(this).data('id');
                if (confirm('Are you sure you want to delete this jamaah?')) {
                    $.ajax({
                        url: "{{ route('jamaah') }}/" + jamaahId,
                        type: "DELETE",
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        success: function () {
                            loadJamaahTable(); // Refresh table
                            alert('Jamaah deleted successfully!');
                        },
                        error: function (xhr, status, error) {
                            alert('An error occurred while deleting the jamaah.');
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            $('#table1 tbody').on('click', '.edit-btn', function () {
                var jamaahId = $(this).data('id');
                $('.btn[type="submit"]').text('Update');

                $.ajax({
                    url: "{{ route('jamaah') }}/" + jamaahId,
                    type: "GET",
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function (jamaah) {
                        $('#jamaah_id').val(jamaah.id);
                        $('#nik').val(jamaah.nik);
                        $('#nama').val(jamaah.nama);
                        $('#alamat').val(jamaah.alamat);
                        $('#phone').val(jamaah.phone);
                        $('#passpor').val(jamaah.passpor);
                        $('#dp').val(jamaah.dp);
                        $('#tgl_berangkat').val(jamaah.tgl_berangkat);
                    },
                    error: function (xhr) {
                        console.error('Error fetching jamaah:', xhr.responseText);
                    }
                });
            });

            $('#table1 tbody').on('click', '.get-btn', function () {
                var jamaahId = $(this).data('id');

                // Reset the form first
                $('#jamaahForm')[0].reset(); // Native JS reset
                $('#jamaah_id').val('');     // Reset hidden field if needed
                $('.btn[type="submit"]').text('Submit');

                // Then fetch and fill the data
                $.ajax({
                    url: "{{ route('jamaah') }}/" + jamaahId,
                    type: "GET",
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function (jamaah) {
                        $('#nik').val(jamaah.nik);
                        $('#nama').val(jamaah.nama);
                        $('#alamat').val(jamaah.alamat);
                        $('#phone').val(jamaah.phone);
                        $('#passpor').val(jamaah.passpor);
                    },
                    error: function (xhr) {
                        console.error('Error fetching jamaah:', xhr.responseText);
                    }
                });
            });
        });

    </script>
@endsection
