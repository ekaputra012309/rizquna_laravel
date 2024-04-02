@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Payment Visa</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Payment Visa</li>
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
                                <form id="visaForm" class="form" method="POST" action="#" data-parsley-validate>
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group mandatory">
                                                <label for="visa_id" class="form-label">Invoice No</label>
                                                <input type="text" id="visa_id" class="form-control"
                                                    placeholder="Invoice No" name="visa_id" data-parsley-required="true"
                                                    value="{{ $data['autoId'] }}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group mandatory">
                                                <label for="tgl_visa" class="form-label">Tanggal Invoice</label>
                                                <input type="date" id="tgl_visa" class="form-control"
                                                    placeholder="Tanggal Invoice" name="tgl_visa"
                                                    data-parsley-required="true" value="{{ date('Y-m-d') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="agent_nama" class="form-label">Customer/Agen</label>
                                                <div class="input-group">
                                                    <input type="hidden" id="agent_id" class="form-control"
                                                        placeholder="Customer/Agen" name="agent_id"
                                                        data-parsley-required="true" readonly />
                                                    <input type="text" id="agent_nama" class="form-control"
                                                        placeholder="Customer/Agen" readonly />
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            id="searchButton">
                                                            <i class="bi bi-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="tgl_keberangkatan" class="form-label">Tanggal
                                                    Keberangkatan</label>
                                                <input type="date" id="tgl_keberangkatan" class="form-control"
                                                    placeholder="Tanggal Invoice" name="tgl_keberangkatan"
                                                    data-parsley-required="true" />
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group mandatory">
                                                <label for="jumlah_pax" class="form-label">Jumlah Pax</label>
                                                <input type="number" id="jumlah_pax" class="form-control" placeholder="0"
                                                    name="jumlah_pax" data-parsley-required="true" />
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group mandatory">
                                                <label for="harga_pax" class="form-label">Harga / Pax</label>
                                                <input type="number" id="harga_pax" class="form-control" placeholder="0"
                                                    name="harga_pax" data-parsley-required="true" />
                                                <input type="hidden" id="total" class="form-control" placeholder="0"
                                                    name="total" />
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
                                            <a href="{{ route('p.visa') }}" class="btn btn-secondary me-1 mb-1">
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
            @include('page.visa.modals.modal_agent')
        </section>
    </div>

    <!-- Scripts -->
    @include('page.visa.scripts.script_visa')
    @include('page.visa.scripts.script_agent_modal')
@endsection
