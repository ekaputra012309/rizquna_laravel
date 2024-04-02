<div class="modal fade" id="detailPemesananModal" tabindex="-1" role="dialog" aria-labelledby="detailPemesananModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPemesananModalLabel">Add Detail Pemesanan</h5>
                <button type="button" class="close" id="closeModalBtnBooking1" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="detailPemesananForm" class="form" method="POST" action="#" data-parsley-validate>
                <div class="modal-body">
                    <!-- Your form for adding detail pemesanan goes here -->
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group mandatory">
                                <input type="hidden" id="booking_id" class="form-control" name="booking_id"
                                    value="{{ $data['autoId'] }}" readonly />
                                <label for="room_id" class="form-label">Tipe Kamar</label>
                                <select id="room_id" name="room_id" class="form-select" data-parsley-required="true"
                                    disabled>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group mandatory">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="hidden" id="malam1" name="malam">
                                <input type="number" id="qty" class="form-control" placeholder="0" name="qty"
                                    data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group mandatory">
                                <label for="tarif" class="form-label">Tarif</label>
                                <input type="number" id="tarif" class="form-control" placeholder="Tarif"
                                    name="tarif" data-parsley-required="true" step="0.01" />
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group mandatory">
                                <label for="discount" class="form-label">Diskon</label>
                                <input type="number" id="discount" class="form-control" placeholder="0"
                                    name="discount" data-parsley-required="true" value="0" />
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group mandatory">
                                <label for="subtotal" class="form-label">Sub Total</label>
                                <input type="number" id="subtotal" step="0.01" class="form-control"
                                    placeholder="Sub Total" name="subtotal" data-parsley-required="true" value="0"
                                    readonly />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModalBtnBooking">Close</button>
                    <button type="submit" class="btn btn-primary">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
