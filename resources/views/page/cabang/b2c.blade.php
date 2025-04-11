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
            <div class="row">

                @foreach($cabangs as $key => $cabang)
                    @php
                        // Dynamically calculate column size
                        $colSize = 12; // Default for 1 card
                        if (count($cabangs) == 2) {
                            $colSize = 6; // For 2 cards, each takes 50% width
                        } elseif (count($cabangs) == 3) {
                            $colSize = 4; // For 3 cards, each takes 33.33% width
                        } elseif (count($cabangs) == 4) {
                            $colSize = 3; // For 4 cards, each takes 25% width
                        }
                    @endphp

                    <div class="col-12 col-md-3">
                        <a href="{{ route('p.bcabang') }}?cabang={{ $cabang->id }}" class="text-decoration-none">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon" style="background-color: {{ $cabang->randomColor }}; color: white; border-radius: 20%; padding: 10px;">
                                                <i class="iconly-boldProfile"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">{{ $cabang->nama_cabang }}</h6>
                                            <h6 class="font-extrabold mb-0">{{ $cabang->jamaah_count }} Data</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @if(($key + 1) % 4 == 0 && ($key + 1) != count($cabangs)) 
                        </div><div class="row"> <!-- New Row after every 4th card -->
                    @endif
                @endforeach
            </div>
        </section>
    </div>
@endsection
