@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Payment Visa</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Payment Visa</li>
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
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center">
                                            <select class="form-select me-2" id="bankSelect" style="width: 150px;">
                                                <option value="BSI">BSI</option>
                                                <option value="MANDIRI">MANDIRI</option>
                                            </select>
                                            <button type="button" class="btn btn-danger" id="cetakPembayaran"
                                                style="min-width: 100px;"><i class="bi bi-printer"></i> Cetak</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-end mt-md-0 mt-3">
                                            <button type="button" class="btn btn-primary" id="addDetailPembayaran"><i
                                                    class="bi bi-wallet2"></i> Add Payment</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row match-height">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group ">
                                            <label for="visa_id" class="form-label">Invoice</label>
                                            <input type="text" id="visa_id" class="form-control" placeholder="Invoice"
                                                value="{{ $data['autoId'] }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group ">
                                            <label for="tgl_visa" class="form-label">Tgl Invoice</label>
                                            <input type="date" id="tgl_visa" class="form-control"
                                                placeholder="Tanggal Invoice" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group ">
                                        <label for="agent_nama" class="form-label">Customer/Agen</label>
                                        <div class="input-group">
                                            <input type="hidden" id="agent_id" class="form-control"
                                                placeholder="Customer/Agen" readonly />
                                            <input type="text" id="agent_nama" class="form-control"
                                                placeholder="Customer/Agen" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h5>Tagihan</h5>
                                <p id="atas">
                                    SAR
                                </p>
                                <p style="font-size: 30pt; text-align:right">
                                    <span id="kiri">#</span><span id="bawah">1000</span>
                                </p>
                                <input type="hidden" id="kanan">
                                <input type="hidden" id="1kanan">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-md-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table" id="detailPesananTable">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal Keberangkatan</th>
                                                    <th>Jumlah Pax</th>
                                                    <th>Harga / Pax</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3" style="text-align: right">Total</th>
                                                    <th style="vertical-align: top"><input id="total_subtotal"
                                                            type="text" placeholder="0.00" class="form-control"
                                                            value="0" readonly>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <br>
                                    <h3>List Pembayaran</h3>
                                    <div class="table-responsive">
                                        <table class="table" id="listPembayaran">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tgl Pembayaran</th>
                                                    <th>Jumlah Deposit</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals -->
            @include('page.visa.modals.modal_detail_pembayaran')
        </section>
    </div>

    <!-- Scripts -->
    @include('page.visa.scripts.script_visa_d')
@endsection
