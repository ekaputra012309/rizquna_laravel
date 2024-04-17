<div class="modal fade" id="detailPembayaranModal" tabindex="-1" role="dialog" aria-labelledby="detailPembayaranModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPembayaranModal">Add Pembayaran</h5>
                <button type="button" class="close" id="closeModalBtnPayment1" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="detailPembayaranForm" class="form" method="POST" action="#" data-parsley-validate>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="tgl_payment_visa" class="form-label">Tgl Pembayaran</label>
                                <div class="input-group">
                                    <input type="hidden" id="id_visa" class="form-control" name="id_visa"
                                        value="{{ base64_decode($data['idpage']) }}" readonly />
                                    <input type="date" id="tgl_payment_visa" name="tgl_payment_visa"
                                        class="form-control" placeholder="Tgl Pembayaran" value="{{ date('Y-m-d') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="deposit" class="form-label">Deposit</label>
                                <input type="number" id="deposit" name="deposit" class="form-control"
                                    placeholder="0.00" step="0.01" data-parsley-required="true" />
                                <input type="hidden" id="user_id" class="form-control" name="user_id" />
                            </div>
                        </div>
                        {{-- <div class="col-md-4 col-12">
                            <div class="form-group mandatory">
                                <label for="kurs_bsi" class="form-label">KURS BSI</label>
                                <input type="number" id="kurs_bsi1" name="kurs_bsi" class="form-control"
                                    placeholder="0.00" step="0.01" data-parsley-required="true" />
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group mandatory">
                                <label for="kurs_riyal" class="form-label">KURS RIYAL</label>
                                <input type="number" id="kurs_riyal1" name="kurs_riyal" class="form-control"
                                    placeholder="0.00" step="0.01" data-parsley-required="true" />
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="tagihan" class="form-label">Tagihan IDR</label>
                                <input type="text" id="tagihan" class="form-control" placeholder="0" readonly />
                            </div>
                        </div>

                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModalBtnPayment">Close</button>
                    <button type="submit" class="btn btn-primary">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
