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
                        <div class="col-md-4 col-12">
                            <div class="form-group mandatory">
                                <label for="tgl_payment" class="form-label">Tgl Pembayaran</label>
                                <div class="input-group">
                                    <input type="hidden" id="id_payment" class="form-control" name="id_payment"
                                        value="{{ base64_decode($data['idpage']) }}" readonly />
                                    <input type="date" id="tgl_payment" name="tgl_payment" class="form-control"
                                        placeholder="Tgl Pembayaran" value="{{ date('Y-m-d') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group mandatory">
                                <label for="deposit" class="form-label">Deposit</label>
                                <input type="number" id="deposit" name="deposit" class="form-control"
                                    placeholder="0.00" step="0.01" data-parsley-required="true" autofocus />
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group mandatory">
                                <label for="metode_bayar_toggle" class="form-label">Pembayaran</label>
                                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                                    <label class="form-check-label" for="metode_bayar_toggle">Tunai</label>
                                    <div class="form-check form-switch fs-6">
                                        <input class="form-check-input  me-0" type="checkbox" id="metode_bayar_toggle"
                                            style="cursor: pointer">
                                        <label class="form-check-label"></label>
                                    </div>
                                    <input type="hidden" id="metode_bayar" name="metode_bayar" value="Tunai">
                                    <label class="form-check-label" for="metode_bayar_toggle">Kredit</label>
                                </div>
                            </div>
                        </div>
                    </div>
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
