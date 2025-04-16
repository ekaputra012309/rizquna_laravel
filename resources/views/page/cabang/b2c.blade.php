@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data B2C</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data B2C</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
        <div class="row" id="cabang-container">
            @foreach($cabangs as $key => $cabang)
                @php
                    // Extract user_ids manually from relationship
                    $userIds = [];
                    foreach ($cabang->cabangRoles as $role) {
                        $userIds[] = $role->user_id;
                    }

                    $randomColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                @endphp

                <div class="col-12 col-md-3 cabang-card" data-user-ids='@json($userIds)' style="display: none;">
                    <a href="{{ route('p.bcabang') }}?cabang={{ $cabang->id }}" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <div class="stats-icon" style="background-color: {{ $randomColor }};">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                                <h6>{{ $cabang->nama_cabang }}</h6>
                                <h6>{{ $cabang->jamaah_count }} Data</h6>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        </section>
        <script>
            $(document).ready(function () {
                var jwtToken = localStorage.getItem('jwtToken');

                $.ajax({
                    url: "{{ route('userProfile') }}",
                    type: "GET",
                    headers: {
                        'Authorization': 'Bearer ' + jwtToken
                    },
                    success: function (response) {
                        const userId = response.id;

                        let hasMatched = false;

                        $('.cabang-card').each(function () {
                            const rawUserIds = $(this).attr('data-user-ids');
                            
                            if (rawUserIds) {
                                const userIds = JSON.parse(rawUserIds);

                                if (Array.isArray(userIds) && userIds.includes(userId)) {
                                    $(this).show();
                                    hasMatched = true;
                                } else {
                                    $(this).hide();
                                }
                            } else {
                                $(this).show(); // default show if attribute not found
                            }
                        });

                        // If no matches were found, show all cards as fallback
                        if (!hasMatched) {
                            $('.cabang-card').show();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        </script>

    </div>
@endsection
