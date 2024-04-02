@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Report Agent</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('p.dash') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Report Agent</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form id="reportAgentForm" class="form" method="POST" action="#" data-parsley-validate>
                        <div class="row">
                            <h5>Pilih Range Tanggal Transaksi</h5>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="tgl_from" class="form-label">Tanggal Dari</label>
                                    <input type="date" id="tgl_from" class="form-control" name="tgl_from" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="tgl_to" class="form-label">Tanggal Ke</label>
                                    <input type="date" id="tgl_to" class="form-control" name="tgl_to" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="agent_nama" class="form-label">Customer/Agen</label>
                                    <div class="input-group">
                                        <input type="hidden" id="agent_id" class="form-control"
                                            placeholder="Customer/Agen" name="agent_id" readonly />
                                        <input type="text" id="agent_nama" class="form-control"
                                            placeholder="Customer/Agen" readonly />
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="searchButton">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12 d-flex align-items-end">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Filter Data" />
                                    <input type="reset" class="btn btn-secondary" value="Reset" />
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama Agent</th>
                                    <th>Invoice</th>
                                    <th>Tgl Pemesanan</th>
                                    <th>Sub Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>

        <!-- Modals -->
        @include('page.agent.modal_agent')
        </section>
    </div>

    <!-- Scripts -->
    @include('page.agent.script_agent_modal')
    @include('page.agent.script_reportagent')
@endsection
