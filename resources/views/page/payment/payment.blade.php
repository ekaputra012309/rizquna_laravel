@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Payment Hotel</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Payment Hotel</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form id="paymentForm" class="form" method="POST" action="#" data-parsley-validate>
                        <div class="row">
                            <h5>Conversion</h5>
                            <div class="col-md-3 col-12">
                                <div class="form-group mandatory">
                                    <label for="sar_idr" class="form-label">1 SAR IDR</label>
                                    <input type="number" id="sar_idr" name="sar_idr" class="form-control" step="0.01"
                                        data-parsley-required="true">
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group mandatory">
                                    <label for="sar_usd" class="form-label">1 SAR USD</label>
                                    <input type="number" id="sar_usd" name="sar_usd" class="form-control" step="0.01"
                                        data-parsley-required="true" value="3.74">
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group mandatory">
                                    <label for="usd_idr" class="form-label">1 USD IDR</label>
                                    <input type="number" id="usd_idr" name="usd_idr" class="form-control" step="0.01"
                                        data-parsley-required="true">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="form-group mandatory">
                                    <label for="inv_number" class="form-label">Invoice Number</label>
                                    <div class="input-group">
                                        <input type="hidden" id="id_booking" class="form-control" name="id_booking"
                                            data-parsley-required="true" readonly />
                                        <input type="text" id="inv_number" class="form-control"
                                            placeholder="Invoice Number" readonly />
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="searchInv">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="form-group">
                                    <label for="mata_uang" class="form-label">From</label>
                                    <select id="mata_uang" class="form-select" disabled>
                                        <option value="">Pilih</option>
                                        <option value="SAR">SAR</option>
                                        <option value="USD">USD</option>
                                        {{-- <option value="IDR">IDR</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="form-group mandatory">
                                    <label for="pilih_konversi" class="form-label">To</label>
                                    <select id="pilih_konversi" name="pilih_konversi" class="form-select"
                                        data-parsley-required="true">
                                        <option value="">Pilih</option>
                                        <option value="SAR">SAR</option>
                                        <option value="USD">USD</option>
                                        <option value="IDR">IDR</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="subtotal" class="form-label">Sub Total <span id="dari"></span></label>
                                    <input type="hidden" id="subtotal" class="form-control">
                                    <input type="text" id="subtotal1" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="hasil_konversi" class="form-label">Sub Total <span
                                            id="hasil"></span></label>
                                    <input type="hidden" id="hasil_konversi" name="hasil_konversi"
                                        class="form-control">
                                    <input type="text" id="hasil_konversi1" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                    Add Payment
                                </button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Pemesanan</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Agen</th>
                                    <th>Total Subtotal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modals -->
            @include('page.payment.modals.modal_invoice')
        </section>

    </div>
    <!-- Scripts -->
    @include('page.payment.scripts.script_payment')
    @include('page.payment.scripts.script_invoice_modal')
@endsection
